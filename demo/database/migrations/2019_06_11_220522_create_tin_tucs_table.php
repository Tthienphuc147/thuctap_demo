<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTinTucsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tin_tucs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_loai_tin_tuc')->unsigned();
            $table->foreign('id_loai_tin_tuc')->references('id')->on('loai_tin_tucs');
            $table->bigInteger('id_admin')->unsigned();
            $table->foreign('id_admin')->references('id')->on('admins');
            $table->text('tieu_de');
            $table->text('mo_ta');
            $table->longText('noi_dung')->nullable();
            $table->text('hinh_anh')->nullable();
            $table->bigInteger('luot_xem')->default(0);
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
        Schema::dropIfExists('tin_tucs');
    }
}
