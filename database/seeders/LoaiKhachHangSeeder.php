<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class LoaiKhachHangSeeder extends Seeder
{
    public function run()
    {
        DB::table('loai_khach_hangs')->delete();
        DB::table('loai_khach_hangs')->truncate();

        DB::table('loai_khach_hangs')->insert([
            [
                'ten_loai_khach'  => 'Khách Vip',
                'slug_loai_khach'    =>  Str::slug('Khách Vip'),
                'phan_tram_giam'  => '10',
                'tinh_trang'    => 1,

            ],
            [
                'ten_loai_khach'  => 'Khách Siêu Vip',
                'slug_loai_khach'    =>  Str::slug('Khách Siêu Vip'),
                'phan_tram_giam'  => '20',
                'tinh_trang'    => 1,

            ],
            [
                'ten_loai_khach'  => 'Khách Thường',
                'slug_loai_khach'  =>  Str::slug('Khách Thường'),
                'phan_tram_giam'  => '0',
                'tinh_trang'    => 1,

            ],

        ]);
    }
}
