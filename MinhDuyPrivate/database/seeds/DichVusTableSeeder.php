<?php

use Illuminate\Database\Seeder;

class DichVusTableSeeder extends Seeder
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
    		 DB::table('dich_vus')->insert([
                'id_loai_dich_vu' => rand(1, 4),
	            'tieu_de' => 'Tiêu đề dịch vụ thứ ' . $i,
                'mo_ta' => $faker->realText(1000),
                'noi_dung' => $faker->realText(3000),
                'hinh_anh' => $i . '.jpg',
	            'created_at' => date("Y-m-d H:i:s")
	        ]);
    	}
    }
}
