<?php

use Illuminate\Database\Seeder;

class CaiDatSanPhamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('cai_dat_san_phams')->insert([
    		'so_luong_noi_bat' => 50,
    		'so_luong_moi' => 50,
    		'so_luong_ban_chay' => 50,
            'so_luong_theo_danh_muc' => 50,
            'so_luong_khuyen_mai' => 50,
            'so_luong_theo_loai_ngau_nhien' => 10,
            'so_luong_sp_trang_danh_muc' => 12,
            'so_luong_sp_trang_loai' => 12,
            'tu_khoa' => 'Từ khóa 1,Từ khóa 2,Từ khóa 3,Từ khóa 4,Từ khóa 5,Từ khóa 6,Từ khóa 7,Từ khóa 8,Từ khóa 9,Từ khóa 10,Từ khóa 11,',
    		'created_at' => date("Y-m-d H:i:s")
    	]);
    }
}
