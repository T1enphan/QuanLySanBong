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
        Schema::create('tran_dau_cua_giais', function (Blueprint $table) {
            $table->id();
            $table->integer('id_giai_dau');
            $table->integer('id_doi_bong_giai_1')->nullable();
            $table->integer('id_doi_bong_giai_2')->nullable();
            $table->integer('id_hoa_don_thue_san')->nullable();
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
        Schema::dropIfExists('tran_dau_cua_giais');
    }
};
