<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TmpDatSan extends Model
{
    use HasFactory;

    protected $table = 'tmp_dat_sans';

    protected $fillable = [
        'ma_thanh_toan',
        'id_san',
        'id_khach_hang',
        'ngay_thue_san',
        'gio_bat_dau',
        'gio_ket_thuc',
        'so_tien',
        'phan_tram_giam',
        'tong_tien_thanh_toan',
        'img_qr',
        'is_thanh_toan',
    ];
}
