<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tmp_dat_sans', function (Blueprint $table) {
            $table->id();
            $table->string('ma_thanh_toan');
            $table->integer('id_san');
            $table->integer('id_khach_hang');
            $table->date('ngay_thue_san');
            $table->time('gio_bat_dau');
            $table->time('gio_ket_thuc');
            $table->integer('so_tien');
            $table->integer('phan_tram_giam');
            $table->integer('tong_tien_thanh_toan');
            $table->string('img_qr');
            $table->integer('is_thanh_toan')->default(0);
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
        Schema::dropIfExists('tmp_dat_sans');
    }
};
