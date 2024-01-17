<?php

namespace App\Http\Requests\LoaiHangHoa;

use Illuminate\Foundation\Http\FormRequest;

class DeleteLoaiHangRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'id'    => 'exists:loai_hang_hoas,id',
        ];
    }
    public function messages()
    {
        return [
            'id.*'   => 'Loại hàng hóa không tồn tại!',

        ];
    }
}
