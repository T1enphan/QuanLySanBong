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
        Schema::create('hang_hoas', function (Blueprint $table) {
            $table->id();
            $table->string('ten_hang');
            $table->integer('gia_hang');
            $table->integer('so_luong')->default(0);
            $table->integer('tinh_trang');
            $table->integer('trang_thai_hang')->default(0);
            $table->integer('id_loai_hang');
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
        Schema::dropIfExists('hang_hoas');
    }
};
