<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiaiDau extends Model
{
    use HasFactory;

    protected $table = 'giai_daus';

    protected $fillable = [
        'ten_giai_dau',
        'thong_tin_giai_dau',
        'so_doi',
        'so_tran',
        'so_bang_dau',
        'so_giai_thuong',
        'tinh_trang'
    ];
}
