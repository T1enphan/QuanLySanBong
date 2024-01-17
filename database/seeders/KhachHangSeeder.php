<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class KhachHangSeeder extends Seeder
{
    public function run()
    {
        DB::table('khach_hangs')->delete();
        DB::table('khach_hangs')->truncate();

        DB::table('khach_hangs')->insert([
            [
                'ho_lot'         => 'Phùng Văn',
                'ten'            => 'Mạnh',
                'ho_va_ten'      => 'Phùng Văn Mạnh',
                'dia_chi'        => 'Quảng Nam',
                'email'          => 'phungmanh@gmail.com',
                'password'       => bcrypt(123456),
                'hash'           => Str::uuid(),
                'so_dien_thoai'  => '0123456789',
                'gioi_tinh'      => 1,
                'id_loai_khach'  => 1,
                'is_active'      => 1

            ],
            [
                'ho_lot'         => 'Nguyễn',
                'ten'            => 'Phong',
                'ho_va_ten'      => 'Nguyễn Phong',
                'dia_chi'        => 'Quảng Nam',
                'email'          => 'nguyenphong@gmail.com',
                'password'       => bcrypt(123456),
                'hash'           => Str::uuid(),
                'so_dien_thoai'  => '0123456789',
                'gioi_tinh'      => 1,
                'id_loai_khach'  => 1,
                'is_active'      => 1

            ],
            [
                'ho_lot'         => 'Võ Quốc',
                'ten'            => 'Triệu',
                'ho_va_ten'      => 'Võ Quốc Triệu',
                'dia_chi'        => 'Quảng Nam',
                'email'          => 'quoctrieu@gmail.com',
                'password'       => bcrypt(123456),
                'hash'           => Str::uuid(),
                'so_dien_thoai'  => '0123456789',
                'gioi_tinh'      => 1,
                'id_loai_khach'  => 1,
                'is_active'      => 1

            ],
            [
                'ho_lot'         => 'Võ Quốc',
                'ten'            => 'Huy',
                'ho_va_ten'      => 'Võ Quốc Huy',
                'dia_chi'        => 'Quảng Nam',
                'email'          => 'quochuy@gmail.com',
                'password'       => bcrypt(123456),
                'hash'           => Str::uuid(),
                'so_dien_thoai'  => '0123456789',
                'gioi_tinh'      => 1,
                'id_loai_khach'  => 1,
                'is_active'      => 1

            ],
            [
                'ho_lot'         => 'Võ',
                'ten'            => 'Quốc',
                'ho_va_ten'      => 'Võ Quốc',
                'dia_chi'        => 'Thăng Bình',
                'email'          => 'voquoc@gmail.com',
                'password'       => bcrypt(123456),
                'hash'           => Str::uuid(),
                'so_dien_thoai'  => '0889470271',
                'gioi_tinh'      => 1,
                'id_loai_khach'  => 3,
                'is_active'      => 1

            ],
            [
                'ho_lot'         => 'Nguyễn Văn',
                'ten'            => 'Cừ',
                'ho_va_ten'      => 'Nguyễn Văn Cừ',
                'dia_chi'        => 'Đà Nẵng',
                'email'          => 'nguyenvancu@gmail.com',
                'password'       => bcrypt(123456),
                'hash'           => Str::uuid(),
                'so_dien_thoai'  => '0889470271',
                'gioi_tinh'      => 1,
                'id_loai_khach'  => 2,
                'is_active'      => 1

            ],
            [
                'ho_lot'         => 'Nguyễn Văn',
                'ten'            => 'Tiến',
                'ho_va_ten'      => 'Nguyễn Văn Tiến',
                'dia_chi'        => 'Đà Nẵng',
                'email'          => 'nguyenvantien@gmail.com',
                'password'       => bcrypt(123456),
                'hash'           => Str::uuid(),
                'so_dien_thoai'  => '0123123123',
                'gioi_tinh'      => 1,
                'id_loai_khach'  => 2,
                'is_active'      => 1

            ],
            [
                'ho_lot'         => 'Trần Văn',
                'ten'            => 'Lê',
                'ho_va_ten'      => 'Trần Văn Lê',
                'dia_chi'        => 'Đà Nẵng',
                'email'          => 'tranvanle@gmail.com',
                'password'       => bcrypt(123456),
                'hash'           => Str::uuid(),
                'so_dien_thoai'  => '0123123123',
                'gioi_tinh'      => 1,
                'id_loai_khach'  => 2,
                'is_active'      => 1

            ],




        ]);
    }
}
