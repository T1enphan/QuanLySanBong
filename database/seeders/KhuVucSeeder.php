<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KhuVucSeeder extends Seeder
{
    public function run()
    {
        DB::table('khu_vucs')->delete();
        DB::table('khu_vucs')->truncate();

        DB::table('khu_vucs')->insert([
            [
                'ten_khu_vuc'  => 'Khu A',
                'slug_khu_vuc'      =>  Str::slug('Khu A'),
                'tinh_trang'    => 1,
            ],
            [
                'ten_khu_vuc'  => 'Khu B',
                'slug_khu_vuc'      =>  Str::slug('Khu B'),
                'tinh_trang'    => 1,
            ],
            [
                'ten_khu_vuc'  => 'Khu C',
                'slug_khu_vuc'      =>  Str::slug('Khu C'),
                'tinh_trang'    => 1,
            ],
            [
                'ten_khu_vuc'  => 'Khu D',
                'slug_khu_vuc'      =>  Str::slug('Khu D'),
                'tinh_trang'    => 1,
            ],



        ]);
    }
}
