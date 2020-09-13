<?php

use Illuminate\Database\Seeder;
use App\User as UserEloquent;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //建立一筆管理者
        UserEloquent::create([
            'name' => '管理者',
            'email' => 'admin@mail.com',
            'password' => bcrypt('admin'),
            'type' => 1,
        ]);
        //建立一筆使用者
        UserEloquent::create([
            'name' => '使用者',
            'email' => 'user@mail.com',
            'password' => bcrypt('user'),
            'type' => 0,
        ]);
    }
}
