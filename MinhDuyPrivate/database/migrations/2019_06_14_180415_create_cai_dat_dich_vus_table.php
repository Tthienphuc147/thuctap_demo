<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCaiDatDichVusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cai_dat_dich_vus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('so_luong_danh_muc');
            $table->integer('so_luong_the_loai');
            $table->integer('so_luong_tat_ca');
            $table->integer('so_luong_tim_kiem');
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
        Schema::dropIfExists('cai_dat_dich_vus');
    }
}
