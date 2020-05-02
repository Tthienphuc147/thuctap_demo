<?php

use Illuminate\Database\Seeder;

class CaiDatTinTucsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cai_dat_tin_tucs')->insert([
    		'so_luong_danh_muc' => 10,
    		'so_luong_the_loai' => 10,
    		'so_luong_tat_ca' => 10,
            'so_luong_tim_kiem' => 10,
            'tu_khoa' => 'Từ khóa 1,Từ khóa 2,Từ khóa 3,Từ khóa 4,Từ khóa 5,Từ khóa 6,Từ khóa 7,Từ khóa 8,Từ khóa 9,Từ khóa 10,Từ khóa 11,',
    		'created_at' => date("Y-m-d H:i:s")
    	]); 
    }
}
