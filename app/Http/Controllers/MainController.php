<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use Input;
use DB;
use App\Good;
use App\Logo;
use App\Category;
use App\Http\Libraries\Display_lib;
use App\Http\Controllers\MenuController;
use App\Room;
class MainController extends Controller
{
    //
  /*  public function __construct()
    {
        $this->middleware('auth');
    }*/
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    //Get data from DB
        //menu
        
       /* $data_nav['menu']=MenuController::index('categories');*/

    $data_nav=[];
    $data_content['rooms']=Room::orderBy('created_at', 'desc')
    ->orderBy('updated_at', 'desc')
    ->take(9)->get()->load('photos');

    $data_content['title']="Industry";
        $path='main_page';
        $data['keywords']="Фрилансим по крупному";
        $data['description']="Фрилансим по крупному";

       return Display_lib::index($path,$data,$data_nav,$data_content);
    }

    public function ajax_usersessions(Request $request)
    {

        if ($request->ajax()) {
            print('123');
        }
    }
}
