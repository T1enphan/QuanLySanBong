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
        Schema::create('chi_tiet_hoa_don_dich_vus', function (Blueprint $table) {
            $table->id();
            $table->integer('id_hang');
            $table->string('ten_hang');
            $table->integer('id_thue_san')->nullable();
            $table->integer('id_hoa_don_dich_vu')->nullable();
            $table->integer('so_luong_ban');
            $table->integer('don_gia_ban');
            $table->integer('thanh_tien');
            $table->integer('trang_thai')->default(0);
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
        Schema::dropIfExists('chi_tiet_hoa_don_dich_vus');
    }
};
