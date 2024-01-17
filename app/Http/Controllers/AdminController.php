<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\CreateAdminRequest;
use App\Http\Requests\Admin\DeleteAdminRequest as AdminDeleteAdminRequest;
use App\Http\Requests\Admin\UpdateAdminRequest as AdminUpdateAdminRequest;
use App\Http\Requests\KhuVuc\DeleteAdminRequest;
use App\Http\Requests\KhuVuc\UpdateAdminRequest;
use App\Jobs\QuenMatKhauJob;
use App\Models\Admin;
use App\Models\PhanQuyen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yoeunes\Toastr\Facades\Toastr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.page.tai_khoan.index');
    }
    public function store(CreateAdminRequest $request)
    {
        $data = $request->all();
        $data['password'] =  bcrypt($request->password);
        $data['hash'] = Str::uuid();
        if($data['id_quyen'] == 0){
            $data['anh_dai_dien'] = '/assets_admin/images/avatars/admin.jpg';
        }else{
            $data['anh_dai_dien'] = '/assets_admin/images/avatars/nhanvien.png';
        }
        $ADMIN = Admin::create($data);
        $admin = Auth::guard('admin')->user();
        $noi_dung = $admin->ho_va_ten . ' đã thêm mới quản trị viên có tên: ' . $ADMIN->ho_va_ten;
        $this->createLog($admin->id, $noi_dung, \App\Models\Log::INSERT);
        return response()->json([
            'status'    => true,
            'message'   => 'Đã tạo tài khoản thành công!'
        ]);
    }

    public function getData()
    {
        $list = Admin::join('phan_quyens', 'phan_quyens.id', 'admins.id_quyen')
                        ->select('admins.*', 'phan_quyens.ten_quyen')
                        ->get();
        return response()->json([
            'list'  => $list
        ]);
    }
    public function destroy(AdminDeleteAdminRequest $request)
    {
        $ADMIN = Admin::where('id', $request->id)->first();
        $ADMIN->delete();
        $admin = Auth::guard('admin')->user();
        $noi_dung = $admin->ho_va_ten . ' đã xóa quản trị viên có tên: ' . $ADMIN->ho_va_ten;
        $this->createLog($admin->id, $noi_dung, \App\Models\Log::DELETE);
        return response()->json([
            'status'    => true,
            'message'   => 'Đã xóa thành công!',
        ]);
    }

    public function update(AdminUpdateAdminRequest $request)
    {
        $data    = $request->all();
        $ADMIN = Admin::find($request->id);
        $ADMIN->update($data);
        $admin = Auth::guard('admin')->user();
        $noi_dung = $admin->ho_va_ten . ' đã cập nhật quản trị viên có tên: ' . $ADMIN->ho_va_ten;
        $this->createLog($admin->id, $noi_dung, \App\Models\Log::UPDATE);
        return response()->json([
            'status'    => true,
            'message'   => 'Đã cập nhật thành công!',
        ]);
    }

    public function changePassword(Request $request)
    {
        $data = $request->all();
        if(isset($request->password)){
            $ADMIN = Admin::find($request->id);
            $data['password'] = bcrypt($data['password_new']);
            $ADMIN->password  = $data['password'];
            $ADMIN->save();

            $admin = Auth::guard('admin')->user();
            $noi_dung = $admin->ho_va_ten . ' đã cập nhật mật khẩu cho quản trị viên có tên: ' . $ADMIN->ho_va_ten;
            $this->createLog($admin->id, $noi_dung, \App\Models\Log::UPDATE);
        }
        return response()->json([
            'status'    => 1,
            'message'   => 'Đã cập nhật mật khẩu thành công!',
        ]);
    }
    public function viewLogin()
    {

        $check = Auth::guard('admin')->check();
        if($check) {
            return redirect('/admin/thong-ke');
        } else {
            return view('admin.page.login.login');
        }
    }
    public function actionLogin(Request $request)
    {
        $check =  Auth::guard('admin')->attempt([
                                        'email'     => $request->email,
                                        'password'  => $request->password
                                    ]);
        if($check) {
            toastr()->success("Đã đăng nhập thành công!");
            return redirect('/admin/thong-ke');
        } else {
            toastr()->error("Tài khoản hoặc mật khẩu không đúng!");
            return redirect('/');
        }
    }
    public function actionLogout()
    {
        Auth::guard('admin')->logout();
        toastr()->error("Tài khoản đã đăng xuất!");
        return redirect('/');
    }

    public function viewThongTinCaNhan()
    {
        return view('admin.page.tai_khoan.profile');
    }

    public function updateThongTinCaNhan(Request $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        Admin::find($data['id'])->update($data);


        return response()->json([
            'status'    => 1,
            'message'   => 'Đã cập nhật Profile thành công!',
        ]);
    }
    public function changePasswordProfile(Request $request)
    {
        $data = $request->all();
        $ADMIN = Admin::find($data['id']);
        $ADMIN->password = bcrypt($data['password']);
        $ADMIN->save();

        $admin = Auth::guard('admin')->user();
        $noi_dung = $admin->ho_va_ten . ' đã cập nhật mật khẩu!';
        $this->createLog($admin->id, $noi_dung, \App\Models\Log::UPDATE);
        return response()->json([
            'status'    => 1,
            'message'   => 'Đã cập nhật mật khẩu thành công!',
        ]);
    }

    public function viewQuenMatKhau()
    {
        return view('admin.page.login.enterEmail');
    }

    public function actioQuenMatKhau(Request $request)
    {
        $data = $request->all();
        $admin =  Admin::where('email', $data['email'])->first();
        $data['full_name']= $admin->ho_va_ten;
        $data['hash']= $admin->hash;

        QuenMatKhauJob::dispatch($data, $data['email']);

        Toastr::success("Đã gửi mail thành công!");

        return redirect('/');
    }

    public function viewResetPassword($hash)
    {
        return view('admin.page.login.ForgotPassword', compact('hash'));

    }

    public function actioResetPassword(Request $request)
    {
        $admin = Admin::where('hash', $request->hash)->first();
        if($admin){
            $admin->password = bcrypt($request->password);
            $admin->save();
            Toastr::success('Đã thay đổi mật khẩu thành công!');
            return redirect('/');

        }else{
            Toastr::error('Đã có lỗi hệ thống!');
            return redirect('/');
        }
    }

    public function getDataQuyen()
    {
        $data = PhanQuyen::where('tinh_trang', 1)->get();

        return response()->json([
            'data'    => $data,
        ]);
    }

}
