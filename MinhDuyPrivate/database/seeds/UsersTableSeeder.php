<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public $timestamps = true;
    
    public function run()
    {
        DB::table('users')->insert([
            'display_name' => 'Tài khoản User',
            'name' => 'taikhoanuser',
            'email' => 'user@gmail.com',
            'password' => bcrypt('123123'),
            'role' => 'us',
            'created_at' => date("Y-m-d H:i:s")
        ]);

        for ($i=1; $i < 15; $i++) { 
            DB::table('users')->insert([
                'display_name' => 'Tài khoản User' . $i,
                'name' => 'taikhoanuser'.$i,
                'email' => 'user'. $i .'@gmail.com',
                'password' => bcrypt('123123'),
                'role' => 'us',
                'created_at' => date("Y-m-d H:i:s")
            ]);
        }
    }
}
