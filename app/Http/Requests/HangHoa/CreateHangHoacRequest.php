<?php

namespace App\Http\Requests\HangHoa;

use Illuminate\Foundation\Http\FormRequest;

class CreateHangHoacRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'ten_hang'          => 'required',
            'gia_hang'          => 'required',
            'tinh_trang'        => 'required',
        ];
    }

    public function messages()
    {
        return [
            'ten_hang.*'        => 'Yêu cầu phải nhập tên hàng!',
            'gia_hang.*'        => 'Yêu cầu phải nhập giá hàng !',
            'tinh_trang.*'      => 'Yêu cầu phải nhập tình trạng!',
        ];
    }
}
