<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiTietDoiBongGiaiDau extends Model
{
    use HasFactory;

    protected $table = 'chi_tiet_doi_bong_giai_daus';

    protected $fillable = [
        'id_giai_dau',
        'ten_doi_bong',
        'so_luong_cau_thu',
        'mo_ta_doi_bong',
        'bang_giai_dau',
        'diem_so',
        'tinh_trang_giai_dau',
        'ket_qua_giai_dau',
    ];
}
