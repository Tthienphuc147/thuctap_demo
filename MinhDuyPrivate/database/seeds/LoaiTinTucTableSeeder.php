<?php

use Illuminate\Database\Seeder;

class LoaiTinTucTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
    	for ($i=1; $i <= 20; $i++) { 
    		DB::table('loai_tin_tucs')->insert([
    			'id_danh_muc_tin_tuc' => rand(1, 5),
    			'ten' => 'Tin tức loại ' . $i,
    			'created_at' => date("Y-m-d H:i:s"),
    		]);
    	}
    }
}
