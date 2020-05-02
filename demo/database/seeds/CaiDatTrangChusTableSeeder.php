<?php

use Illuminate\Database\Seeder;

class CaiDatTrangChusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cai_dat_trang_chus')->insert([
    		'logo' => 'logo.jpg',
    		'dia_chi' => '150 Nguyễn Đình Chiểu - TP Tam Kỳ - Quảng Nam',
    		'dia_chi_map' => 'Địa chỉ map',
    		'dien_thoai' => '0123456789',
    		'email' => 'email@gmail.com',
    		'ban_quyen' => 'bản quyền',
    		'twitter' => 'link twitter',
    		'facebook' => 'link facebook',
    		'instagram' => 'link instagram',
            'youtube' => 'link youtube',
            'app_facebook' => 'link app_facebook',
    		'created_at' => date("Y-m-d H:i:s")
    	]); 
    }
}
