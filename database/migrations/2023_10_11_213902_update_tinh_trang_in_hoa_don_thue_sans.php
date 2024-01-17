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
        Schema::table('hoa_don_thue_sans', function (Blueprint $table) {
            $table->integer('tinh_trang')->comment('1 : là đang thuê, 2: là đã tính tiền; 3: khách đặt trước')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hoa_don_thue_sans', function (Blueprint $table) {
            $table->integer('tinh_trang')->comment('1 : là đang thuê, 2: là đã tính tiền')->change();

        });
    }
};
