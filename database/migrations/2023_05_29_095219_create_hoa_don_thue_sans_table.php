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
        Schema::create('hoa_don_thue_sans', function (Blueprint $table) {
            $table->id();
            $table->string('ma_hoa_don')->nullable();
            $table->integer('id_san');
            $table->integer('id_khach_hang')->nullable();
            $table->integer('id_nguoi_tao')->nullable();
            $table->date('ngay_thue_san')->nullable();
            $table->time('gio_bat_dau')->nullable();
            $table->time('gio_ket_thuc')->nullable();
            $table->integer('so_tien')->nullable();
            $table->integer('phan_tram_giam')->nullable();
            $table->integer('tien_da_giam')->nullable();
            $table->integer('tong_tien_thanh_toan')->nullable();
            $table->integer('tinh_trang')->nullable()->comment('1 : là admin mở, 2: là đã tính tiền, 3: client đặt chưa thanh toán');
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
        Schema::dropIfExists('hoa_don_thue_sans');
    }
};
