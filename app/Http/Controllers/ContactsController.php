<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;
use App\Http\Libraries\Display_lib;
class ContactsController extends Controller
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

        $data_content['title']="Lhotel";
        $path='contacts_page';
        $data['keywords']="Отдых у моря в Черноморске";
        $data['description']="Отдых у моря в Черноморске";

        return Display_lib::article($path,$data,$data_nav,$data_content);
    }
}
