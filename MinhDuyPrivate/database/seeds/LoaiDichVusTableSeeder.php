<?php

use Illuminate\Database\Seeder;

class LoaiDichVusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i <= 20; $i++) { 
    		 DB::table('loai_dich_vus')->insert([
	            'id_danh_muc_dich_vu' => rand(1, 5),
	            'ten' => 'Dịch vụ loại ' . $i,
	            'created_at' => date("Y-m-d H:i:s"),
	        ]);
    	}
    }
}
