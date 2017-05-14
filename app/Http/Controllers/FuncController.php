<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;
use DB;
use Intervention\Image\Facades\Image;
use Illuminate\Http\RedirectResponse;
use App\Http\Libraries\Display_lib;
use Auth;

class FuncController extends Controller 
{
    //
     public function __construct(){
  
          /*$this->middleware('guest');*/
      }


    private static $num;


    public function index(Request $request)
    {
        //функция принемает файл и записывает его на сервер


        if (!empty($_FILES)) {
            dump(session()->all());
            // Файл передан через обычный массив $_FILES
            echo 'Contents of $_FILES:<br/><pre>' . print_r($_FILES, true) . '</pre>';
            $file = $_FILES['my-pic'];
            $file_name = $file['name'];
            $ppos = strrpos($file_name, '.');
            $file_name = substr($file_name, 0, $ppos) . '(' . md5(uniqid(rand(), 1)) . ').' . substr($file_name, $ppos + 1);

            $tmp_name = $file['tmp_name'];
            $uploads_dir = 'photos';
            $upload = $uploads_dir . '/' . $file_name;
            //проверяем на запись
            if (move_uploaded_file($tmp_name, $upload)) {


            } else {

                //можем генерировать исключение
            }
            //ресайзим под стандарт
            $this->resize_($upload, $uploads_dir, $file_name, 'file_name');
            // Внимание! Имя файла для Blob-данных может различаться в разных браузерах
            if (($file['type'] == 'image/png') && ($file['name'] == 'blob')) {
                //move_uploaded_file($file['tmp_name'], './canvas-' . uniqid() . '.png');
            }
        }
    }


    private function resize_($upload, $uploads_dir, $file_name, $process)
    {

        //resize of the images
        $image_info = getimagesize($upload);
        $img_width = $image_info[0];
        $img_height = $image_info[1];


        //составляем массив случаев с различными параметрами исходя из нужд клиента
        $uploads[0] = [
            'upload' => $upload,
            'name' => 'thumbnail',
            'width' => 250,
            'height' => 167,
        ];
        $uploads[1] = [
            'upload' => $upload,
            'name' => 'image_small',
            'width' => 750,
            'height' => 500,
        ];
        $uploads[2] = [
            'upload' => $upload,
            'name' => 'image_medium',
            'width' => 1280,
            'height' => 853,
        ];
        $uploads[3] = [
            'upload' => $upload,
            'name' => 'image_large',
            'width' => 1500,
            'height' => 1000,
        ];


        foreach ($uploads as $key => $up) {
            //различные действия в зависимости от того или ширена больше высоты или наоборот
            if ($img_height > $img_width) {
                $ratio_img = $image_info[1] / $image_info[0];//1,4


                $img = Image::make($up['upload']);
                // resize image instance
                $img->resize($up['height'] / $ratio_img, $up['height']); //1,4
                // создаем белую конву по случаю из конфигурационного массива
                $img->resizeCanvas($up['width'], $up['height'], 'center', false, 'fff');
                $img->save($uploads_dir . '/' . $up['name'] . $file_name);
                //функция kind сохраняет в сессию информацию об именах файлов
                //для дальнейшего вхождения через форму
                $this->kind($process, $imag = $up['name'] . $file_name);
            }
            if ($img_height < $img_width) {
                $ratio_img = $image_info[0] / $image_info[1];//1,4

                $img = Image::make($up['upload']);
                $img->resize($up['width'], $up['width'] / $ratio_img); //1,4
                $img->resizeCanvas($up['width'], $up['height'], 'center', false, 'fff');
                $img->save($uploads_dir . '/' . $up['name'] . $file_name);
                $this->kind($process, $imag = $up['name'] . $file_name);

            }
            if ($img_height == $img_width) {
                $img = Image::make($up['upload']);
                $img->resize($up['height'], $up['height']); //1,4
                $img->resizeCanvas($up['width'], $up['height'], 'center', false, 'fff');
                $img->save($uploads_dir . '/' . $up['name'] . $file_name);
                $this->kind($process, $imag = $up['name'] . $file_name);

            }


        }
    }

    private function kind($process, $imag)
    {


        //нам необходимо свойство класса заменить на сессионную переменную

        for ($i = 0; $i < 1; $i++) {
            dump('ENTER');
            dump(session('variable'));

            dump(session()->all());


            if ($process == 'file_name_main_image') {
                $num = 0;
            } else {
                if (empty (session('variable'))) {
                    session(['variable' => 0]);
                    $num = 0;
                } else {
                    $num = session('variable');
                }
            }
            if (session()->has($process . '.' . $num . '.image_medium')) {
                session()->put($process . '.' . $num . '.image_large', $imag);
                //когда уже один то large переписывается а не должен
                session(['variable' => $num + 1]);
                dump(session('variable'));
                break;
            } else if (session()->has($process . '.' . $num . '.image_small')) {
                session()->put($process . '.' . $num . '.image_medium', $imag);

                break;
            } else if (session()->has($process . '.' . $num . '.image_thumbnail')) {
                session()->put($process . '.' . $num . '.image_small', $imag);

                break;
            } else {
                session([$process . '.' . $num . '.image_thumbnail' => $imag]);
                break;
            }

        }
        dump(session()->all());
    }

    public function main_image(Request $request)
    {
        //функция для записи основного изображения
        //в последствии сократить эту функцию есть похожая    


        if (!empty($_FILES)) {
            dump(session()->all());
            // Файл передан через обычный массив $_FILES
            echo 'Contents of $_FILES:<br/><pre>' . print_r($_FILES, true) . '</pre>';
            $file = $_FILES['my-pic'];
            $file_name = $file['name'];
            $ppos = strrpos($file_name, '.');
            $file_name = substr($file_name, 0, $ppos) . '(' . md5(uniqid(rand(), 1)) . ').' . substr($file_name, $ppos + 1);

            $tmp_name = $file['tmp_name'];
            $uploads_dir = 'photos';
            $upload = $uploads_dir . '/' . $file_name;
            $upload = public_path() . '/' . $uploads_dir . '/' . $file_name;

            if (move_uploaded_file($tmp_name, $upload)) {


            } else {

                dd($tmp_name, $upload);
            }


            $this->resize_($upload, $uploads_dir, $file_name, 'file_name_main_image');

            // Внимание! Имя файла для Blob-данных может различаться в разных браузерах
            if (($file['type'] == 'image/png') && ($file['name'] == 'blob')) {
                //move_uploaded_file($file['tmp_name'], './canvas-' . uniqid() . '.png');
            }
        }
    }

    private function resize_update($upload, $uploads_dir, $file_name, $post)
    {
        $image_info = getimagesize($upload);
        $img_width = $image_info[0];
        $img_height = $image_info[1];
        $uploads[0] = [
            'upload' => $upload,
            'name' => 'thumbnail',
            'width' => 250,
            'height' => 167,
        ];
        $uploads[1] = [
            'upload' => $upload,
            'name' => 'image_small',
            'width' => 750,
            'height' => 500,
        ];
        $uploads[2] = [
            'upload' => $upload,
            'name' => 'image_medium',
            'width' => 1280,
            'height' => 853,
        ];
        $uploads[3] = [
            'upload' => $upload,
            'name' => 'image_large',
            'width' => 1500,
            'height' => 1000,
        ];


        foreach ($uploads as $key => $up) {
            if ($img_height > $img_width) {
                $ratio_img = $image_info[1] / $image_info[0];//1,4


                $img = Image::make($up['upload']);
// resize image instance
                $img->resize($up['height'] / $ratio_img, $up['height']); //1,4
                $img->resizeCanvas($up['width'], $up['height'], 'center', false, 'fff');
                $img->save($uploads_dir . '/' . $up['name'] . $file_name);
                $this->update_img_($up['name'], $imag = $up['name'] . $file_name, $post);
            }
            if ($img_height < $img_width) {
                $ratio_img = $image_info[0] / $image_info[1];//1,4
                $img = Image::make($up['upload']);
                $img->resize($up['width'], $up['width'] / $ratio_img); //1,4
                $img->resizeCanvas($up['width'], $up['height'], 'center', false, 'fff');
                $img->save($uploads_dir . '/' . $up['name'] . $file_name);
                $this->update_img_($up['name'], $imag = $up['name'] . $file_name, $post);
            }
            if ($img_height == $img_width) {
                $img = Image::make($up['upload']);
                $img->resize($up['height'], $up['height']); //1,4
                $img->resizeCanvas($up['width'], $up['height'], 'center', false, 'fff');
                $img->save($uploads_dir . '/' . $up['name'] . $file_name);
                $this->update_img_($up['name'], $imag = $up['name'] . $file_name, $post);

            }


        }
    }

    private function update_img_($name, $imag, $post)
    {

        $update_set = [
            '' . $name . '' => $imag];
        DB::table('photos')->where('id', $post)->update($update_set);
    }


    public function update_image(Request $request)
    {


        if (!empty($_FILES)) {
            // Файл передан через обычный массив $_FILES
            echo 'Contents of $_FILES:<br/><pre>' . print_r($_FILES, true) . '</pre>';
            $file = $_FILES['my-pic'];
            $file_name = $file['name'];
            $ppos = strrpos($file_name, '.');
            $file_name = substr($file_name, 0, $ppos) . '(' . md5(uniqid(rand(), 1)) . ').' . substr($file_name, $ppos + 1);

            $tmp_name = $file['tmp_name'];
            $uploads_dir = 'photos';
            $upload = $uploads_dir . '/' . $file_name;

            move_uploaded_file($tmp_name, "$uploads_dir/$file_name");
            $this->resize_update($upload, $uploads_dir, $file_name, $_POST['photo']);

            // Внимание! Имя файла для Blob-данных может различаться в разных браузерах
            if (($file['type'] == 'image/png') && ($file['name'] == 'blob')) {
                //move_uploaded_file($file['tmp_name'], './canvas-' . uniqid() . '.png');
            }
        }
    }

    public function add_room(Request $request)
    {

        if ($request->ajax()) {
            $main_array = $request->input();

        }

        $main_array = $_POST;
//Add photos
        if (!empty(session('file_name'))) {
            $data_m = Room::all();
            $last_data_object = collect($data_m)->last();

            $last_data_object = $last_data_object['original']['id'];

            foreach (session('file_name') as $key => $photo) {

                $photo_set[] = [
                    'id' => NULL,
                    'id_room' => $last_data_object + 1,
                    'image_small' => $photo['image_small'],
                    'image_medium' => $photo['image_medium'],
                    'image_large' => $photo['image_large'],
                    'thumbnail' => $photo['image_thumbnail'],
                ];

            }

            DB::table('photos')->insert($photo_set);

        }
//Add videos
        if (!empty($main_array['video1'])) {
            $check = 1;

            $video_set[0] = [
                'id' => NULL,
                'id_room' => $last_data_object + 1,
                'video' => $main_array['video1']

            ];

        }
        if (!empty($main_array['video2'])) {
            $check = 1;
            $video_set[1] = [
                'id' => NULL,
                'id_room' => $last_data_object + 1,
                'video' => $main_array['video2']

            ];
        }
        if (!empty($main_array['video3'])) {
            $check = 1;
            $video_set[2] = [
                'id' => NULL,
                'id_room' => $last_data_object + 1,
                'video' => $main_array['video3']

            ];
        }
        if (!empty($main_array['video4'])) {
            $check = 1;
            $video_set[3] = [
                'id' => NULL,
                'id_room' => $last_data_object + 1,
                'video' => $main_array['video4']

            ];
        }
        if (isset($check) && $check == 1) {
            DB::table('videos')->insert($video_set);
        }

//Add goods_
        $main_image = session('file_name_main_image');

        if (isset($main_array['shower'])) {
            $dataSet['shower'] = $main_array['shower'];
        }
        if (isset($main_array['wc'])) {
            $dataSet['wc'] = $main_array['wc'];
        }
        if (isset($main_array['tv'])) {
            $dataSet['tv'] = $main_array['tv'];
        }
        if (isset($main_array['ac'])) {
            $dataSet['ac'] = $main_array['ac'];
        }
        if (isset($main_array['cold'])) {
            $dataSet['cold'] = $main_array['cold'];
        }
        if (isset($main_array['mikrowave'])) {
            $dataSet['mikrowave'] = $main_array['mikrowave'];
        }
        if ($main_array['teapot']) {
            $dataSet['teapot'] = $main_array['teapot'];
        }
        $dataSet['type'] = $main_array['type'];
        $dataSet['category'] = $main_array['category'];
        $dataSet['number'] = $main_array['artikul'];
        $dataSet['description'] = $main_array['editor1'];
        $dataSet['description2'] = $main_array['editor2'];
        $dataSet['name'] = $main_array['name'];
        $dataSet['price'] = $main_array['price'];
        $dataSet['slogan'] = $main_array['slogan'];
        $dataSet['image_small'] = $main_image[0]['image_small'];
        $dataSet['image_medium'] = $main_image[0]['image_medium'];
        $dataSet['image_large'] = $main_image[0]['image_large'];
        $dataSet['thumbnail'] = $main_image[0]['image_thumbnail'];
        DB::table('rooms')->insert($dataSet);
        return redirect()->route('room_added');
    }

    public function role(Request $request)
    {

        if ($request->ajax()) {
            $inp_array = $request->input();
//поменять роль
            DB::table('role_user')->where('user_id', $inp_array['user'])
                ->update(['role_id' => $inp_array['role']]);
        }
    }

    public function delete_user(Request $request)
    {
        if ($request->ajax()) {
            $inp_array = $request->input();
            //поменять роль
            $del_role_user = DB::table('role_user')->where('user_id', $inp_array['user'])
                ->delete();
            $del_user = DB::table('users')->where('id', $inp_array['user'])
                ->delete();
            if ($del_role_user && $del_user) {
                echo json_encode('deleted');
            } else {
                echo json_encode('not_deleted');
            }
        }
    }

    public function addComment(Request $request)
    {
        //добавление комментариев    
        if ($request->isMethod('post')) {
            if (Auth::user()) {
                $comment_set = [
                    'good' => $_POST['id_good'],
                    'added' => Auth::user()->id,
                    'text' => $_POST['editor_comment']];
                DB::table('comments')->insert($comment_set);
                return view('comments.success', ['id_good' => $_POST['id_good']]);
            } else {
                return view('comments.exeption');
            }
        }
    }

    public function addQuestion(Request $request)
    {
        //добавление вопросов    
        if ($request->isMethod('post')) {
            if (Auth::user()) {
                $question_set = [
                    'good' => $_POST['id_good'],
                    'added' => Auth::user()->id,
                    'text' => $_POST['editor_question']];
                if ($question_set['text'] > '') {
                    DB::table('questions')->insert($question_set);
                } else {
                    return view('questions.empty_exeption', ['id_good' => $_POST['id_good']]);

                }
                return view('questions.success', ['id_good' => $_POST['id_good']]);
            } else {
                return view('questions.exeption');
            }
        }
    }

    public function deleteQuestion(Request $request)
    {
        if ($request->isMethod('post')) {
            if (Auth::user()) {
                //удалить сопряженную запись из таблицы  answers
                DB::table('answers')->where('id_question', $_POST['question_id'])->delete();
                //удалить запись из таблицы  questions
                DB::table('questions')->where('id', $_POST['question_id'])->delete();
                return view('questions.del_success', ['id_good' => $_POST['id_good']]);
            } else {
                return view('questions.exeption');
            }
        }
    }

    public function deleteComment(Request $request)
    {
        if ($request->isMethod('post')) {
            if (Auth::user()) {
                //удалить запись из таблицы  questions
                DB::table('comments')->where('id', $_POST['comment_id'])->delete();
                return view('comments.del_success', ['id_good' => $_POST['id_good']]);
            } else {
                return view('comments.exeption');
            }
        }
    }


    public function addQuestion_answer(Request $request)
    {
        if ($request->isMethod('post')) {
            if (Auth::user()) {
                $answer_set = [
                    'id_question' => $_POST['id_question'],
                    'text' => $_POST['editor_question_answer_' . $_POST["id_good"] . '']];
                DB::table('answers')->insert($answer_set);
                return view('answer.success', ['id_good' => $_POST['id_good']]);
            } else {
                return view('answer.exeption');
            }
        }
    }

    public function addCategory(Request $request)
    {
        if ($request->isMethod('post')) {
            $category_set = [
                'parent_id' => $_POST['parent'],
                'name' => $_POST['name']];
            DB::table('categories')->insert($category_set);
            return view('categories.success');
        }
    }

    public function del_category(Request $request)
    {
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

    public function update_user_info(Request $request)
    {
        if ($request->isMethod('post')) {
            dd($_POST);

            /* $category_set=[
                 'parent_id'=>$_POST['parent'],
                 'name'=>$_POST['name']];
    
             DB::table('categories')->insert($category_set);
    
             return view('categories.success');*/

        }

    }


    public function func_change_status(Request $request)
    {
        if ($request->isMethod('post')) {
            $status_set = [
                'status' => $_POST['status']];
            DB::table('users')->where('id', $_POST['user'])->update($status_set);
            echo json_encode('статус оновлюэться буде перезагрузка сторінки');
        }
    }

    public function func_like_change(Request $request)
    {
        if ($request->isMethod('post')) {
            if ($_POST['status'] == 1) {
                $likes_set = [
                    'id_user' => $_POST['user'],
                    'id_good' => $_POST['id_good']
                ];
                DB::table('likes')->insert($likes_set);
                echo json_encode('Ваша симпатія добавлена');
            } else {
                DB::table('likes')->where('id_good', $_POST['id_good'])->delete();
                echo json_encode('Ваша симпатія видалена');
            }
        }
    }

    public function func_like_delete($id, $user)
    {
        DB::table('likes')->where('id_good', $id)->where('id_user', $user)->delete();
        return view('likes.delete_success', ['id_user' => $user]);
    }

    public function deleteLogotype()
    {
        DB::table('logos')->where('id', $_POST['id_logo'])->delete();
        echo json_encode('логотип видалений - сторінка буде пергружена');
    }

}










