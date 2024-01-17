<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HoaDonThueSan extends Model
{
    use HasFactory;

    protected $table = 'hoa_don_thue_sans';

    protected $fillable = [
        'ma_hoa_don',
        'id_san',
        'id_khach_hang',
        'id_nguoi_tao',
        'ngay_thue_san',
        'gio_bat_dau',
        'gio_ket_thuc',
        'so_tien',
        'phan_tram_giam',
        'tien_da_giam',
        'tong_tien_thanh_toan',
        'tien_tra_truoc',
        'tinh_trang',
        'is_open',
        'is_thanh_toan'
    ];
}
