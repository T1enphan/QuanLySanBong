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
        Schema::create('chi_tiet_doi_bong_giai_daus', function (Blueprint $table) {
            $table->id();
            $table->integer('id_giai_dau');
            $table->string('ten_doi_bong')->nullable();
            $table->integer('so_luong_cau_thu')->nullable();
            $table->longText('mo_ta_doi_bong')->nullable();
            $table->integer('diem_so')->nullable();
            $table->integer('bang_giai_dau')->nullable();
            $table->integer('tinh_trang_giai_dau')->default(1); //1 chưa bị loại, 0 đã bị loại
            $table->integer('ket_qua_giai_dau')->nullable();
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
        Schema::dropIfExists('chi_tiet_doi_bong_giai_daus');
    }
};
