<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhanHoiSanPhamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phan_hoi_san_phams', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_sp')->unsigned();
            $table->foreign('id_sp')->references('id')->on('san_phams');
            $table->string('ten_hien_thi');
            $table->string('email');
            $table->text('noi_dung');
            $table->boolean('doc')->default(false);
            $table->boolean('xem')->default(false);
            $table->boolean('duyet')->default(false);
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
        Schema::dropIfExists('phan_hoi_san_phams');
    }
}
