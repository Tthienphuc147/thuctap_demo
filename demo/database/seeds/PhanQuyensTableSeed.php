<?php

use Illuminate\Database\Seeder;

class PhanQuyensTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('phan')->insert([
    		'id_admin' => 1,
    		'cay_thu_muc' => false, 
    		'danh_muc_san_pham' => false, 
    		'loai_san_pham' => false, 
    		'san_pham' => false, 
    		'phan_hoi_san_pham' => false, 
    		'danh_sach_hoa_don' => false, 
    		'danh_muc_tin_tuc' => false, 
    		'loai_tin_tuc' => false, 
    		'tin_tuc' => false, 
    		'danh_muc_dich_vu' => false, 
    		'loai_dich_vu' => false, 
    		'dich_vu' => false, 
    		'quan_tri_vien' => false, 
    		'nguoi_dung' => false, 
    		'ho_tro' => false, 
    		'giai_dap_thac_mac' => false, 
    		'cai_dat_trang_chu' => false, 
    		'cai_dat_san_pham' => false, 
    		'cai_dat_tin_tuc' => false,      
    		'cai_dat_dich_vu' => false,       
    		'created_at' => date("Y-m-d H:i:s")
    	]);
    }
}
