<?php

use Illuminate\Database\Seeder;

class HoaDonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for ($i=1; $i <= 11; $i++) {
    		 DB::table('hoa_dons')->insert([
                'ma_hoa_don' => 'HDMD'.time(),
	            'ten_khach_hang' => $faker->name,
                'so_dien_thoai' => $faker->phoneNumber,
                'email' => $faker->safeEmail,
                'province_id' => '49',
                'district_id' => '502',
                'ward_id' => '20341',
                'dia_chi' => '26 Trần Bình Trọng',
                'phi_ship' => rand(1, 4) * 10000,
                'ghi_chu' => $faker->realText(100),
	            'created_at' => date("Y-m-d H:i:s")
	        ]);
    	}
    }
}
