<?php

use Illuminate\Database\Seeder;

class LoaiSanPhamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i <= 20; $i++) { 
    		 DB::table('loai_san_phams')->insert([
	            'id_danh_muc_sp' => rand(1, 5),
	            'ten' => 'SP loại ' . $i,
	            'created_at' => date("Y-m-d H:i:s")
	        ]);
    	}
    }
}
