<?php

use Illuminate\Database\Seeder;

class ChiTietHoaDonsTableSeeder extends Seeder
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
    		 DB::table('chi_tiet_hoa_dons')->insert([
                'id_sp' => rand(1, 10),
	            'id_hoa_don' => rand(1, 4),
	            'so_luong' => rand(1, 4),
	            'created_at' => date("Y-m-d H:i:s")
	        ]);
    	}
    }
}
