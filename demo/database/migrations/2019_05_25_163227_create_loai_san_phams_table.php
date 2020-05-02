<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoaiSanPhamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loai_san_phams', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_danh_muc_sp')->unsigned();
            $table->foreign('id_danh_muc_sp')->references('id')->on('danh_muc_san_phams');
            $table->text('ten');
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
        Schema::dropIfExists('loai_san_phams');
    }
}
