<?php

use Illuminate\Database\Seeder;

class PhanHoiSanPhamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker\Factory::create();
    	for ($i=1; $i <= 30; $i++) {
    		DB::table('phan_hoi_san_phams')->insert([
    			'id_sp' => rand(1, 4),
    			'ten_hien_thi' => 'Tên hiển thị ' . $i,
    			'email' => $faker->unique()->safeEmail,
    			'noi_dung' => $faker->realText(100),
    			'created_at' => date("Y-m-d H:i:s")
    		]);
    	}
    }
}
