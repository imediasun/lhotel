<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Photo;
use App\Http\Libraries\Display_lib;
use App\Room;
class RoomController extends Controller
{
    //
    public function index($id)
    {
        //Get data from DB
        //menu

        /* $data_nav['menu']=MenuController::index('categories');*/

        $data_nav=[];
        $data_content['rooms']=Room::orderBy('created_at', 'desc')
            ->orderBy('updated_at', 'desc')
            ->take(9)->get();

        $data_content['room_photos']=Room::where('id',$id)
        ->orderBy('created_at', 'desc')
        ->orderBy('updated_at', 'desc')
        ->get()->load('photos');
        $data_content['photos']=Photo::where('id_room',$id)
            ->orderBy('created_at', 'desc')
            ->orderBy('updated_at', 'desc')
            ->get();
        $data_content['room']=$data_content['room_photos'][0]->id;
        $data_content['room_photos']=$data_content['room_photos'][0];

        $data_content['title']="Industry"; 
        $path='room_page';
        $data['keywords']="Фрилансим по крупному";
        $data['description']="Фрилансим по крупному"; 

        return Display_lib::photos($path,$data,$data_nav,$data_content);
    }
}
