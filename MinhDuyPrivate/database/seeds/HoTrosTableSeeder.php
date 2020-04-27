<?php

use Illuminate\Database\Seeder;

class HoTrosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for ($i=1; $i <= 5; $i++) { 
    		 DB::table('ho_tros')->insert([
	            'id_admin' => 1,
	            'ho_ten' => 'Họ tên ' . $i,
	            'email' => 'email' . $i . '@gmail.com',
	            'lien_he' => 'Liên hệ ' . $i,
	            'noi_dung' => $faker->realText(300),
	            'created_at' => date("Y-m-d H:i:s")
	        ]);
    	}
    }
}
