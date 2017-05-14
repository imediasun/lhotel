<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Good;
use App\Comment;
use App\Photo;
use App\Video;
use App\Like;
use App\Question;
use App\Logo;
use App\Http\Libraries\Display_lib;
use Illuminate\Support\Facades\Auth;
class GoodController extends Controller
{
    public function index($id){
        //Get data from DB

        //menu
        $data_nav['menu']=MenuController::index('categories');
        //logos_of_partners 
        $data_content['logos']=Logo::orderBy('created_at', 'desc')
            ->orderBy('updated_at', 'desc')
            ->take(10)
            ->get();
        //goods
        $data_content['good']=Good::where('id',$id)
        ->get();
        $data_content['photos']=Photo::where('id_good',$id)
            ->get();

        $data_content['video']=Video::where('id_good',$data_content['good'][0]['original']['id'])
            ->get();
        $data_content['comments']=Comment::where('good',$data_content['good'][0]['original']['id'])
            ->get();
        $data_content['questions']=Question::where('good',$data_content['good'][0]['original']['id'])
            ->get()->load('answer');
        if(!Auth::guest()){
        $user=Auth::user()->id;
        
            $data_content['like']=Like::where('id_good',$data_content['good'][0]['original']['id'])
                ->where('id_user',$user)
                ->get();
           /* dd($data_content['like']);*/
        }

        //page
        $data_content['title']="Industry";
        $path='good_page';
        $data['keywords']="Фрилансим по крупному";
        $data['description']="Фрилансим по крупному";
        return Display_lib::good_page($path,$data,$data_nav,$data_content);

    }
}
