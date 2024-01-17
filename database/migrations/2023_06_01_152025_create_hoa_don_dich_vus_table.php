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
        Schema::create('hoa_don_dich_vus', function (Blueprint $table) {
            $table->id();
            $table->string('ma_hoa_don');
            $table->integer('tong_tien');
            $table->integer('id_nhan_vien')->default(1);
            $table->integer('trang_thai')->default(0);
            $table->dateTime('ngay_thanh_toan')->nullable();
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
        Schema::dropIfExists('hoa_don_dich_vus');
    }
};
