<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChiTietHoaDonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chi_tiet_hoa_dons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_sp')->unsigned();
            $table->foreign('id_sp')->references('id')->on('san_phams');
            $table->bigInteger('id_hoa_don')->unsigned();
            $table->foreign('id_hoa_don')->references('id')->on('hoa_dons');
            $table->integer('so_luong');
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
        Schema::dropIfExists('chi_tiet_hoa_dons');
    }
}
