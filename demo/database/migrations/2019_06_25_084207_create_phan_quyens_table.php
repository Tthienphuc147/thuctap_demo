<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhanQuyensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phan_quyens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_admin')->unsigned(); 
            $table->foreign('id_admin')->references('id')->on('Admins');
            $table->boolean('cay_thu_muc')->default(false); 
            $table->boolean('danh_muc_san_pham')->default(false); 
            $table->boolean('loai_san_pham')->default(false); 
            $table->boolean('san_pham')->default(false); 
            $table->boolean('phan_hoi_san_pham')->default(false); 
            $table->boolean('danh_sach_hoa_don')->default(false); 
            $table->boolean('danh_muc_tin_tuc')->default(false); 
            $table->boolean('loai_tin_tuc')->default(false); 
            $table->boolean('tin_tuc')->default(false); 
            $table->boolean('danh_muc_dich_vu')->default(false); 
            $table->boolean('loai_dich_vu')->default(false); 
            $table->boolean('dich_vu')->default(false); 
            $table->boolean('quan_tri_vien')->default(false); 
            $table->boolean('nguoi_dung')->default(false); 
            $table->boolean('ho_tro')->default(false); 
            $table->boolean('giai_dap_thac_mac')->default(false); 
            $table->boolean('cai_dat_trang_chu')->default(false); 
            $table->boolean('cai_dat_san_pham')->default(false); 
            $table->boolean('cai_dat_tin_tuc')->default(false); 
            $table->boolean('cai_dat_dich_vu')->default(false); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('phan_quyens');
    }
}
