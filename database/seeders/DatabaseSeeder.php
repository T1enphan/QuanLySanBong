<?php

namespace Database\Seeders;

use App\Models\LoaiKhachHang;
use App\Models\LoaiSan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        $this->call(KhuVucSeeder::class);
        $this->call(LoaiSanSeeder::class);
        $this->call(SanSeeder::class);
        $this->call(LoaiKhachHangSeeder::class);
        $this->call(KhachHangSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(NhaCungCapSeeder::class);
        $this->call(HangHoaSeeder::class);
        $this->call(LoaiHangSeeder::class);
        $this->call(BaiVietSeeder::class);
        $this->call(ActionSeeder::class);
        $this->call(QuyenSeeder::class);

    }
}
