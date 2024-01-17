<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\RegisterRequest;
use App\Jobs\RegisterClientJob;
use App\Mail\KichHoatTaiKhoanMail;
use App\Models\KhachHang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthUserController extends Controller
{
    public function register()
    {
        return view('user.page.dangky');
    }

    public function actionRegister(RegisterRequest $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        $data['ho_va_ten'] = $data['ho_lot'] . " " . $data['ten'];
        $data['hash'] = Str::uuid();
        $data['id_loai_khach'] = 3;
        $data['is_active'] = 0;
        KhachHang::create($data);
        RegisterClientJob::dispatch($data, $data['email']);

        return response()->json([
            'status'    => 1,
            'message'   => 'Đăng Ký Thành Công Check Mail Để Kích Hoạt Tài Khoản!',
        ]);
    }

    public function actionLogin(Request $request)
    {
        $data = $request->all();
        $check = Auth::guard('user')->attempt($data);
        if($check) {
            $user = Auth::guard('user')->user();
            if($user->is_active == 0){
                Auth::guard('user')->logout();
                return response()->json([
                    'status'    => 2,
                    'message'   => 'Tài khoản chưa được kích hoạt!',
                ]);
            }

            return response()->json([
                'status'    => 1,
                'message'   => 'Đã đăng nhập thành công!',
            ]);
        } else {
            // toastr()->error("Tài khoản hoặc mật khẩu không đúng!");
            return response()->json([
                'status'    => 0,
                'message'   => 'Tài khoản hoặc mật khẩu không đúng!',
            ], 400);
        }
    }

    public function logout()
    {
        Auth::guard('user')->logout();

        toastr()->success('Đăng Xuất Thành Công!');

        return redirect('/schedule');
    }

    public function kichHoatTaiKhoan($hash)
    {
        $user =  KhachHang::where('hash', $hash)->first();

        if($user){
            $user->is_active = 1;
            $user->save();
            toastr()->success('Kích hoạt tài khoản thành công!');
            return redirect('/user/register');
        }
    }
}
