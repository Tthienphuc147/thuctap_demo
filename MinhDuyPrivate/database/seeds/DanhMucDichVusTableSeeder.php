<?php

use Illuminate\Database\Seeder;

class DanhMucDichVusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i <= 5; $i++) { 
    		 DB::table('danh_muc_dich_vus')->insert([
	            'ten' => 'Danh mục dịch vụ ' . $i,
	            'created_at' => date("Y-m-d H:i:s"),
	        ]);
    	}
    }
}
