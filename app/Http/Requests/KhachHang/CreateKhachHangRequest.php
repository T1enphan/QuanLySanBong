<?php

namespace App\Http\Requests\KhachHang;

use Illuminate\Foundation\Http\FormRequest;

class CreateKhachHangRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'ho_lot'            => 'required',
            'ten'               => 'required',
            'email'             => 'required|email|unique:khach_hangs,email',
            'so_dien_thoai'     => 'required|digits:10',
            'dia_chi'           => 'required',
            'gioi_tinh'         => 'required',
            'id_loai_khach'     => 'required',
        ];
    }

    public function messages()
    {
        return [
            'ho_lot.*'                   => 'Yêu cầu phải nhập họ lót!',
            'ten.*'                      => 'Yêu cầu phải nhập tên!',
            'email.required'             => 'Yêu cầu phải nhập email!',
            'email.email'                => 'Email không đúng định dạng!',
            'email.unique'               => 'Email đã tồn tại!',
            'so_dien_thoai.required'     => 'Yêu cầu phải nhập số điện thoại!',
            'so_dien_thoai.digits'       => 'Số điện thoại phải là 10 ký tự!',
            'dia_chi.*'                  => 'Yêu cầu phải nhập địa chỉ!',
            'gioi_tinh.*'                => 'Yêu cầu phải nhập giới tính!',
            'id_loai_khach.*'            => 'Yêu cầu phải chọn loại khách hàng!',
        ];
    }
}
