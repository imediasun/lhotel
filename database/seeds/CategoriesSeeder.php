<?php

use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([

            [
                
                'email'=>'imediasun@gmail.com',
                'password'=>bcrypt('sunimedia'),
                'mobile'=>'+38(096)544-11-20',
                'add_phone'=>'+38(096)544-11-20',
                'information'=>'information description',
                'status'=>1,
                'activated'=> TRUE,
                'name' => 'Лопушанский Андрей'

            ],
            [
                'email'=>'imediasun8@gmail.com',
                'password'=>bcrypt('sunimedia'),
                'mobile'=>'+38(096)544-11-20',
                'add_phone'=>'+38(096)544-11-20',
                'information'=>'information description',
                'status'=>2,
                'activated'=> TRUE,
                'name' => 'Демидов Сергей'

            ]

        ]);
        DB::table('role_user')->insert([

            [

            'user_id' => 1,
            'role_id' => 1

        ],
            [

                'user_id' => 2,
                'role_id' => 2

            ]/*, [

            'user_id' => 3,
            'role_id' => 3

        ]*/


        ]);
        DB::table('customers_statuses')->insert([

            [
                
                'name' => 'Фізична особа'

            ],
            [

                'name' => 'Юридична особа'

            ]
            

        ]);
        

        DB::table('customers')->insert([

        [
        'id_user'=>2,
        'name'=>'Южная Пальмира',
        'edrpou'=>4568756,
        'bank'=>'Приватбанк',
        'mfo'=>324568,
        'account'=>24562345644568990,
        'city'=>'Одесса',
        'street'=>'Рішельевська',
        'house'=>45,
         'code'=>465,
        'ofice'=>345,
        'index'=>348766,

        ]
           

        ]);
        DB::table('likes')->insert([

            [

                'id_room' => 1,
                'id_user'=>1

            ]
    ]);
        DB::table('gardens')->insert([

            [
            'description'=>'<p>Открыв двери в LUCIA Banquet Hall, Вы сразу попадаете в гостеприимный холл, где сможете
                                комфортно расположиться в ожидании яркого торжества или успеть пообщаться со своими коллегами
                                перед началом делового мероприятия.
                            </p>',
            'name'=>'Гостиный',
            'image_large'=>'gostinny.jpg',
            'thumbnail'=>'gostinny_thumb.jpg',

            ],
            [
            'description'=>'<p>Открыв двери в LUCIA Banquet Hall, Вы сразу попадаете в гостеприимный холл, где сможете
                                комфортно расположиться в ожидании яркого торжества или успеть пообщаться со своими коллегами
                                перед началом делового мероприятия.
                            </p>',
            'name'=>'Гостиный',
            'image_large'=>'interior_1.jpg',
            'thumbnail'=>'interior_1_thumb.jpg',

            ],
            [
                'description'=>'<p>Открыв двери в LUCIA Banquet Hall, Вы сразу попадаете в гостеприимный холл, где сможете
                                комфортно расположиться в ожидании яркого торжества или успеть пообщаться со своими коллегами
                                перед началом делового мероприятия.
                            </p>',
                'name'=>'Гостиный',
                'image_large'=>'lounge.jpg',
                'thumbnail'=>'lounge_thumb.jpg',

            ],
            

        ]);
    }
}
