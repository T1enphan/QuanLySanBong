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
        Schema::create('giai_daus', function (Blueprint $table) {
            $table->id();
            $table->string('ten_giai_dau');
            $table->longText('thong_tin_giai_dau');
            $table->integer('so_doi');
            $table->integer('so_tran');
            $table->integer('so_bang_dau');
            $table->integer('so_giai_thuong');
            $table->integer('tinh_trang')->default(0); //sắp bắt đầu (0), đang diễn ra(1), đã kết thúc (2)
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
        Schema::dropIfExists('giai_daus');
    }
};
