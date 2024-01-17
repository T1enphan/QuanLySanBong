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
        Schema::create('loai_khach_hangs', function (Blueprint $table) {
            $table->id();
            $table->string('ten_loai_khach');
            $table->string('slug_loai_khach');
            $table->integer('phan_tram_giam')->default(0);
            $table->integer('tinh_trang');
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
        Schema::dropIfExists('loai_khach_hangs');
    }
};
