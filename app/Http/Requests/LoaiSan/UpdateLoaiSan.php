<?php

namespace App\Http\Requests\LoaiSan;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLoaiSan extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id'                    =>  'required|exists:loai_sans,id',
            'loai_san'              =>  'required',
            'slug_loai_san'         =>  'required|unique:loai_sans,slug_loai_san,'. $this->id,
            'tinh_trang'            =>  'required',

        ];
    }

    public function messages()
    {
        return [
            'id.*'                    =>  'Loại sân không tồn tại!',
            'loai_san.required'       =>  'Yêu cầu phải nhập loại sân!',
            'slug_loai_san.required'  =>  'Yêu cầu phải nhập slug loại sân!',
            'slug_loai_san.unique'    =>  'Loại sân đã tồn tại!',
            'tinh_trang.required'     =>  'Yêu cầu phải nhập tình trạng!',
        ];
    }
}
