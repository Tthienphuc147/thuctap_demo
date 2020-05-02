<?php

use Illuminate\Database\Seeder;

class SanPhamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for ($i=1; $i <= 30; $i++) {
            $gia = round(rand(100000, 10000000),-3);
            $khuyenmai = rand(10, 30);
    		 DB::table('san_phams')->insert([
                'id_loai_sp' => rand(1, 4),
	            'ten' => 'Sản phẩm thứ ' . $i,
                'mo_ta' => $faker->realText(1000),
                'thong_so' => $faker->realText(3000),
                'thong_tin_chi_tiet' => $faker->realText(3000),
                'gia_goc' => $gia,
                'khuyen_mai' => $khuyenmai,
                'noi_bat' => rand(0, 1),
                'moi' => rand(0, 1),
                'ban_chay' => rand(0, 1),
                'gia_ban' => round($gia * $khuyenmai / 100, -3),
                'ngay_bat_dau_khuyen_mai' =>  date("Y-m-d", -strtotime((rand(1,10)) . ' days' )),
                'ngay_ket_thuc_khuyen_mai' =>  date("Y-m-d", strtotime((rand(1,10)) . ' days' )),
	            'created_at' => date("Y-m-d H:i:s")
	        ]);
    	}
    }
}
