<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDichVusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dich_vus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_loai_dich_vu')->unsigned();
            $table->foreign('id_loai_dich_vu')->references('id')->on('loai_dich_vus');
            $table->text('tieu_de');
            $table->text('mo_ta');
            $table->longText('noi_dung')->nullable();
            $table->text('hinh_anh')->nullable();
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
        Schema::dropIfExists('dich_vus');
    }
}
