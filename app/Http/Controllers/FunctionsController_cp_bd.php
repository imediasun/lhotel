<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Good;
use DB;
use Intervention\Image\Facades\Image;
use Illuminate\Http\RedirectResponse;
use App\Http\Libraries\Display_lib;
use Auth;
use App\Room;
use App\Temporary_main_photo;
use App\Temporary_photo;
class FunctionsController extends Controller
{
    //
  /*  public function __construct(){
        $this->middleware('guest');
    }*/
    private static $num;
    public function index(Request $request){



    if(!empty($_FILES)) {
        dump(session()->all());
        // Файл передан через обычный массив $_FILES
        echo 'Contents of $_FILES:<br/><pre>'.print_r($_FILES, true).'</pre>';
        $file = $_FILES['my-pic'];
        $file_name=$file['name'];
        $ppos = strrpos($file_name, '.');
        $file_name = substr($file_name, 0, $ppos).'('.md5(uniqid(rand(),1)).').'.substr($file_name, $ppos + 1);

        $tmp_name=$file['tmp_name'];
        $uploads_dir='photos';
        $upload=$uploads_dir.'/'.$file_name;



        //"$uploads_dir/$file_name"
        move_uploaded_file($tmp_name,$upload );
        $this->resize_($upload,$uploads_dir,$file_name,'file_name');

        /* $data['img']='/photos/'.$file_name;
        $this->baget_model->insert($data); */
        // Внимание! Имя файла для Blob-данных может различаться в разных браузерах
        if ( ($file['type'] == 'image/png') && ($file['name'] == 'blob') ) {
            //move_uploaded_file($file['tmp_name'], './canvas-' . uniqid() . '.png');
        }
    }
}

private function resize_($upload,$uploads_dir,$file_name,$process){
    //resize of the images
    //image1_small
    $image_info = getimagesize($upload);
    $img_width=$image_info[0];
    $img_height=$image_info[1];
    //проверяем больше ли ширена высоты
    //если больше меняем ширену и высоту
    //real 305x427
    //500х335  (1,4925)
$uploads[0]=[
        'upload' => $upload,
        'name'=>'thumbnail',
        'width'  => 250,
        'height'=> 167,
    ];
$uploads[1]=[
    'upload' => $upload,
    'name'=>'image_xs',
    'width'  => 1280,
    'height'=> 853,
    ];
$uploads[2]=[
    'upload' => $upload,
    'name'=>'image',
    'width'  => 1500,
    'height'=> 1000,
    ];


    foreach ($uploads as $key=>$up){
        if($img_height>$img_width) {
            $ratio_img=$image_info[1]/$image_info[0];//1,4


            $img = Image::make($up['upload']);
// resize image instance
            $img->resize($up['height']/$ratio_img, $up['height']); //1,4
// set a background-color for the emerging area
            $img->resizeCanvas($up['width'], $up['height'], 'center', false, 'fff');
// insert a watermark
// save image in desired format
            $img->save($uploads_dir.'/'.$file_name);
            $this->kind($process,$up['name'],$up['name'].$file_name);
}
        if($img_height<$img_width ) {
            $ratio_img=$image_info[0]/$image_info[1];//1,4

            $img = Image::make($up['upload']);
// resize image instance
//image1_small
//500х335  (1,4925)
            $img->resize($up['width'], $up['width']/$ratio_img); //1,4
// set a background-color for the emerging area
            $img->resizeCanvas( $up['width'],$up['height'], 'center', false, 'fff');
// insert a watermark
// save image in desired format
            $img->save($uploads_dir.'/'.$file_name);
            $this->kind($process,$up['name'],$up['name'].$file_name);

        }
        if($img_height==$img_width ) {
           $img = Image::make($up['upload']);
// resize image instance
//image1_small
//500х335  (1,4925)
            $img->resize($up['height'], $up['height']); //1,4
// set a background-color for the emerging area
            $img->resizeCanvas( $up['width'],$up['height'], 'center', false, 'fff');
// insert a watermark
// save image in desired format
            $img->save($uploads_dir.'/'.$file_name);
            $this->kind($process,$up['name'],$up['name'].$file_name);

        }


    }


}


    private function kind($process,$type,$imag)
    {

        //нам необходимо свойство класса заменить на сессионную переменную


        if ($process == 'file_name_main_image') {
            $last_room = Room::all()
                ->last();
            if (empty($last_room)) {
                $last_room = 0;
            }
            //посмотреть в таблицу номеров и достать последнюю запись
            $temporary_set = [
                'id_room' => $last_room + 1
            ];
            if ($type == 'thumbnail') {
                $temporary_set['thumbnail'] = $imag;
            }
            if ($type == 'image_xs') {
                $temporary_set['image_xs'] = $imag;
            }
            if ($type == 'image') {
                $temporary_set['image'] = $imag;
            }

            $last_temp = Temporary_main_photo::all()
                ->last();
            if (!empty($last_temp)) {
                $last_temp = 1;
            } else {
                $last_temp = 0;
            }
            if ($last_temp == 0) {
                DB::table('temporary_main_photos')->insert(
                    $temporary_set
                );
            } else {
                DB::table('temporary_main_photos')->update(
                    $temporary_set
                );

            }

            //записать в промежуточную таблицу main_image под следующим номером
        } else {
            $last_room = Room::all()
                ->last();
            if (empty($last_room)) {
                $last_room = 0;
            }
            //посмотреть в таблицу номеров и достать последнюю запись
            $temporary_set = [
                'id_room' => $last_room + 1
            ];
            if ($type == 'thumbnail') {
                $temporary_set['thumbnail'] = $imag;
            }
            if ($type == 'image_xs') {
                $temporary_set['image_xs'] = $imag;
            }
            if ($type == 'image') {
                $temporary_set['image'] = $imag;
            }
            $last_temp = Temporary_photo::all()
            ->last();
            $last_tmp = 1;
            dump($last_temp);
            if (!empty($last_temp) && ($last_temp['original']['thumbnail']=='0' || $last_temp['original']['image_xs']=='0' || $last_temp['original']['image']=='0')) {
                $last_tmp = 0;
            }
            
            dump($last_tmp);
            if ($last_tmp == 1) {
                DB::table('temporary_photos')->insert($temporary_set);
            }
            else {
                DB::table('temporary_photos')->update($temporary_set);
            }
        }
    }























    public function main_image(Request $request){

        if(!empty($_FILES)) {

            // Файл передан через обычный массив $_FILES
            echo 'Contents of $_FILES:<br/><pre>'.print_r($_FILES, true).'</pre>';
            $file = $_FILES['my-pic'];
            $file_name=$file['name'];
            $ppos = strrpos($file_name, '.');
            $file_name = substr($file_name, 0, $ppos).'('.md5(uniqid(rand(),1)).').'.substr($file_name, $ppos + 1);

            $tmp_name=$file['tmp_name'];
            $uploads_dir='photos';
            $upload=$uploads_dir.'/'.$file_name;

            move_uploaded_file($tmp_name, "$uploads_dir/$file_name");
            $this->resize_($upload,$uploads_dir,$file_name,'file_name_main_image');

            // Внимание! Имя файла для Blob-данных может различаться в разных браузерах
            if ( ($file['type'] == 'image/png') && ($file['name'] == 'blob') ) {
                //move_uploaded_file($file['tmp_name'], './canvas-' . uniqid() . '.png');
            }
        }
    }

 public function form(Request $request){
        if ($request->ajax()) {
        $main_array=$request->input();

        }

     $main_array=$_POST;
//Add photos
    if(!empty(session('file_name'))){
        $data_m = Good::all();
        $last_data_object = collect($data_m)->last();

        $last_data_object =$last_data_object['original']['id'];

        foreach (session('file_name') as $key=> $photo) {
            
            $photo_set[] = [
                'id' => NULL,
                'id_good'  => $last_data_object+1,
                'image_small'    => $photo['image_small'],
                'image_medium'    => $photo['image_medium'],
                'image_large'    => $photo['image_large'],
                'thumbnail'    => $photo['image_thumbnail'],
            ];

        }

        DB::table('photos')->insert($photo_set);

    }
//Add videos
if(!empty($main_array['video1']) ){
    $check=1;

    $video_set[0]=[
        'id' => NULL,
        'id_good'  => $last_data_object+1,
        'video'=> $main_array['video1']

    ];

}
if(!empty($main_array['video2'])){
    $check=1;
     $video_set[1]=[
         'id' => NULL,
         'id_good'  => $last_data_object+1,
         'video'=> $main_array['video2']

     ];}
if(!empty($main_array['video3'])){
    $check=1;
     $video_set[2]=[
         'id' => NULL,
         'id_good'  => $last_data_object+1,
         'video'=> $main_array['video3']

     ];}
if(!empty($main_array['video4'])){
    $check=1;
     $video_set[3]=[
         'id' => NULL,
         'id_good'  => $last_data_object+1,
         'video'=> $main_array['video4']

     ];}
     if(isset($check) && $check==1){
         DB::table('videos')->insert($video_set);
     }

//Add goods_
     $main_image=session('file_name_main_image');

         $dataSet['type'] = $main_array['type'];
         $dataSet['category'] = $main_array['category'];
         $dataSet['articul'] = $main_array['artikul'];
         $dataSet['description'] = $main_array['editor1'];
     $dataSet['description2'] = $main_array['editor2'];
         $dataSet['name'] = $main_array['name'];
         $dataSet['price'] = $main_array['price'];
         $dataSet['image_small']=$main_image[0]['image_small'];
     $dataSet['image_medium']=$main_image[0]['image_medium'];
     $dataSet['image_large']=$main_image[0]['image_large'];
     $dataSet['thumbnail']=$main_image[0]['image_thumbnail'];
     DB::table('goods')->insert($dataSet);


     return redirect()->route('good_added');
    
    }

    public function role(Request $request){
        
        if ($request->ajax()) {
         $inp_array=$request->input();
//поменять роль
         DB::table('role_user')-> where('user_id', $inp_array['user'])

                ->update(['role_id' => $inp_array['role']]);


        }
        
    }
    public function delete_user(Request $request){

    if ($request->ajax()) {
        $inp_array=$request->input();
//поменять роль
        $del_role_user=DB::table('role_user')-> where('user_id', $inp_array['user'])
            ->delete();
        $del_user= DB::table('users')-> where('id', $inp_array['user'])
            ->delete();
        if($del_role_user && $del_user){
            echo json_encode('deleted');

        }
        else{ echo json_encode('not_deleted');}


    }

}

    public function delete_good(Request $request){

        if ($request->ajax()) {
            $inp_array=$request->input();

            $del_good= DB::table('goods')-> where('id', $inp_array['good'])
                ->delete();
            if($del_good){
                echo json_encode('deleted');

            }
            else{ echo json_encode('not_deleted');}


        }

    }

    public function addComment(Request $request){
    if ($request->isMethod('post')) {
        if(Auth::user()){

            $comment_set=[
                'good'=>$_POST['id_good'],
                'added'=>Auth::user()->id,
                'text'=>$_POST['editor_comment']];
            DB::table('comments')->insert($comment_set);
            return view('comments.success',['id_good'=>$_POST['id_good']]);
        }
        else{
            return view('comments.exeption');
        }

    }


}
    public function addQuestion(Request $request){
        if ($request->isMethod('post')) {
            if(Auth::user()){

                $question_set=[
                    'good'=>$_POST['id_good'],
                    'added'=>Auth::user()->id,
                    'text'=>$_POST['editor_question']];
                if($question_set['text']>''){
                DB::table('questions')->insert($question_set);}
                else{
                return view('questions.empty_exeption',['id_good'=>$_POST['id_good']]);    
         
                }
                return view('questions.success',['id_good'=>$_POST['id_good']]);
            }
            else{
                return view('questions.exeption');
            }
        }

    }

    public function deleteQuestion(Request $request){
        if ($request->isMethod('post')) {
            if(Auth::user()){

    //удалить сопряженную запись из таблицы  answers
            DB::table('answers')->where('id_question', $_POST['question_id'])->delete();
    //удалить запись из таблицы  questions
            DB::table('questions')->where('id', $_POST['question_id'])->delete();

            return view('questions.del_success',['id_good'=>$_POST['id_good']]);
            }
            else{
            return view('questions.exeption');
            }
        }

    }

    public function deleteComment(Request $request){
        if ($request->isMethod('post')) {
            if(Auth::user()){

                //удалить запись из таблицы  questions
                DB::table('comments')->where('id', $_POST['comment_id'])->delete();

                return view('comments.del_success',['id_good'=>$_POST['id_good']]);
            }
            else{
                return view('comments.exeption');
            }
        }

    }
    
    
    public function addQuestion_answer(Request $request){
        if ($request->isMethod('post')) {
            
            if(Auth::user()){

                $answer_set=[
                    'id_question'=>$_POST['id_question'],
                    'text'=>$_POST['editor_question_answer_'.$_POST["id_good"].'']];
                DB::table('answers')->insert($answer_set);
                return view('answer.success',['id_good'=>$_POST['id_good']]);
            }
            else{
                return view('answer.exeption');
            }

        }


    }

    public function addCategory(Request $request){
        if ($request->isMethod('post')) {

        $category_set=[
           'parent_id'=>$_POST['parent'],
           'name'=>$_POST['name']];
               
        DB::table('categories')->insert($category_set);
             
        return view('categories.success');

        }

    }

    public function del_category(Request $request){
        if ($request->isMethod('post')) {

       
//удалить записb из таблицы  goods
        DB::table('goods')->where('category', $_POST['category'])->delete();
//удалить записb из таблицы  categories где родитель данная категория
        DB::table('categories')->where('parent_id', $_POST['category'])->delete();
//удалить записb из таблицы  categories
        DB::table('categories')->where('id', $_POST['category'])->delete();
        /*return view('comments.del_success',['id_good'=>$_POST['id_good']]);*/
        echo json_encode('категоріі видалені');
        }

    }

    public function update_user_info(Request $request){
    if ($request->isMethod('post')) {
        dd($_POST);

        /* $category_set=[
             'parent_id'=>$_POST['parent'],
             'name'=>$_POST['name']];

         DB::table('categories')->insert($category_set);

         return view('categories.success');*/

    }

}
    public function update_customer_info(Request $request){
        if ($request->isMethod('post')) {
            if($_POST['password']< ''){
                $pass=Auth::user()->password;
            }else{$pass=bcrypt($_POST['password']);}
            $user_set=[

            'name'=> $_POST['user_name'],
            'email'=>$_POST['email'],
            'password'=>$pass,
            'mobile'=>$_POST['mobile'],
            'add_phone'=>$_POST['add_phone'],
            'information'=>$_POST['information']

            ];

            DB::table('users')->where('id',$_POST['user_id'])->update($user_set);
             $customer_set=[
             'id_user'=>$_POST['user_id'],
            'name'=>$_POST['uridical_name'],
            'edrpou'=>$_POST['edrpou'],
            'bank'=>$_POST['bank'],
            'mfo'=>$_POST['mfo'],
            'account'=>$_POST['account'],
            'city'=>$_POST['city'],
            'street'=>$_POST['street'],
            'house'=>$_POST['house'],
            'code'=>$_POST['code'],
            'ofice'=>$_POST['ofice'],
            'index'=>$_POST['index'],

             ];

             DB::table('customers')->where('id_user',$_POST['user_id'])->update($customer_set);

             return view('privat.update_inf_success',['id_user'=>$_POST['user_id']]);

        }

    }

    public function func_change_status(Request $request){
        if ($request->isMethod('post')) {
            $status_set=[
                 'status'=>$_POST['status']];

             DB::table('users')->where('id',$_POST['user'])->update($status_set);

            echo json_encode('статус оновлюэться буде перезагрузка сторінки');

        }

    }

    public function func_like_change(Request $request){
        if ($request->isMethod('post')) {
            if($_POST['status']==1){
                $likes_set=[
                    'id_user'=>$_POST['user'],
                    'id_good'=>$_POST['id_good']
                ];
                DB::table('likes')->insert($likes_set);
                echo json_encode('Ваша симпатія добавлена');    
            }
            else{
                DB::table('likes')->where('id_good',$_POST['id_good'])->delete();
                echo json_encode('Ваша симпатія видалена');
            }
            
            

            

           

        }

    }

    public function func_like_delete($id,$user){

    DB::table('likes')->where('id_good',$id)->where('id_user',$user)->delete();
    return view('likes.delete_success',['id_user'=>$user]);
    }

    public function deleteLogotype(){
    DB::table('logos')->where('id',$_POST['id_logo'])->delete();
    echo json_encode('логотип видалений - сторінка буде пергружена');
    }

    public function add_logo(Request $request){

        if(!empty($_FILES)) {
            dump(session()->all());
            // Файл передан через обычный массив $_FILES
            echo 'Contents of $_FILES:<br/><pre>'.print_r($_FILES, true).'</pre>';
            $file = $_FILES['my-pic'];
            $file_name=$file['name'];
            $ppos = strrpos($file_name, '.');
            $file_name = substr($file_name, 0, $ppos).'('.md5(uniqid(rand(),1)).').'.substr($file_name, $ppos + 1);

            $tmp_name=$file['tmp_name'];
            $uploads_dir='img';
            $upload=$uploads_dir.'/'.$file_name;

            move_uploaded_file($tmp_name, "$uploads_dir/$file_name");
            $this->resize_logo($upload,$uploads_dir,$file_name,'file_logo_image');

            // Внимание! Имя файла для Blob-данных может различаться в разных браузерах
            if ( ($file['type'] == 'image/png') && ($file['name'] == 'blob') ) {
                //move_uploaded_file($file['tmp_name'], './canvas-' . uniqid() . '.png');
            }
        }
    }

    private function resize_logo($upload,$uploads_dir,$file_name,$process){
        //resize of the images
        //image1_small
        $image_info = getimagesize($upload);
        $img_width=$image_info[0];
        $img_height=$image_info[1];
        //проверяем больше ли ширена высоты
        //если больше меняем ширену и высоту
        //real 305x427
        //500х335  (1,4925)
        $uploads[0]=[
            'upload' => $upload,
            'name'=>'logo',
            'width'  => 700,
            'height'=> 700,
        ];



        foreach ($uploads as $key=>$up){

            if($img_height>$img_width) {
                $ratio_img=$image_info[1]/$image_info[0];//1,4


                $img = Image::make($up['upload']);

                $img->resize($up['height']/$ratio_img, $up['height']); //1,4

                $img->save($uploads_dir.'/'.$file_name);
                $this->kind_logo($process,$imag=$file_name);
            }
            if($img_height<$img_width ) {

                $ratio_img=$image_info[0]/$image_info[1];//1,4

                $img = Image::make($up['upload']);

                $img->resize($up['width'], $up['width']/$ratio_img); //1,4
                $img->save($uploads_dir.'/'.$file_name);
                $this->kind_logo($process,$imag=$file_name);

            }
            if($img_height==$img_width ) {
                $img = Image::make($up['upload']);
// resize image instance
//image1_small
//500х335  (1,4925)
                $img->resize($up['height'], $up['height']); //1,4
// set a background-color for the emerging area
        /*        $img->resizeCanvas( $up['width'],$up['height'], 'center', false, 'fff');*/
// insert a watermark
// save image in desired format
                $img->save($uploads_dir.'/'.$file_name);
                $this->kind_logo($process,$imag=$file_name);

            }


        }







    }

    private function kind_logo($process,$imag){

        //нам необходимо свойство класса заменить на сессионную переменную



            dump(session()->all());



            if (!session()->has($process)) {
                session()->put($process, $imag);
            }


        dump(session()->all());
    }




    public function form_logo(Request $request){

//Add logo
        if(!empty(session('file_logo_image'))){


                $logo_set[] = [
                    'id' => NULL,
                    'logo'  => session('file_logo_image'),
                    'name'=>$_POST['name'],
                    'address'=>$_POST['address'],
                ];

            DB::table('logos')->insert($logo_set);

        }




        return redirect()->route('partner_added');

    }

}
