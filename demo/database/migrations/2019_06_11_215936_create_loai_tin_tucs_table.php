<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoaiTinTucsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loai_tin_tucs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_danh_muc_tin_tuc')->unsigned();
            $table->foreign('id_danh_muc_tin_tuc')->references('id')->on('danh_muc_tin_tucs');
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
        Schema::dropIfExists('loai_tin_tucs');
    }
}
