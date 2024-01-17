<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LoaiSanSeeder extends Seeder
{
    public function run()
    {
        DB::table('loai_sans')->delete();
        DB::table('loai_sans')->truncate();

        DB::table('loai_sans')->insert([

            [
                'loai_san'          => 'Sân bóng đá 5 người - Cỏ nhân tạo',
                'slug_loai_san'     =>  Str::slug('Sân bóng đá 5 người - Cỏ nhân tạo'),
                'tinh_trang'        => 1,
            ],
            [
                'loai_san'          => 'Sân bóng đá 7 người - Cỏ nhân tạo',
                'slug_loai_san'     =>  Str::slug('Sân bóng đá 7 người - Cỏ nhân tạo'),
                'tinh_trang'        => 1,
            ],
            [
                'loai_san'          => 'Sân bóng đá 11 người - Cỏ nhân tạo',
                'slug_loai_san'     =>  Str::slug('Sân bóng đá 11 người - Cỏ nhân tạo'),
                'tinh_trang'        => 1,
            ],
            [
                'loai_san'          => 'Sân bóng đá 5 người - Cỏ tự nhiên',
                'slug_loai_san'     =>  Str::slug('Sân bóng đá 5 người - Cỏ tự nhiên'),
                'tinh_trang'        => 1,
            ],
        ]);
    }
}
