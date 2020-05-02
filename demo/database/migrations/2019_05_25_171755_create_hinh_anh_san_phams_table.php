<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHinhAnhSanPhamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hinh_anh_san_phams', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_sp')->unsigned();
            $table->foreign('id_sp')->references('id')->on('san_phams');
            $table->text('ten');
            $table->boolean('hinh_chinh');
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
        Schema::dropIfExists('hinh_anh_san_phams');
    }
}
