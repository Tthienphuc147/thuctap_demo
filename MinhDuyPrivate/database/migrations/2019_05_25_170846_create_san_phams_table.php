<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSanPhamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('san_phams', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_loai_sp')->unsigned();
            $table->foreign('id_loai_sp')->references('id')->on('loai_san_phams');
            $table->text('ten');
            $table->text('mo_ta')->nullable();
            $table->longText('thong_so')->nullable();
            $table->longText('thong_tin_chi_tiet')->nullable();
            $table->integer('gia_goc');
            $table->integer('khuyen_mai')->default(0);
            $table->integer('gia_ban')->nullable();
            $table->dateTime('ngay_bat_dau_khuyen_mai')->nullable();
            $table->dateTime('ngay_ket_thuc_khuyen_mai')->nullable();
            $table->boolean('moi')->default(false);
            $table->boolean('noi_bat')->default(false);
            $table->boolean('ban_chay')->default(false);
            $table->boolean('gui_mail')->default(false);
            $table->boolean('is_delete')->default(false);
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
        Schema::dropIfExists('san_phams');
    }
}
