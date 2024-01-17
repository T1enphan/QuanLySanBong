<?php

namespace App\Http\Requests\LoaiHangHoa;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLoaiHangRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id'                    =>  'required|exists:loai_hang_hoas,id',
            'ten_loai_hang'         =>  'required',
            'slug_loai_hang'        =>  'required|unique:loai_hang_hoas,slug_loai_hang,'. $this->id,
            'tinh_trang'            =>  'required',

        ];
    }

    public function messages()
    {
        return [
            'id.*'                      =>  'Loại hàng không tồn tại!',
            'ten_loai_hang.required'    =>  'Yêu cầu phải nhập loại hàng!',
            'slug_loai_hang.required'   =>  'Yêu cầu phải nhập slug loại hàng!',
            'slug_loai_hang.unique'     =>  'Loại hàng đã tồn tại!',
            'tinh_trang.required'       =>  'Yêu cầu phải nhập tình trạng!',
        ];
    }
}
