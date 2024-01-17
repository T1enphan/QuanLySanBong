<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class SanSeeder extends Seeder
{
    public function run()
    {
        DB::table('sans')->delete();
        DB::table('sans')->truncate();

        DB::table('sans')->insert([
            [
                'ten_san'           => 'Sân A1',
                'slug_ten_san'      =>  Str::slug('Sân A1'),
                'id_khu_vuc'        => 1,
                'id_loai_san'       => 2,
                'tinh_trang'        => 1,
                'tien_goc'          => 100000,
            ],
            [
                'ten_san'           => 'Sân A2',
                'slug_ten_san'      =>  Str::slug('Sân A2'),
                'id_khu_vuc'        => 1,
                'id_loai_san'       => 3,
                'tinh_trang'        => 1,
                'tien_goc'          => 100000,
            ],
            [
                'ten_san'            => 'Sân A3',
                'slug_ten_san'       =>  Str::slug('Sân A3'),
                'id_khu_vuc'         => 1,
                'id_loai_san'        => 3,
                'tinh_trang'         => 1,
                'tien_goc'          => 100000,
            ],
            [
                'ten_san'           => 'Sân A4',
                'slug_ten_san'      =>  Str::slug('Sân A4'),
                'id_khu_vuc'        => 1,
                'id_loai_san'       => 1,
                'tinh_trang'        => 1,
                'tien_goc'          => 100000,
            ],

            [
                'ten_san'         => 'Sân B1',
                'slug_ten_san'    =>  Str::slug('Sân B1'),
                'id_khu_vuc'      => 2,
                'id_loai_san'     => 2,
                'tinh_trang'      => 1,
                'tien_goc'        => 100000,
            ],
            [
                'ten_san'       => 'Sân B2',
                'slug_ten_san'  =>  Str::slug('Sân B2'),
                'id_khu_vuc'    => 2,
                'id_loai_san'   => 3,
                'tinh_trang'    => 1,
                'tien_goc'      => 100000,
            ],
            [
                'ten_san'       => 'Sân B3',
                'slug_ten_san'  =>  Str::slug('Sân B3'),
                'id_khu_vuc'    => 2,
                'id_loai_san'   => 3,
                'tinh_trang'    => 1,
                'tien_goc'      => 100000,
            ],
            [
                'ten_san'       => 'Sân B4',
                'slug_ten_san'  =>  Str::slug('Sân B4'),
                'id_khu_vuc'    => 2,
                'id_loai_san'   => 1,
                'tinh_trang'    => 1,
                'tien_goc'      => 100000,
            ],
            [
                'ten_san'       => 'Sân B5',
                'slug_ten_san'  =>  Str::slug('Sân B5'),
                'id_khu_vuc'    => 2,
                'id_loai_san'   => 4,
                'tinh_trang'    => 1,
                'tien_goc'      => 100000,
            ],

            [
                'ten_san'         => 'Sân C1',
                'slug_ten_san'    =>  Str::slug('Sân C1'),
                'id_khu_vuc'      => 3,
                'id_loai_san'     => 2,
                'tinh_trang'      => 1,
                'tien_goc'      => 100000,
            ],
            [
                'ten_san'       => 'Sân C2',
                'slug_ten_san'  =>  Str::slug('Sân C2'),
                'id_khu_vuc'    => 3,
                'id_loai_san'   => 4,
                'tinh_trang'    => 1,
                'tien_goc'      => 100000,
            ],
            [
                'ten_san'       => 'Sân C3',
                'slug_ten_san'  =>  Str::slug('Sân C3'),
                'id_khu_vuc'    => 3,
                'id_loai_san'   => 3,
                'tinh_trang'    => 1,
                'tien_goc'      => 100000,
            ],
            [
                'ten_san'       => 'Sân C4',
                'slug_ten_san'  =>  Str::slug('Sân C4'),
                'id_khu_vuc'    => 3,
                'id_loai_san'   => 4,
                'tinh_trang'    => 1,
                'tien_goc'      => 100000,
            ],

            [
                'ten_san'         => 'Sân D1',
                'slug_ten_san'    =>  Str::slug('Sân D1'),
                'id_khu_vuc'      => 4,
                'id_loai_san'     => 1,
                'tinh_trang'      => 1,
                'tien_goc'       => 100000,
            ],
            [
                'ten_san'       => 'Sân D2',
                'slug_ten_san'  =>  Str::slug('Sân D2'),
                'id_khu_vuc'    => 4,
                'id_loai_san'   => 3,
                'tinh_trang'    => 1,
                'tien_goc'      => 100000,
            ],
            [
                'ten_san'       => 'Sân D3',
                'slug_ten_san'  =>  Str::slug('Sân D3'),
                'id_khu_vuc'    => 4,
                'id_loai_san'   => 2,
                'tinh_trang'    => 1,
                'tien_goc'      => 100000,
            ],
            [
                'ten_san'       => 'Sân D4',
                'slug_ten_san'  =>  Str::slug('Sân D4'),
                'id_khu_vuc'    => 4,
                'id_loai_san'   => 2,
                'tinh_trang'    => 1,
                'tien_goc'      => 100000,
            ],


        ]);
    }
}
