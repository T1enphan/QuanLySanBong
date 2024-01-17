<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class LoaiHangSeeder extends Seeder
{
    public function run()
    {
        DB::table('loai_hang_hoas')->delete();
        DB::table('loai_hang_hoas')->truncate();

        DB::table('loai_hang_hoas')->insert([

            [
                'ten_loai_hang'        => 'Đồ Uống',
                'slug_loai_hang'       =>  Str::slug('Đồ Uống'),
                'tinh_trang'           => 1,
            ],
            [
                'ten_loai_hang'        => 'Áo Thể Thao',
                'slug_loai_hang'       =>  Str::slug('Áo Thể Thao'),
                'tinh_trang'           => 1,
            ],
            [
                'ten_loai_hang'        => 'Thuốc Lá',
                'slug_loai_hang'       =>  Str::slug('Thuốc Lá'),
                'tinh_trang'           => 1,
            ],
            [
                'ten_loai_hang'        => 'Cà Phê',
                'slug_loai_hang'       =>  Str::slug('Cà Phê'),
                'tinh_trang'           => 1,
            ],
            [
                'ten_loai_hang'        => 'Phụ Kiện Bóng Đá',
                'slug_loai_hang'       =>  Str::slug('Phụ Kiện Bóng Đá'),
                'tinh_trang'           => 1,
            ],

        ]);
    }
}
