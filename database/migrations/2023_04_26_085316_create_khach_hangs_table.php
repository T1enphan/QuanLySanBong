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
        Schema::create('khach_hangs', function (Blueprint $table) {
            $table->id();
            $table->string('ho_lot')->nullable();
            $table->string('ten');
            $table->string('ho_va_ten');
            $table->string('email');
            $table->string('so_dien_thoai');
            $table->string('dia_chi');
            $table->string('gioi_tinh')->nullable();
            $table->integer('id_loai_khach')->default(0);
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
        Schema::dropIfExists('khach_hangs');
    }
};
