<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHoTrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ho_tros', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_admin')->unsigned()->nullable();
            $table->string('ho_ten');
            $table->string('email');
            $table->text('lien_he')->nullable();
            $table->text('noi_dung');
            $table->boolean('is_read')->default(false);
            $table->boolean('is_watched')->default(false);
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
        Schema::dropIfExists('ho_tros');
    }
}
