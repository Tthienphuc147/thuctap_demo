T<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCaiDatSanPhamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */ 

    public function up()
    {
        Schema::create('cai_dat_san_phams', function (Blueprint $table) {
           $table->bigIncrements('id');
           $table->integer('so_luong_noi_bat');
           $table->integer('so_luong_moi');
           $table->integer('so_luong_ban_chay');
           $table->integer('so_luong_theo_danh_muc');
           $table->integer('so_luong_khuyen_mai');
           $table->integer('so_luong_theo_loai_ngau_nhien');
           $table->integer('so_luong_sp_trang_danh_muc');
           $table->integer('so_luong_sp_trang_loai');
           $table->text('tu_khoa')->nullable();
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
        Schema::dropIfExists('cai_dat_san_phams');
    }
}
