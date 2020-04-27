<?php

use Illuminate\Database\Seeder;

class DanhMucSanPhamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	for ($i=1; $i <= 5; $i++) { 
    		 DB::table('danh_muc_san_phams')->insert([
	            'ten' => 'Danh mục sản phẩm' . $i,
	            'created_at' => date("Y-m-d H:i:s"),
	        ]);
    	}
    }
}
