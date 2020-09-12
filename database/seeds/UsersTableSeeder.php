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
        ]);
    }
}
