<?php

namespace App\Http\Requests\LoaiKhachHang;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLoaiKhachHangRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id'                       =>  'required|exists:loai_khach_hangs,id',
            'ten_loai_khach'           =>  'required',
            'slug_loai_khach'          =>  'required|unique:loai_khach_hangs,slug_loai_khach,'. $this->id,
            'phan_tram_giam'           =>  'required',

        ];
    }

    public function messages()
    {
        return [
            'id.*'                      =>  'Loại khách hàng không tồn tại!',
            'ten_loai_khach.required'   =>  'Yêu cầu phải nhập loại khách!',
            'slug_loai_khach.required'  =>  'Yêu cầu phải nhập slug loại khách!',
            'slug_loai_khach.unique'    =>  'Loại khách hàng đã tồn tại!',
            'phan_tram_giam.required'   =>  'Yêu cầu phải nhập phần trăm giảm!',
        ];
    }
}
