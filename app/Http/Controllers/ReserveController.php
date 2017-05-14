<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\OrderShipped;
use Illuminate\Support\Facades\Mail;
class ReserveController extends Controller
{
    //

    public function index(Request $request){

        Mail::to('imediasun@gmail.com')->send(new OrderShipped($request->input()));
        return view('shop.checkout');
    }

    public function send_mail(Request $request){

        Mail::to('imediasun@gmail.com')->send(new OrderShipped_send_mail($request->input()));
        return view('shop.checkout');
    }
}
