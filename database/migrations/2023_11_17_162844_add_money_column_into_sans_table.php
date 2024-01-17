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
        Schema::table('sans', function(Blueprint $table) {
            $table->integer('tien_goc')->default(0)->after('tinh_trang');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sans', function(Blueprint $table) {
            $table->dropColumn('tien_goc');
        });
    }
};
