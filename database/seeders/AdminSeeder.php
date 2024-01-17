<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    public function run()
    {
        DB::table('admins')->delete();
        DB::table('admins')->truncate();

        DB::table('admins')->insert([
            [
                'ho_va_ten'         => "Admin",
                'email'             => "admin@master.com",
                'so_dien_thoai'     => "0345884657",
                'ngay_sinh'         => "2023-01-01",
                'password'          => bcrypt("123456"),
                'dia_chi'           => 'Thăng Bình',
                'anh_dai_dien'      => '/assets_admin/images/avatars/avatar-7.png',
                'hash'              => Str::uuid(),
                'id_quyen'          => 1,

            ],
            [
                'ho_va_ten'         => "Nguyễn Phong",
                'email'             => "nguyenphong080701@gmail.com",
                'so_dien_thoai'     => "0345884657",
                'ngay_sinh'         => "2023-01-01",
                'password'          => bcrypt("123456"),
                'dia_chi'           => 'Thăng Bình',
                'anh_dai_dien'      => '/assets_admin/images/avatars/avatar-14.png',
                'hash'              => Str::uuid(),
                'id_quyen'          => 2,

            ],
            [
                'ho_va_ten'         => "Võ Đình Quốc Huy",
                'email'             => "vodinhquochuy1511@gmail.com",
                'so_dien_thoai'     => "0889470271",
                'ngay_sinh'         => "2023-01-01",
                'password'          => bcrypt("123456"),
                'dia_chi'           => 'Hà Lam',
                'anh_dai_dien'      => '/assets_admin/images/avatars/nhanvien.png',
                'hash'              => Str::uuid(),
                'id_quyen'          => 3,
            ],
        ]);
    }
}
