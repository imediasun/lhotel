<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        
        
        DB::table('type_of_goods')->insert([

            [

                'name' => 'Четырехместный',

            ],
            [

                'name' => 'Трехместный',

            ],
            [

                'name' => 'Двухместный',

            ],

        ]);

        DB::table('roles')->insert([

            [

                'name' => 'Admin',

            ],
            [

                'name' => 'Moderator',

            ],
            [

                'name' => 'Guest',

            ],

        ]);


        
        DB::table('permissions')->insert([

            [

                'name' => 'VIEW_ADMIN',

            ],
            [

                'name' => 'ADMIN_USERS',

            ]

        ]);
        DB::table('permission_role')->insert([

            [

                'role_id' => 1,
                'permission_id' => 1,

            ],
            [

                'role_id' => 1,
                'permission_id' => 2,

            ],
            [

                'role_id' => 2,
                'permission_id' => 1,

            ]

        ]);
        DB::table('categories')->insert([

            [
                'parent_id' => 0,
                'name' => 'Люкс',
                /*'link'=> '/good_category?id=',*/
                'icon'=>'fa-plus-square'
            ],
            [
                'parent_id' => 0,
                'name' => 'Полулюкс',
                /*'link'=> '/good?id=123456',*/
                'icon'=>'fa-usb'
            ]
        ]);




        DB::table('admin_categories')->insert([

            [
                'parent_id' => 0,
                'name' => 'Пользователи',
                'icon'=> 'fa-users',
                'link'=> '/admin'
            ],
            [
                'parent_id' => 1,
                'name' => 'Управление пользователями',
                'icon'=> 'fa-registered',
                'link'=> '/admin/customers_managment'
            ],
            [
                'parent_id' => 0,
                'name' => 'Номера',
                'icon'=> 'fa-gift',
                'link'=> '/admin'
            ],
            [
                'parent_id' => 3,
                'name' => 'Добавить номер',
                'icon'=> 'fa-envelope','link'=> '/admin/add_room'
            ],
            
            [
                'parent_id' => 3,
                'name' => 'Информация о номере',
                'icon'=> 'fa-envelope','link'=> '/admin/edit_room'
            ],
            [
                'parent_id' => 3,
                'name' => 'Цены на номера',
                'icon'=> 'fa-envelope','link'=> '/admin/rooms_prices'
            ],
            [
                'parent_id' => 3,
                'name' => 'Занять номер',
                'icon'=> 'fa-envelope','link'=> '/admin/room_employment'
            ],
            [
                'parent_id' => 0,
                'name' => 'Сад',
                'icon'=> 'fa-gift',
                'link'=> '/admin/garden'
            ],
            /*[
                'parent_id' => 3,
                'name' => 'Категоріі',
                'icon'=> 'fa-envelope','link'=> '/admin/categories'
            ],
            [
                'parent_id' => 0,
                'name' => 'Замовлення',
                'icon'=> 'fa-envelope',
                'link'=> '/admin'

            ],
            [
                'parent_id' => 0,
                'name' => 'Реклама',
                'icon'=> 'fa-bullhorn',
                'link'=> '/admin'
            ],
            [
                'parent_id' => 0,
                'name' => 'Партнери',
                'icon'=> 'fa-thumbs-o-up',
                'link'=> '/admin/partners'
            ],
            [
                'parent_id' => 9,
                'name' => 'Додати логотипи',
                'icon'=> 'fa-envelope','link'=> '/admin/add_logos'
            ],
            [
                'parent_id' => 9,
                'name' => 'Видалити логотипи',
                'icon'=> 'fa-envelope','link'=> '/admin/del_logos'
            ],*/
        ]);
    }
}
