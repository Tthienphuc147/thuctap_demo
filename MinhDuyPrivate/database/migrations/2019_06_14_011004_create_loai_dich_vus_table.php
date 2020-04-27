<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoaiDichVusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loai_dich_vus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_danh_muc_dich_vu')->unsigned();
            $table->foreign('id_danh_muc_dich_vu')->references('id')->on('danh_muc_dich_vus');
            $table->text('ten');
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
        Schema::dropIfExists('loai_dich_vus');
    }
}
