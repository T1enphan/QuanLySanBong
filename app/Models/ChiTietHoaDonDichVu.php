<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiTietHoaDonDichVu extends Model
{
    use HasFactory;
    protected $table = 'chi_tiet_hoa_don_dich_vus';

    protected $fillable = [
        'id_hang',
        'ten_hang',
        'id_thue_san',
        'id_hoa_don_dich_vu',
        'so_luong_ban',
        'don_gia_ban',
        'thanh_tien',
        'trang_thai',
    ];
}
