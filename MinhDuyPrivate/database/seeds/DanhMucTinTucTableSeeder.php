<?php

use Illuminate\Database\Seeder;

class DanhMucTinTucTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i <= 5; $i++) { 
    		 DB::table('danh_muc_tin_tucs')->insert([
	            'ten' => 'Danh mục tin tức ' . $i,
	            'created_at' => date("Y-m-d H:i:s"),
	        ]);
    	}
    }
}
