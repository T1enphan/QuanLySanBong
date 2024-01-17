<?php

namespace App\Http\Requests\LoaiHangHoa;

use Illuminate\Foundation\Http\FormRequest;

class CreateLoaiHangRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'ten_loai_hang'          =>  'required',
            'slug_loai_hang'         =>  'required|unique:loai_hang_hoas,slug_loai_hang',
            'tinh_trang'             =>  'required',

        ];
    }

    public function messages()
    {
        return [
            'ten_loai_hang.required'   =>  'Yêu cầu phải nhập loại hàng!',
            'slug_loai_hang.required'  =>  'Yêu cầu phải nhập slug loại hàng!',
            'slug_loai_hang.unique'    =>  'Loại hàng đã tồn tại!',
            'tinh_trang.required'      =>  'Yêu cầu phải nhập tình trạng!',
        ];
    }
}
