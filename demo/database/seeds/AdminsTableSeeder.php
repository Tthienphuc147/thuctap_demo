<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert(
            [
                'display_name' => 'Tài khoản Admin',
                'name' => 'taikhoanadmin',
                'email' => 'admin@gmail.com',
                'role' => 'admin',
                'avatar' => 'admin.jpg',
                'password' => bcrypt('123123'),
            ]
        );
    }
}
