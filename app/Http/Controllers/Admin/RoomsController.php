<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gate;
use App\Category;
use App\Type_of_good;
use App\Room;
use App\Photo;
use DateInterval;
use App\Rooms_employment;
use DB;
use App\Calendar_event;
use DateTime;

class RoomsController extends AdminController
{

    public function __construct()
    {
        parent::__construct();


        $this->template = 'admin_page';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        /*$this->user=Auth::user();*/

        if (Gate::denies('VIEW_ADMIN')) {

            abort(403);
        }

        $this->title = 'Панель администратора';
        $data['categories'] = Category::orderBy('parent_id', 'asc')
            ->orderBy('created_at', 'desc')
            ->orderBy('updated_at', 'desc')
            ->get();
        $data['types'] = Type_of_good::get();

        $this->template = 'admin_page/add_good';
        $data['title'] = "Додати товар";
        $data['keywords'] = "Ukrainian industry platform";
        $data['description'] = "Ukrainian industry platform";

        return $this->renderOutput($data);
    }


    public function edit_room_fasade()
    {
        /*$this->user=Auth::user();*/

        if (Gate::denies('VIEW_ADMIN')) {

            abort(403);
        }

        $this->title = 'Панель администратора';
        $data['categories'] = Category::orderBy('parent_id', 'asc')
            ->orderBy('created_at', 'desc')
            ->orderBy('updated_at', 'desc')
            ->get();
        $data['rooms'] = Room::get();
        $this->template = 'admin_page/edit_rooms';
        $data['title'] = "Видалити товар";
        $data['keywords'] = "Ukrainian industry platform";
        $data['description'] = "Ukrainian industry platform";

        return $this->renderOutput($data);
    }

    public function edit_room($id)
    {
        /*$this->user=Auth::user();*/

        if (Gate::denies('VIEW_ADMIN')) {

            abort(403);
        }

        $this->title = 'Панель администратора';
        $data['categories'] = Category::orderBy('parent_id', 'asc')
            ->orderBy('created_at', 'desc')
            ->orderBy('updated_at', 'desc')
            ->get();
        $data['room'] = Room::where('id', $id)
            ->orderBy('created_at', 'desc')
            ->orderBy('updated_at', 'desc')
            ->get();
        $data['photos'] = Photo::where('id_room', $id)
            ->orderBy('created_at', 'desc')
            ->orderBy('updated_at', 'desc')
            ->get();
        $this->template = 'admin_page/edit_room';
        $data['title'] = "Видалити товар";
        $data['keywords'] = "Ukrainian industry platform";
        $data['description'] = "Ukrainian industry platform";

        return $this->renderOutput($data);
    }

    public function view_room($id)
    {
        /*$this->user=Auth::user();*/

        if (Gate::denies('VIEW_ADMIN')) {

            abort(403);
        }

        $this->title = 'Панель администратора';
        $data['categories'] = Category::orderBy('parent_id', 'asc')
            ->orderBy('created_at', 'desc')
            ->orderBy('updated_at', 'desc')
            ->get();
        $data['room'] = Room::where('id', $id)
            ->orderBy('created_at', 'desc')
            ->orderBy('updated_at', 'desc')
            ->get();
        $data['photos'] = Photo::where('id_room', $id)
            ->orderBy('created_at', 'desc')
            ->orderBy('updated_at', 'desc')
            ->get();
        
        $this->template = 'admin_page/view_room';
        $data['title'] = "Информация о номере";
        $data['keywords'] = "Ukrainian industry platform";
        $data['description'] = "Ukrainian industry platform";

        return $this->renderOutput($data);
    }


    public function rooms_prices()
    {
        /*$this->user=Auth::user();*/

        if (Gate::denies('VIEW_ADMIN')) {

            abort(403);
        }

        $this->title = 'Панель администратора';
        $data['categories'] = Category::orderBy('parent_id', 'asc')
            ->orderBy('created_at', 'desc')
            ->orderBy('updated_at', 'desc')
            ->get();
        $data['rooms'] = Room::get();
        $this->template = 'admin_page/rooms_prices';
        $data['title'] = "Видалити товар";
        $data['keywords'] = "Ukrainian industry platform";
        $data['description'] = "Ukrainian industry platform";

        return $this->renderOutput($data);
    }

    public function room_employment()
    {
        /*$this->user=Auth::user();*/

        if (Gate::denies('VIEW_ADMIN')) {

            abort(403);
        }

        $this->title = 'Панель администратора';
        $data['categories'] = Category::orderBy('parent_id', 'asc')
            ->orderBy('created_at', 'desc')
            ->orderBy('updated_at', 'desc')
            ->get();
        $data['rooms'] = Room::get();
        $this->template = 'admin_page/room_employment';
        $data['title'] = "Видалити товар";
        $data['keywords'] = "Ukrainian industry platform";
        $data['description'] = "Ukrainian industry platform";

        return $this->renderOutput($data);
    }

    public function employ_room($id)
    {
        /*$this->user=Auth::user();*/

        if (Gate::denies('VIEW_ADMIN')) {

            abort(403);
        }

        $this->title = 'Панель администратора';
        $data['categories'] = Category::orderBy('parent_id', 'asc')
            ->orderBy('created_at', 'desc')
            ->orderBy('updated_at', 'desc')
            ->get();
        $data['room'] = $id;
        $this->template = 'admin_page/employ_room';
        $data['title'] = "Видалити товар";
        $data['keywords'] = "Ukrainian industry platform";
        $data['description'] = "Ukrainian industry platform";

        return $this->renderOutput($data);
    }

    public function setting_price(Request $request)
    {
        foreach ($_POST as $key => $val) {
            $rest = substr($key, 0, 5);
            if ($rest == 'check') {
                $room[] = $val;
            }
        }
        foreach ($room as $val) {


            //посчитать количество дней в диапозоне
            $datetime1 = date_create(date("Y-m-d", strtotime($_POST['start'])));
            $datetime2 = date_create(date("Y-m-d", strtotime($_POST['end'])));
            $interval = date_diff($datetime1, $datetime2);

            //на каждый день из диапозона создать запись в таблице
            for ($i = 0; $i < ($interval->days) + 1; $i++) {
                $date = date_format($datetime1, 'Y-m-d');
                dump($date);
                $data['rooms_set_up_price'] = Rooms_employment::where('room_id', $val)
                    ->where('employment', 0)
                    ->where('data', $date)
                    ->orderBy('created_at', 'desc')
                    ->orderBy('updated_at', 'desc')
                    ->get();

                $set_up = [
                    'data' => $date,
                    'room_id' => $val,
                    'title' => ' ',
                    'price_per_day' => $_POST['price']
                ];

                if ($data['rooms_set_up_price']->count() > 0) {

                    DB::table('rooms_employments')->where('room_id', $val)->where('data', $date)->update($set_up);

                } else {
                    DB::table('rooms_employments')->insert($set_up);

                }
                $datetime1 = $datetime1->add(new DateInterval('P1D'));
            }
        }
        return redirect()->route('prices_added');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */




    public function get_calendar_data()
    {

        $rooms_set_up_price = Calendar_event::where('room_id', $_POST['room_id'])
            ->orderBy('created_at', 'desc')
            ->orderBy('updated_at', 'desc')
            ->get();


$i=0;
        foreach ($rooms_set_up_price as $value) {
            $rooms[$i] = $value['original'];

            if($value['original']['event_id']>=0){

            $date_end = new DateTime($value['original']['end_data']);
            $date_end->modify('+1 day');
            $date_end=$date_end->format("Y-m-d");
            $rooms[$i]['end_data']=$date_end;

        }

$i++;
        }

        //теперь делим на непересекающиеся времянные отрезки
        //проходимся циклом по всем существующим временным отрезкам
        //и пишем в новый элемент массива
        //выводить старт дата а енд дата запоминать во временную переменную
        // и перетерать до тех пор пока не встретится среди
        //всего массива дат старт дата в которой created or updated time новее
        //таким образом предыдущая дата от старт_дата от следующей итерации
        //становится end_data текущей
        //как только end_data записана переходим к новой итерации

        echo json_encode($rooms);
    }
   /* public function put_calendar_data(Request $request)
    {


        if ($request->type == 'sold') {
            $employment = 1;
        }
        if ($request->type == 'booked') {
            $employment = 2;
        }
        if ($request->type == 'free') {
            $employment = 0;
        }

        $datetime1 = date_create(date("Y-m-d", strtotime($request->start)));
        $datetime2 = date_create(date("Y-m-d", strtotime($request->end)));
        $interval = date_diff($datetime1, $datetime2);

        //на каждый день из диапозона создать запись в таблице
        for ($i = 0; $i < ($interval->days); $i++) {
            $date = date_format($datetime1, 'Y-m-d');

            $data['rooms_set_up_price'] = Rooms_employment::where('data', $date)
                ->where('room_id', $request->room_id)
                ->orderBy('created_at', 'desc')
                ->orderBy('updated_at', 'desc')
                ->get();
            dump($data['rooms_set_up_price']);
            $set_up = [
                'data' => $date,
                'room_id' => $request->room_id,
                'title' => $request->title,
                'price_per_day' => $request->price_per_day,
                'employment' => $employment
            ];

            if ($data['rooms_set_up_price']->count() > 0) {

                DB::table('rooms_employments')->where('room_id', $request->room_id)->where('data', $date)->update($set_up);

            } else {
                DB::table('rooms_employments')->insert($set_up);

            }
            $datetime1 = $datetime1->add(new DateInterval('P1D'));
        }
        echo json_encode(true);
    }*/

    public function delete_calendar_data(Request $request)
    {
        DB::table('calendar_events')->where('id', $request->id)
        ->delete();
        echo json_encode(true);
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
public function new_event(Request $request){


    $set_up = [
        'id' => NULL,
        'start_data' => date_create(date("Y-m-d", strtotime($request->start_data))),
        'end_data' => date_create(date("Y-m-d", strtotime($request->end_data))),
        'room_id' => $request->room_id,
        'title' => $title = (empty($request->title)) ? '' : $request->title,
        'price_per_day' => $request->price_per_day,
        'type' => $request->type,
        'class_name'=> $request->class_name,
    ];
    $this->add_new_if_not_exist($set_up);
    return json_encode (true);

}




    private function add_new_if_not_exist($set_up){

        $cto=DB::table('calendar_events')->where('start_data','=',$set_up['start_data'])
            ->where('end_data','=',$set_up['end_data'])
            ->get();
        if($cto->count()==0) {
            DB::table('calendar_events')->insert($set_up);
        }
return;
    }

    public function update_room_info(Request $request){


    }
    public function setting_room_price(Request $request)
    {
        if(!isset($request->room_id)){
        foreach ($request->request as $key => $val) {

            $rest = substr($key, 0, 5);
            if ($rest == 'check') {
                $rooms[] = $val;
            }
        }
        $set_up['event_id']=0;
        }
        else{
        $set_up['event_id']=1;
        $rooms[]= $request->room_id;
       $date_end = new DateTime($request->end);
        $date_end->modify('-1 day');
        $date_end=$date_end->format("Y-m-d");
        $request->end=$date_end;
        $tr=true;
        }

        $date1 = date_create(date("Y-m-d", strtotime($request->start)));
        $date2 = date_create(date("Y-m-d", strtotime($request->end)));

        foreach ($rooms as $val) {
        //записать диапозон в базу данных для каждого номера
//находим в базе запись в диапозоне которой присутствует start_data
            $data['rooms_set_up_price_10c'] = Calendar_event::where('start_data','<',$date1)
                ->where('end_data','>',$date2)
                ->where('room_id', $val)
                ->orderBy('created_at', 'desc')
                ->orderBy('updated_at', 'desc')
                ->get();
            $data['rooms_set_up_price_1c'] = Calendar_event::where('start_data','=',$date2)
                ->where('end_data','>',$date2)
                ->where('room_id', $val)
                ->orderBy('created_at', 'desc')
                ->orderBy('updated_at', 'desc')
                ->get();
            $data['rooms_set_up_price_4c'] = Calendar_event::where('start_data','>',$date1)
                ->where('end_data','<',$date2)
                ->where('room_id', $val)
                ->orderBy('created_at', 'desc')
                ->orderBy('updated_at', 'desc')
                ->get();
            $data['rooms_set_up_price_6c'] = Calendar_event::where('start_data','<',$date1)
                ->where('end_data','>',$date1)
                ->where('start_data','<',$date2)
                ->where('end_data','<',$date2)
                ->where('room_id', $val)
                ->orderBy('created_at', 'desc')
                ->orderBy('updated_at', 'desc')
                ->get();
            $data['rooms_set_up_price_8c'] = Calendar_event::where('start_data','>',$date1)
                ->where('end_data','>',$date1)
                ->where('start_data','<',$date2)
                ->where('end_data','>',$date2)
                ->where('room_id', $val)
                ->orderBy('created_at', 'desc')
                ->orderBy('updated_at', 'desc')
                ->get();
            $data['rooms_set_up_price_3c'] = Calendar_event::where('start_data','=',$date1)
                ->where('end_data','=',$date2)
                ->where('room_id', $val)
                ->orderBy('created_at', 'desc')
                ->orderBy('updated_at', 'desc')
                ->get();
            $data['rooms_set_up_price_2c'] = Calendar_event::where('start_data','=',$date1)
                ->where('end_data','>',$date2)
                ->where('room_id', $val)
                ->orderBy('created_at', 'desc')
                ->orderBy('updated_at', 'desc')
                ->get();
            $data['rooms_set_up_price_5b'] = Calendar_event::where('start_data','<',$date1)
                ->where('end_data','=',$date1)
                ->where('room_id', $val)
                ->orderBy('created_at', 'desc')
                ->orderBy('updated_at', 'desc')
                ->get();
            $data['rooms_set_up_price_7c'] = Calendar_event::where('start_data','=',$date1)
                ->where('end_data','<',$date2)
                ->where('room_id', $val)
                ->orderBy('created_at', 'desc')
                ->orderBy('updated_at', 'desc')
                ->get();
            $data['rooms_set_up_price_7b'] = Calendar_event::where('start_data','>',$date1)
                ->where('end_data','=',$date2)
                ->where('room_id', $val)
                ->orderBy('created_at', 'desc')
                ->orderBy('updated_at', 'desc')
                ->get();
            $data['rooms_set_up_price_9c'] = Calendar_event::where('end_data','=',$date1)
                ->where('end_data','!=',$date2)
                ->where('room_id', $val)
                ->orderBy('created_at', 'desc')
                ->orderBy('updated_at', 'desc')
                ->get();

            //вмещающаяся запись (возможен ли массив вмещающихся записей)
            /*dd($data['rooms_set_up_price']);*/

            //получили
            $type = (empty($request->type)) ? 'free' : $request->type;

            switch ($type){

                case 'free':
                $class_name='blue';
                break;
                case 'booked':
                $class_name='mint';
                break;
                case 'sold':
                $class_name='warning';
                break;
            }
//
            if ($data['rooms_set_up_price_10c']->count() > 0) {
             
            $set_up=$data['rooms_set_up_price_10c'][0]['original'];
            //задать даты вмещающей записи и обновить ее
                //записывам 'start_data' => $out_date1,'end_data' => ($ins_date1)-1,
            /*$set_up['start_data']=$out_date1=$data['rooms_set_up_price']['start_data'];*/
                $date1_1 = new DateTime($request->start);
                $date1_1->modify('-1 day');
                $date1_1=$date1_1->format("Y-m-d");
            $set_up['end_data']=$ins_date1_1=$date1_1;

            //и обновляем текущую запись в базе
            DB::table('calendar_events')->where('room_id', $val)
            ->where('start_data','<',$date1)
            ->where('end_data','>',$date2)
            ->update($set_up);
            //потом инсертить вмещающуюся запись
                //записывам 'start_data' => $ins_date2__1,'end_data' => $out_date2,

                $set_up = [
                    'id' => NULL,
                    'start_data' => $date1,
                    'end_data' => $date2,
                    'room_id' => $val,
                    'title' => $title = (empty($request->title)) ? '' : $request->title,
                    'price_per_day' => $request->price_per_day,
                    'type' => $type,
                    'class_name'=> $class_name,
                ];
                $set_up['start_data']=$ins_date1=$date1;
                $set_up['end_data']=$ins_date2=$date2;
                $this->add_new_if_not_exist($set_up);
                unset ($cto);
                //потом инсертить хвост вмещающей записи
                //записывам 'start_data' => ($ins_date2)+1,'end_data' => $out_date2,
                $set_up=$data['rooms_set_up_price_10c'][0]['original'];
                $date1_1 = new DateTime($request->end);
                $date1_1->modify('+1 day');
                $date1__1=$date1_1->format("Y-m-d");
                $set_up['start_data']=$ins_date1_1=$date1__1;
                /*$set_up['end_data']=$out_date2=$data['rooms_set_up_price_10c'][0]['original']['end_data'];
                $set_up['price_per_day']=$data['rooms_set_up_price_10c'][0]['original']['price_per_day'];*/
                $set_up['id']=NULL;
                $this->add_new_if_not_exist($set_up);



            }
           if($data['rooms_set_up_price_1c']->count() > 0){

                $set_up=$data['rooms_set_up_price_1c'][0]['original'];
                //задать даты вмещающей записи и обновить ее
                //записывам 'start_data' => $ins_date2+1,'end_data' => ($out_date2),

                $date1_1 = new DateTime($request->end);
                $date1_1->modify('+1 day');
                $date1_1=$date1_1->format("Y-m-d");
                $set_up['start_data']=$ins_date2__1=$date1_1;


                //и обновляем текущую запись в базе
                DB::table('calendar_events')->where('room_id', $val)
                    ->where('start_data','=',$date2)
                    ->where('end_data','>',$date2)
                    ->update($set_up);
                //потом инсертить вмещающуюся запись
                //записывам 'start_data' => $ins_date2__1,'end_data' => $out_date2,

                $set_up = [
                    'id' => NULL,
                    'start_data' => $date1,
                    'end_data' => $date2,
                    'room_id' => $val,
                    'title' => $title = (empty($request->title)) ? '' : $request->title,
                    'price_per_day' => $request->price_per_day,
                    'type' => $type,
                    'class_name'=> $class_name,
                ];
                $set_up['start_data']=$ins_date1=$date1;
                $set_up['end_data']=$ins_date2=$date2;

               $this->add_new_if_not_exist($set_up);

            }
           if($data['rooms_set_up_price_4c']->count() > 0){


              //и обновляем текущую запись в базе
                DB::table('calendar_events')->where('room_id', $val)
                    ->where('start_data','>',$date1)
                    ->where('end_data','<',$date2)
                    ->delete();
                //потом инсертить вмещающуюся запись
                //записывам 'start_data' => $ins_date2__1,'end_data' => $out_date2,

                $set_up = [
                    'id' => NULL,
                    'start_data' => $date1,
                    'end_data' => $date2,
                    'room_id' => $val,
                    'title' => $title = (empty($request->title)) ? '' : $request->title,
                    'price_per_day' => $request->price_per_day,
                    'type' => $type,
                    'class_name'=> $class_name,
                ];
                $set_up['start_data']=$ins_date1=$date1;
                $set_up['end_data']=$ins_date2=$date2;
               $this->add_new_if_not_exist($set_up);

            }if($data['rooms_set_up_price_6c']->count() > 0){

                $set_up=$data['rooms_set_up_price_6c'][0]['original'];
                $date1_1 = new DateTime($request->start);
                $date1_1->modify('-1 day');
                $date1_1=$date1_1->format("Y-m-d");
                $set_up['end_data']=$ins_date2__1=$date1_1;

                //и обновляем текущую запись в базе
                DB::table('calendar_events')->where('start_data','<',$date1)
                    ->where('end_data','>',$date1)
                    ->where('start_data','<',$date2)
                    ->where('end_data','<',$date2)
                    ->where('room_id', $val)
                    ->orderBy('created_at', 'desc')
                    ->orderBy('updated_at', 'desc')
                    ->update($set_up);
                //потом инсертить вмещающуюся запись
                //записывам 'start_data' => $ins_date2__1,'end_data' => $out_date2,



                $set_up = [
                    'id' => NULL,
                    'start_data' => $date1,
                    'end_data' => $date2,
                    'room_id' => $val,
                    'title' => $title = (empty($request->title)) ? '' : $request->title,
                    'price_per_day' => $request->price_per_day,
                    'type' => $type,
                    'class_name'=> $class_name,
                ];
                $set_up['start_data']=$ins_date1=$date1;
                $set_up['end_data']=$ins_date2=$date2;
                $this->add_new_if_not_exist($set_up);



            }if($data['rooms_set_up_price_8c']->count() > 0){

                DB::table('calendar_events')->where('start_data','=',$date1)
                    ->where('end_data','<',$date2)
                    ->where('room_id', $val)
                    ->delete();
                $set_up=$data['rooms_set_up_price_8c'][0]['original'];
                $date1_1 = new DateTime($request->end);
                $date1_1->modify('+1 day');
                $date1_1=$date1_1->format("Y-m-d");
                $set_up['start_data']=$ins_date2__1=$date1_1;

                //и обновляем текущую запись в базе
                DB::table('calendar_events')->where('start_data','>',$date1)
                    ->where('end_data','>',$date1)
                    ->where('start_data','<',$date2)
                    ->where('end_data','>',$date2)
                    ->where('room_id', $val)
                    ->orderBy('created_at', 'desc')
                    ->orderBy('updated_at', 'desc')
                    ->update($set_up);
                //потом инсертить вмещающуюся запись
                //записывам 'start_data' => $ins_date2__1,'end_data' => $out_date2,



                $set_up = [
                    'id' => NULL,
                    'start_data' => $date1,
                    'end_data' => $date2,
                    'room_id' => $val,
                    'title' => $title = (empty($request->title)) ? '' : $request->title,
                    'price_per_day' => $request->price_per_day,
                    'type' => $type,
                    'class_name'=> $class_name,
                ];
                $set_up['start_data']=$ins_date1=$date1;
                $set_up['end_data']=$ins_date2=$date2;

                $this->add_new_if_not_exist($set_up);



            }if($data['rooms_set_up_price_3c']->count() > 0){

                $set_up = [

                    'start_data' => $date1,
                    'end_data' => $date2,
                    'room_id' => $val,
                    'title' => $title = (empty($request->title)) ? '' : $request->title,
                    'price_per_day' => $request->price_per_day,
                    'type' => $type,
                    'class_name'=> $class_name,
                ];

                //и обновляем текущую запись в базе
                DB::table('calendar_events')->where('start_data','=',$date1)
                    ->where('end_data','=',$date2)
                    ->where('room_id', $val)
                    ->orderBy('created_at', 'desc')
                    ->orderBy('updated_at', 'desc')
                    ->update($set_up);




            }if($data['rooms_set_up_price_2c']->count() > 0){



                $set_up=$data['rooms_set_up_price_2c'][0]['original'];
                $date1_1 = new DateTime($request->end);
                $date1_1->modify('+1 day');
                $date1_1=$date1_1->format("Y-m-d");
                $set_up['start_data']=$ins_date2__1=$date1_1;

                //и обновляем текущую запись в базе
                DB::table('calendar_events')->where('start_data','=',$date1)
                    ->where('end_data','>',$date2)
                    ->where('room_id', $val)
                    ->orderBy('created_at', 'desc')
                    ->orderBy('updated_at', 'desc')
                    ->update($set_up);
                //потом инсертить вмещающуюся запись
                //записывам 'start_data' => $ins_date2__1,'end_data' => $out_date2,



                $set_up = [
                    'id' => NULL,
                    'start_data' => $date1,
                    'end_data' => $date2,
                    'room_id' => $val,
                    'title' => $title = (empty($request->title)) ? '' : $request->title,
                    'price_per_day' => $request->price_per_day,
                    'type' => $type,
                    'class_name'=> $class_name,
                ];
                $set_up['start_data']=$ins_date1=$date1;
                $set_up['end_data']=$ins_date2=$date2;

                $this->add_new_if_not_exist($set_up);



            }

            if($data['rooms_set_up_price_7c']->count() > 0){


                DB::table('calendar_events')->where('start_data','=',$date1)
                    ->where('end_data','<',$date2)
                    ->where('room_id', $val)
                    ->orderBy('created_at', 'desc')
                    ->orderBy('updated_at', 'desc')
                    ->delete();

                $set_up = [
                    'id' => NULL,
                    'start_data' => $date1,
                    'end_data' => $date2,
                    'room_id' => $val,
                    'title' => $title = (empty($request->title)) ? '' : $request->title,
                    'price_per_day' => $request->price_per_day,
                    'type' => $type,
                    'class_name'=> $class_name,
                ];
                $set_up['start_data']=$ins_date1=$date1;
                $set_up['end_data']=$ins_date2=$date2;

                $this->add_new_if_not_exist($set_up);


            }
            if($data['rooms_set_up_price_7b']->count() > 0){


                DB::table('calendar_events')->where('start_data','>',$date1)
                    ->where('end_data','=',$date2)
                    ->where('room_id', $val)
                    ->orderBy('created_at', 'desc')
                    ->orderBy('updated_at', 'desc')
                    ->delete();

                $set_up = [
                    'id' => NULL,
                    'start_data' => $date1,
                    'end_data' => $date2,
                    'room_id' => $val,
                    'title' => $title = (empty($request->title)) ? '' : $request->title,
                    'price_per_day' => $request->price_per_day,
                    'type' => $type,
                    'class_name'=> $class_name,
                ];
                $set_up['start_data']=$ins_date1=$date1;
                $set_up['end_data']=$ins_date2=$date2;

                $this->add_new_if_not_exist($set_up);


            }
            if($data['rooms_set_up_price_9c']->count() > 0){


                $set_up=$data['rooms_set_up_price_9c'][0]['original'];
                $date1_1 = new DateTime($request->start);
                $date1_1->modify('-1 day');
                $date1_1=$date1_1->format("Y-m-d");
                $set_up['end_data']=$ins_date2__1=$date1_1;

                //и обновляем текущую запись в базе
                DB::table('calendar_events')->where('end_data','=',$date1)
                    ->where('room_id', $val)
                    ->orderBy('created_at', 'desc')
                    ->orderBy('updated_at', 'desc')
                    ->update($set_up);

                $set_up = [
                    'id' => NULL,
                    'start_data' => $date1,
                    'end_data' => $date2,
                    'room_id' => $val,
                    'title' => $title = (empty($request->title)) ? '' : $request->title,
                    'price_per_day' => $request->price_per_day,
                    'type' => $type,
                    'class_name'=> $class_name,
                ];
                $set_up['start_data']=$ins_date1=$date1;
                $set_up['end_data']=$ins_date2=$date2;

                $this->add_new_if_not_exist($set_up);


            }
            if($data['rooms_set_up_price_10c']->count() == 0 &&
                $data['rooms_set_up_price_6c']->count() == 0 &&
                $data['rooms_set_up_price_4c']->count() == 0 &&
                $data['rooms_set_up_price_1c']->count() == 0 &&
                $data['rooms_set_up_price_8c']->count() == 0 &&
                $data['rooms_set_up_price_3c']->count() == 0 &&
                $data['rooms_set_up_price_2c']->count() == 0 &&
                $data['rooms_set_up_price_5b']->count() == 0 &&
                $data['rooms_set_up_price_7c']->count() == 0 &&
                $data['rooms_set_up_price_7b']->count() == 0 &&
                $data['rooms_set_up_price_9c']->count() == 0




            )
            {
                $set_up = [
                    'start_data' => $date1,
                    'end_data' => $date2,
                    'room_id' => $val,
                    'title' => $title = (empty($request->title)) ? '' : $request->title,
                    'price_per_day' => $request->price_per_day,
                    'type' => $type,
                    'class_name'=> $class_name,
                ];
            DB::table('calendar_events')->insert($set_up);
            }

        }
        if(isset($tr)){
        return json_encode(true);

        }
        else{
        return redirect()->route('prices_added');
        }



    }


    public function put_calendar_data(Request $request)
    {
dd($request);

        $datetime1 = date_create(date("Y-m-d", strtotime($request->start)));
        $datetime2 = date_create(date("Y-m-d", strtotime($request->end)));
        $interval = date_diff($datetime1, $datetime2);

        //на каждый день из диапозона создать запись в таблице
        for ($i = 0; $i < ($interval->days); $i++) {
            $date = date_format($datetime1, 'Y-m-d');

            $data['rooms_set_up_price'] = Rooms_employment::where('data', $date)
                ->where('room_id', $request->room_id)
                ->orderBy('created_at', 'desc')
                ->orderBy('updated_at', 'desc')
                ->get();
            dump($data['rooms_set_up_price']);
            $set_up = [
                'data' => $date,
                'room_id' => $request->room_id,
                'title' => $request->title,
                'price_per_day' => $request->price_per_day,
                'employment' => $employment
            ];

            if ($data['rooms_set_up_price']->count() > 0) {

                DB::table('rooms_employments')->where('room_id', $request->room_id)->where('data', $date)->update($set_up);

            } else {
                DB::table('rooms_employments')->insert($set_up);

            }
            $datetime1 = $datetime1->add(new DateInterval('P1D'));
        }
        echo json_encode(true);
    }
}
