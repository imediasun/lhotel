<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Libraries\Display_lib;
use App\CustomersStatuses;
use App\User;
use Auth;
use App\Like;
use App\Customer;
use App\Logo;
class PrivateCabinetController extends Controller
{

    public function __construct()
    {
    $this->middleware('auth');
        
    
    

    }

    public function index($id,Request $request){

        $user= Auth::user()->id;
        
        if($user!==(int)$id){

        return redirect()->route('not_yours');
        }
        else {

            //Get data from DB

            //menu
            $data_nav['menu'] = MenuController::index('categories');

            //cabinet data


            //page
            $data_content['customers_statuses'] = CustomersStatuses::get();
            $data_content['user_information'] = User::where('id', $id)->get();
            $data_content['user_status'] = $data_content['user_information'][0]['original']['status'];
            if($data_content['user_status']==2){
            $data_content['customer'] = Customer::where('id_user', $id)->get();
            /*dd($data_content['customer']);*/
            }

            $data_cab['cab_btn'] = 'index';
            $data_cab['id'] = $id;
            $data_content['title'] = "Industry";
            $path = 'cabinet_page';
            $data_content['logos']=Logo::orderBy('created_at', 'desc')
                ->orderBy('updated_at', 'desc')
                ->take(10)
                ->get();
            $data['keywords'] = "Фрилансим по крупному";
            $data['description'] = "Фрилансим по крупному";
            return Display_lib::cabinet($path, $data, $data_nav, $data_content, $data_cab);
        }

    }

    public function orders($id){
        //Get data from DB

        //menu
        $data_nav['menu']=MenuController::index('categories');

        //cabinet data
        /*$data_content['good']=Good::where('id',$id)
            ->orderBy('created_at', 'desc')
            ->orderBy('updated_at', 'desc')
            ->take(5)
            ->get();*/

        //page
        $data_cab['cab_btn']='orders';
        $data_cab['id']=$id;
        $data_content['title']="Industry";
        $path='cabinet_page_orders';
        $data['keywords']="Фрилансим по крупному";
        $data['description']="Фрилансим по крупному";
        return Display_lib::cabinet($path,$data,$data_nav,$data_content,$data_cab);

    }

    public function likes($id){
        //Get data from DB

        //menu
        $data_nav['menu']=MenuController::index('categories');
        $data_content['user_information'] = User::where('id', $id)->get();
        //cabinet data
        $data_content['likes']=Like::where('id_user',$id)
            ->orderBy('created_at', 'desc')
            ->orderBy('updated_at', 'desc')
            ->get()->load('goods');
        //logos_of_partners
        $data_content['logos']=Logo::orderBy('created_at', 'desc')
            ->orderBy('updated_at', 'desc')
            ->take(10)
            ->get();

        $data_content['user']=Auth::user()->id;
        //page
        
        $data_cab['cab_btn']='likes';
        $data_cab['id']=$id;
        $data_content['title']="Industry";
        $path='cabinet_page_likes';
        $data['keywords']="Фрилансим по крупному";
        $data['description']="Фрилансим по крупному";
        return Display_lib::cabinet($path,$data,$data_nav,$data_content,$data_cab);

    }
    public function messages($id){
        //Get data from DB

        //menu
        $data_nav['menu']=MenuController::index('categories');

        //cabinet data
        /*$data_content['good']=Good::where('id',$id)
            ->orderBy('created_at', 'desc')
            ->orderBy('updated_at', 'desc')
            ->take(5)
            ->get();*/

        //page
        
        $data_cab['cab_btn']='messages';
        $data_cab['id']=$id;
        $data_content['title']="Industry";
        $path='cabinet_page_messages';
        $data['keywords']="Фрилансим по крупному";
        $data['description']="Фрилансим по крупному";
        return Display_lib::cabinet($path,$data,$data_nav,$data_content,$data_cab);

    }
}
