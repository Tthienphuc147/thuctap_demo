<?php

use Illuminate\Database\Seeder;

class HinhAnhSanPhamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i <= 30; $i++) {
    		 DB::table('hinh_anh_san_phams')->insert([
                'id_sp' => $i,
	            'ten' => $i . '.jpg',
                'hinh_chinh' => true,
	            'created_at' => date("Y-m-d H:i:s")
	        ]);
    	}

        for ($i=31; $i <= 50; $i++) {
             DB::table('hinh_anh_san_phams')->insert([
                'id_sp' => rand(1, 30),
                'ten' => $i . '.jpg',
                'hinh_chinh' => false,
                'created_at' => date("Y-m-d H:i:s")
            ]);
        }
    }
}
