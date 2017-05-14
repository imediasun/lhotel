<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Libraries\Display_lib;
use App\Room;
class ArticleController extends Controller
{
    public function index()
    {
        //Get data from DB
        //menu

        /* $data_nav['menu']=MenuController::index('categories');*/

        $data_nav=[];
        $data_content['rooms']=Room::orderBy('created_at', 'desc')
            ->orderBy('updated_at', 'desc')
           ->get();

        $data_content['title']="Industry";
        $path='article_page'; 
        $data['keywords']="Фрилансим по крупному";
        $data['description']="Фрилансим по крупному";

        return Display_lib::article($path,$data,$data_nav,$data_content);
    }
}
