<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HoaDonDichVu extends Model
{
    use HasFactory;
    protected $table = 'hoa_don_dich_vus';

    protected $fillable = [
        'ma_hoa_don',
        'tong_tien',
        'id_nhan_vien',
        'trang_thai',
        'ngay_thanh_toan'
    ];
}
