<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('actions')->delete();

        DB::table('actions')->truncate();

        DB::table('actions')->insert([
            ['id' => 1, 'ten_action' => 'Xem khu vực'],
            ['id' => 2, 'ten_action' => 'Thêm mới khu vực'],
            ['id' => 3, 'ten_action' => 'Cập nhật khu vực'],
            ['id' => 4, 'ten_action' => 'Xóa khu vực'],
            ['id' => 5, 'ten_action' => 'Đổi trạng thái khu vực'],
            ['id' => 6, 'ten_action' => 'Xem loại sân'],
            ['id' => 7, 'ten_action' => 'Thêm mới loại sân'],
            ['id' => 8, 'ten_action' => 'Cập nhật loại sân'],
            ['id' => 9, 'ten_action' => 'Xóa kloại sân'],
            ['id' => 10, 'ten_action' => 'Đổi trạng thái loại sân'],
            ['id' => 11, 'ten_action' => 'Xem sân'],
            ['id' => 12, 'ten_action' => 'Thêm mới sân'],
            ['id' => 13, 'ten_action' => 'Cập nhật sân'],
            ['id' => 14, 'ten_action' => 'Xóa sân'],
            ['id' => 15, 'ten_action' => 'Đổi trạng thái sân'],

            ['id' => 16, 'ten_action' => 'Xem loại khách hàng'],
            ['id' => 17, 'ten_action' => 'Thêm mới loại khách hàng'],
            ['id' => 18, 'ten_action' => 'Cập nhật loại khách hàng'],
            ['id' => 19, 'ten_action' => 'Xóa loại khách hàng'],
            ['id' => 20, 'ten_action' => 'Đổi trạng thái loại khách hàng'],

            ['id' => 21, 'ten_action' => 'Xem khách hàng'],
            ['id' => 22, 'ten_action' => 'Thêm mới khách hàng'],
            ['id' => 23, 'ten_action' => 'Cập nhật khách hàng'],
            ['id' => 24, 'ten_action' => 'Xóa khách hàng'],
            ['id' => 25, 'ten_action' => 'Đổi trạng thái khách hàng'],
            ['id' => 26, 'ten_action' => 'Tìm kiếm khách hàng'],

            ['id' => 27, 'ten_action' => 'Xem tài khoản admin'],
            ['id' => 28, 'ten_action' => 'Thêm mới tài khoản admin'],
            ['id' => 29, 'ten_action' => 'Cập nhật tài khoản admin'],
            ['id' => 30, 'ten_action' => 'Xóa tài khoản admin'],
            ['id' => 31, 'ten_action' => 'Đổi trạng thái tài khoản admin'],
            ['id' => 32, 'ten_action' => 'Đổi mật khẩu tài khoản admin'],

            ['id' => 33, 'ten_action' => 'Xem nhà cung cấp'],
            ['id' => 34, 'ten_action' => 'Thêm mới nhà cung cấp'],
            ['id' => 35, 'ten_action' => 'Cập nhật nhà cung cấp'],
            ['id' => 36, 'ten_action' => 'Xóa nhà cung cấp'],
            ['id' => 37, 'ten_action' => 'Đổi trạng thái nhà cung cấp'],
            ['id' => 38, 'ten_action' => 'Tìm kiếm nhà cung cấp'],

            ['id' => 39, 'ten_action' => 'Xem loại hàng'],
            ['id' => 40, 'ten_action' => 'Thêm mới loại hàng'],
            ['id' => 41, 'ten_action' => 'Cập nhật loại hàng'],
            ['id' => 42, 'ten_action' => 'Xóa loại hàng'],
            ['id' => 43, 'ten_action' => 'Đổi trạng thái loại hàng'],

            ['id' => 44, 'ten_action' => 'Xem hàng hóa'],
            ['id' => 45, 'ten_action' => 'Thêm mới hàng hóa'],
            ['id' => 46, 'ten_action' => 'Cập nhật hàng hóa'],
            ['id' => 47, 'ten_action' => 'Xóa hàng hóa'],
            ['id' => 48, 'ten_action' => 'Đổi trạng thái hàng hóa'],
        ]);
    }
}
