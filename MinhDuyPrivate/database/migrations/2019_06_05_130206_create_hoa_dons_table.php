<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHoaDonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hoa_dons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ma_hoa_don'); //= HDMD + time()
            $table->string('ten_khach_hang');
            $table->string('so_dien_thoai');
            $table->string('email');
            $table->string('province_id');
            $table->string('district_id');
            $table->string('ward_id');
            $table->string('dia_chi');
            $table->integer('trang_thai')->default(1);
            $table->integer('phi_ship')->nullable();
            $table->text('ghi_chu')->nullable();
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
        Schema::dropIfExists('hoa_dons');
    }
}
