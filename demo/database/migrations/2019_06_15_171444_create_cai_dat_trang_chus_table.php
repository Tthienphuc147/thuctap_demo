<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCaiDatTrangChusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cai_dat_trang_chus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('logo');
            $table->string('dia_chi');
            $table->string('dia_chi_map');
            $table->string('dien_thoai');
            $table->string('email');
            $table->string('ban_quyen');
            $table->string('twitter');
            $table->string('facebook');
            $table->string('instagram');
            $table->string('youtube');
            $table->string('app_facebook');
            $table->boolean('hien_thi_loai_ngau_nhien')->default(false);
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
        Schema::dropIfExists('cai_dat_trang_chus');
    }
}
