<?php

use Illuminate\Database\Seeder;

class TinTucTableSeeder extends Seeder
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
    		DB::table('tin_tucs')->insert([
    			'id_loai_tin_tuc' => rand(1, 4),
    			'id_admin' => 1,
    			'tieu_de' => 'Tiêu đề tin tức thứ ' . $i,
    			'mo_ta' => $faker->realText(1000),
    			'noi_dung' => $faker->realText(3000),
    			'hinh_anh' => $i . '.jpg',
    			'created_at' => date("Y-m-d H:i:s")
    		]);
    	}
    }
}
