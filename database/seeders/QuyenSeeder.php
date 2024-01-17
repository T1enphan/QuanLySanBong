<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuyenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('phan_quyens')->delete();

        DB::table('phan_quyens')->truncate();

        DB::table('phan_quyens')->insert([
            [
                'ten_quyen'  => 'Admin',
                'tinh_trang'  => 1,
                'is_master'  => 1
            ],
            [
                'ten_quyen'  => 'Quản Lý',
                'tinh_trang'  => 1,
                'is_master'  => 0
            ],
            [
                'ten_quyen'  => 'Kế Toán',
                'tinh_trang'  => 1,
                'is_master'  => 0
            ],
            [
                'ten_quyen'  => 'Nhân Viên',
                'tinh_trang'  => 1,
                'is_master'  => 0
            ],

        ]);
    }
}
