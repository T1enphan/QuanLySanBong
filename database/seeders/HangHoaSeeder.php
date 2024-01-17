<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class HangHoaSeeder extends Seeder
{
    public function run()
    {
        DB::table('hang_hoas')->delete();
        DB::table('hang_hoas')->truncate();

        DB::table('hang_hoas')->insert([
            [
                'ten_hang'          => 'Coca',
                'gia_hang'          => 15000,
                'tinh_trang'        => 1,
                'id_loai_hang'      => 1,
            ],
            [
                'ten_hang'          => 'Sting',
                'gia_hang'          => 15000,
                'tinh_trang'        => 1,
                'id_loai_hang'      => 1,
            ],
            [
                'ten_hang'          => 'Revice',
                'gia_hang'          => 15000,
                'tinh_trang'        => 1,
                'id_loai_hang'      => 1,
            ],
            [
                'ten_hang'          => 'Trà Xanh Không Độ',
                'gia_hang'          => 15000,
                'tinh_trang'        => 1,
                'id_loai_hang'      => 1,
            ],
            [
                'ten_hang'          => 'Suối',
                'gia_hang'          => 12000,
                'tinh_trang'        => 1,
                'id_loai_hang'      => 1,
            ],
            [
                'ten_hang'          => 'Pepsi',
                'gia_hang'          => 15000,
                'tinh_trang'        => 1,
                'id_loai_hang'      => 1,
            ],
            [
                'ten_hang'          => '7UP',
                'gia_hang'          => 15000,
                'tinh_trang'        => 1,
                'id_loai_hang'      => 1,
            ],
            [
                'ten_hang'          => 'Chanh Muối',
                'gia_hang'          => 15000,
                'tinh_trang'        => 1,
                'id_loai_hang'      => 1,
            ],
            [
                'ten_hang'          => 'Khoáng',
                'gia_hang'          => 15000,
                'tinh_trang'        => 1,
                'id_loai_hang'      => 1,
            ],
            [
                'ten_hang'          => 'Bò Húc',
                'gia_hang'          => 15000,
                'tinh_trang'        => 1,
                'id_loai_hang'      => 1,
            ],
            [
                'ten_hang'          => 'AQUA',
                'gia_hang'          => 15000,
                'tinh_trang'        => 1,
                'id_loai_hang'      => 1,
            ],

            [
                'ten_hang'          => 'Áo Đội Tuyển',
                'gia_hang'          => 200000,
                'tinh_trang'        => 1,
                'id_loai_hang'      => 2,
            ],
            [
                'ten_hang'          => 'Áo Câu Lạc Bộ',
                'gia_hang'          => 190000,
                'tinh_trang'        => 1,
                'id_loai_hang'      => 2,
            ],
            [
                'ten_hang'          => 'Áo Không Logo Độc Quyền',
                'gia_hang'          => 250000,
                'tinh_trang'        => 1,
                'id_loai_hang'      => 2,
            ],

            [
                'ten_hang'          => 'Mèo',
                'gia_hang'          => 15000,
                'tinh_trang'        => 1,
                'id_loai_hang'      => 3,
            ],
            [
                'ten_hang'          => 'Ngựa',
                'gia_hang'          => 30000,
                'tinh_trang'        => 1,
                'id_loai_hang'      => 3,
            ],
            [
                'ten_hang'          => 'Camel',
                'gia_hang'          => 25000,
                'tinh_trang'        => 1,
                'id_loai_hang'      => 3,
            ],

            [
                'ten_hang'          => 'Cà Phê Sữa SG',
                'gia_hang'          => 15000,
                'tinh_trang'        => 1,
                'id_loai_hang'      => 4,
            ],
            [
                'ten_hang'          => 'Cà Phê Đen',
                'gia_hang'          => 14000,
                'tinh_trang'        => 1,
                'id_loai_hang'      => 4,
            ],
            [
                'ten_hang'          => 'Bạc Xỉu',
                'gia_hang'          => 15000,
                'tinh_trang'        => 1,
                'id_loai_hang'      => 4,
            ],

            [
                'ten_hang'          => 'Bóng',
                'gia_hang'          => 100000,
                'tinh_trang'        => 1,
                'id_loai_hang'      => 5,
            ],
            [
                'ten_hang'          => 'Găng Tay Thủ Môn',
                'gia_hang'          => 150000,
                'tinh_trang'        => 1,
                'id_loai_hang'      => 5,
            ],
            [
                'ten_hang'          => 'Balo Bóng Đá',
                'gia_hang'          => 200000,
                'tinh_trang'        => 1,
                'id_loai_hang'      => 5,
            ],
            [
                'ten_hang'          => 'Cup Lưu Niệm Bóng Đá',
                'gia_hang'          => 250000,
                'tinh_trang'        => 1,
                'id_loai_hang'      => 5,
            ],

        ]);
    }
}
