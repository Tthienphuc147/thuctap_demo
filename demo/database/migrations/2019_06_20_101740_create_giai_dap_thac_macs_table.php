<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGiaiDapThacMacsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('giai_dap_thac_macs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('cau_hoi');
            $table->text('tra_loi');
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
        Schema::dropIfExists('giai_dap_thac_macs');
    }
}
