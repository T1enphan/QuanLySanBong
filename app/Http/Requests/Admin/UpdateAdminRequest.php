<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdminRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [

            'id'                =>  'required|exists:admins,id',
            'ho_va_ten'         =>  'required|min:5',
            'email'             =>  'required|email|unique:admins,email,'. $this->id,
            'so_dien_thoai'     =>  'required|digits:10',
            'ngay_sinh'         =>  'required|date',
            'dia_chi'           =>  'required',
        ];
    }

    public function messages()
    {
        return [
            'id.*'                =>  'Tài khoản không tồn tại!',
            'ho_va_ten.*'         =>  'Họ và tên không được để trống!',
            'email.required'      =>  'Email không được để trống!',
            'email.email'         =>  'Email không đúng định dạng!',
            'email.unique'        =>  'Email đã tồn tại trong hệ thống!',
            'so_dien_thoai.*'     =>  'Số điện thoại phải là 10 số!',
            'dia_chi.*'           =>  'Địa chỉ không được để trống!',
            'ngay_sinh.*'         =>  'Ngày sinh không được để trống!',
        ];
    }
}
