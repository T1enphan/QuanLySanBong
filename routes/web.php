<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BaiVietController;
use App\Http\Controllers\ChiTietHoaDonDichVuController;
use App\Http\Controllers\ChiTietHoaDonNhapHangController;
use App\Http\Controllers\GiaiDauController;
use App\Http\Controllers\HangHoaController;
use App\Http\Controllers\HoaDonDichVuController;
use App\Http\Controllers\HoaDonNhapHangController;
use App\Http\Controllers\KhachHangController;
use App\Http\Controllers\KhuVucController;
use App\Http\Controllers\LoaiHangHoaController;
use App\Http\Controllers\LoaiKhachHangController;
use App\Http\Controllers\LoaiSanController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\NhaCungCapController;
use App\Http\Controllers\PhanQuyenController;
use App\Http\Controllers\SanController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\ThanhToanController;
use App\Http\Controllers\ThongKeController;
use App\Http\Controllers\User\AuthUserController;
use App\Http\Controllers\UserController;
use App\Models\ChiTietHoaDonNhapHang;
use App\Models\HoaDonDichVu;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('admin.share.master');
});
//test đặt sân
Route::get('/check-dat-san', [TestController::class, 'checkDatSan']);
Route::get('/transactions', [TestController::class, 'transaction']);

// Đặt sân
Route::post('/dat-san', [SanController::class, 'datSan']);
Route::post('/dat-san/hoan-thanh', [SanController::class, 'thanhToanTienCoc']);

// Route::get('/momo', [ThanhToanController::class, 'indexMomo']);
// Route::post('/momo', [ThanhToanController::class, 'actionMomo']);
// Route::get('/momo/ipn', [ThanhToanController::class, 'ipnMomo']);
// Route::get('/momo/notifi', [ThanhToanController::class, 'ipnMomo']);

Route::get('/testss', [TestController::class, 'testss']);
Route::get('/test1', [TestController::class, 'test1']);
Route::get('/schedule', [UserController::class, 'viewSchedule']);
Route::get('/pitch-data', [UserController::class, 'getPitchData']);
Route::get('/pitchs', [UserController::class, 'getPitchs']);
Route::get('/bai-viet', [UserController::class, 'baiViet']);
Route::get('/get-bai-viet', [UserController::class, 'getBaiViet']);
Route::get('/lien-he', [UserController::class, 'lienHe']);
Route::post('/send-lien-he', [UserController::class, 'SendlienHe']);
Route::get('/logout', [AuthUserController::class, 'logout']);
Route::get('/user/register', [AuthUserController::class, 'register']);
Route::post('/user/action-dang-ky', [AuthUserController::class, 'actionRegister']);
Route::post('/user/action-dang-nhap', [AuthUserController::class, 'actionLogin']);
Route::get('/kich-hoat-tai-khoan/{hash}', [AuthUserController::class, 'kichHoatTaiKhoan']);


Route::get('/profile-client', [UserController::class, 'viewProfileClient']);
Route::post('/update-profile-client', [UserController::class, 'updateProfileClient']);
Route::get('/danh-sach-san-dat', [UserController::class, 'viewDanhSachSanDat']);
Route::get('/data-danh-sach-san-dat', [UserController::class, 'dataDanhSachSanDat']);


//LoginAdmin
Route::get('/', [AdminController::class, 'viewLogin']);
Route::post('/admin/login', [AdminController::class, 'actionLogin']);

//Quên mật khẩu admin
Route::get('/quen-mat-khau' , [AdminController::class , 'viewQuenMatKhau']);
Route::post('/quen-mat-khau' , [AdminController::class , 'actioQuenMatKhau']);
Route::get('/reset-password/{hash}' , [AdminController::class , 'viewResetPassword']);
Route::post('/reset-password' , [AdminController::class , 'actioResetPassword']);

Route::group(['prefix' => '/admin' ,"middleware" => "checkLogin"], function() { //,"middleware" => "checkLogin"
    Route::get('/logout', [AdminController::class, 'actionLogout']);

    Route::group(['prefix' => '/log'], function() {
        Route::get('/', [LogController::class, 'index']);
        Route::get('/data', [LogController::class, 'data']);
    });

    Route::group(['prefix' => '/khu-vuc'], function() {
        Route::get('/', [KhuVucController::class, 'index']);
        Route::post('/create', [KhuVucController::class, 'store']);
        Route::get('/data', [KhuVucController::class, 'getData']);
        Route::post('/changestatus', [KhuVucController::class, 'changeStatus']);
        Route::post('/update', [KhuVucController::class, 'update']);
        Route::post('/delete', [KhuVucController::class, 'destroy']);
        Route::post('/check-slug', [KhuVucController::class, 'checkSlug']);
    });

    Route::group(['prefix' => '/loai-san'], function() {
        Route::get('/', [LoaiSanController::class, 'index']);
        Route::post('/create', [LoaiSanController::class, 'store']);
        Route::get('/data', [LoaiSanController::class, 'getData']);
        Route::post('/changestatus', [LoaiSanController::class, 'changeStatus']);
        Route::post('/update', [LoaiSanController::class, 'update']);
        Route::post('/delete', [LoaiSanController::class, 'destroy']);
    });

    Route::group(['prefix' => '/san'], function() {
        Route::get('/', [SanController::class, 'index']);
        Route::post('/create', [SanController::class, 'store']);
        Route::get('/data', [SanController::class, 'getData']);
        Route::get('/data-kv', [SanController::class, 'getDataKV']);
        Route::get('/data-ls', [SanController::class, 'getDataLS']);
        Route::get('/extra-fee', [SanController::class, 'getExtraFee'])->withoutMiddleware(['checkLogin']);

        Route::post('/changestatus', [SanController::class, 'changeStatus']);
        Route::post('/update', [SanController::class, 'update']);
        Route::post('/delete', [SanController::class, 'destroy']);
        //Mở Sân
        Route::get('/danh-sach-san', [SanController::class, 'indexDsSan']);
        Route::post('/get-danh-sach-san-hd', [SanController::class, 'getDanhSachSanHD']);
        Route::post('/get-danh-sach-san', [SanController::class, 'getDanhSachSan']);
        Route::get('/data-hang-hoa', [SanController::class, 'getDataHangHoa']);
        Route::post('/mo-san', [SanController::class, 'moSan']);
        //check giờ sân đá
        Route::get('/check-gio-san-da', [SanController::class, 'checkGioSanDa']);
        // Route::post('/huy-mo-san', [SanController::class, 'huyMoSan']);
        Route::post('/update-mo-san', [SanController::class, 'updateMoSan']);
        Route::post('/mo-san-real', [SanController::class, 'moSanReal']);
        Route::post('/thanh-toan-san', [SanController::class, 'thanhToanSan']);
        Route::get('/data-khach-hang', [SanController::class, 'dataKhachHang']);
        Route::post('/add-hang', [SanController::class, 'addHang']);
        Route::post('/update-hang', [SanController::class, 'updateHang']);
        Route::post('/delete-hang', [SanController::class, 'deleteHang']);
        Route::get('/get-add-hang/{id_thue_san}', [SanController::class, 'getAddHang']);
        Route::get('/bill-thue-san/{id_thue_san}', [SanController::class, 'billThueSan']);
        Route::get('/bill-thanh-toan/{id_thue_san}', [SanController::class, 'billThanhToan']);
        Route::get('/hoa-don-thue-san', [SanController::class, 'hoaDonThueSan']);
        Route::get('/data-hoa-don-thue-san', [SanController::class, 'dataHoaDonThueSan']);
        Route::get('/hoa-don-thue-san/chi-tiet/{id}', [SanController::class, 'chiTietHoaDonThueSan']);

    });

    Route::group(['prefix' => '/loai-khach-hang'], function() {
        Route::get('/', [LoaiKhachHangController::class, 'index']);
        Route::post('/create', [LoaiKhachHangController::class, 'store']);
        Route::get('/data', [LoaiKhachHangController::class, 'getData']);
        Route::post('/update', [LoaiKhachHangController::class, 'update']);
        Route::post('/delete', [LoaiKhachHangController::class, 'destroy']);
        Route::post('/changestatus', [LoaiKhachHangController::class, 'changeStatus']);

    });

    Route::group(['prefix' => '/khach-hang'], function() {
        Route::get('/', [KhachHangController::class, 'index']);
        Route::post('/create', [KhachHangController::class, 'store']);
        Route::get('/data', [KhachHangController::class, 'getData']);
        Route::get('/data-lkh', [KhachHangController::class, 'getDataLKH']);
        Route::post('/update', [KhachHangController::class, 'update']);
        Route::post('/delete', [KhachHangController::class, 'destroy']);
        Route::post('/doi-trang-thai', [KhachHangController::class, 'doiTrangThai']);
        Route::post('/search', [KhachHangController::class, 'search']);
    });

    Route::group(['prefix' => '/tai-khoan'], function() {
        Route::get('/',[AdminController::class,'index']);
        Route::post('/create',[AdminController::class,'store']);
        Route::get('/data', [AdminController::class, 'getData']);
        Route::get('/data-quyen', [AdminController::class, 'getDataQuyen']);
        Route::post('/delete', [AdminController::class, 'destroy']);
        Route::post('/update', [AdminController::class, 'update']);
        Route::post('/change-password', [AdminController::class, 'changePassword']);


        Route::get('/thong-tin-ca-nhan', [AdminController::class, 'viewThongTinCaNhan']);
        Route::post('/update-thong-tin-ca-nhan', [AdminController::class, 'updateThongTinCaNhan']);
        Route::post('/change-password-profile', [AdminController::class, 'changePasswordProfile']);
    });

    Route::group(['prefix' => '/nha-cung-cap'], function() {
        Route::get('/', [NhaCungCapController::class, 'index']);
        Route::post('/create', [NhaCungCapController::class, 'store']);
        Route::get('/data', [NhaCungCapController::class, 'data']);
        Route::post('/delete', [NhaCungCapController::class, 'destroy']);
        Route::post('/update', [NhaCungCapController::class, 'update']);
        Route::post('/doi-trang-thai', [NhaCungCapController::class, 'doiTrangThai']);
        Route::post('/search', [NhaCungCapController::class, 'search']);
    });

    Route::group(['prefix' => '/loai-hang-hoa'], function() {
        Route::get('/', [LoaiHangHoaController::class, 'index']);
        Route::post('/create', [LoaiHangHoaController::class, 'store']);
        Route::get('/data', [LoaiHangHoaController::class, 'getData']);
        Route::post('/changestatus', [LoaiHangHoaController::class, 'changeStatus']);
        Route::post('/update', [LoaiHangHoaController::class, 'update']);
        Route::post('/delete', [LoaiHangHoaController::class, 'destroy']);
    });

    Route::group(['prefix' => '/hang-hoa'], function() {
        Route::get('/', [HangHoaController::class, 'index']);
        Route::post('/create', [HangHoaController::class, 'store']);
        Route::get('/data', [HangHoaController::class, 'getData']);
        Route::get('/data-lhh', [HangHoaController::class, 'getDataLHH']);

        Route::post('/changestatus', [HangHoaController::class, 'changeStatus']);
        Route::post('/update', [HangHoaController::class, 'update']);
        Route::post('/delete', [HangHoaController::class, 'destroy']);

    });

    Route::group(['prefix' => '/giai-dau'], function() {
        Route::get('/', [GiaiDauController::class, 'index']);
        Route::post('/create', [GiaiDauController::class, 'create']);
        Route::get('/data', [GiaiDauController::class, 'getData']);
        Route::post('/get-doi-bong-cua-giai', [GiaiDauController::class, 'getDoiBongCuaGiai']);
        Route::post('/update-doi-bong-cua-giai', [GiaiDauController::class, 'updateDoiBongCuaGiai']);
        Route::post('/delete-doi-bong-cua-giai', [GiaiDauController::class, 'deleteDoiBongCuaGiai']);
        Route::post('/update', [GiaiDauController::class, 'update']);
        Route::post('/delete', [GiaiDauController::class, 'delete']);
        Route::post('/trang-thai', [GiaiDauController::class, 'statusGiaiDau']);
        Route::get('/chi-tiet-giai/{id_giai_dau}', [GiaiDauController::class, 'chiTietGiai']);
        Route::post('/chon-doi-tran-dau-giai', [GiaiDauController::class, 'chonDoiTranDauGiai']);

    });

    Route::group(['prefix' => '/nhap-hang'],function(){
        Route::get('/',[HoaDonNhapHangController::class,'index']);
        Route::get('/data-hang-hoa',[HoaDonNhapHangController::class,'dataHangHoa']);
        Route::get('/data',[HoaDonNhapHangController::class,'getData']);
        Route::post('/add-san-pham-nhap-hang', [HoaDonNhapHangController::class, 'addSanPhamNhapHang']);
        Route::post('/delete-hang-hoa', [HoaDonNhapHangController::class, 'deleteHangHoaNhapHang']);
        Route::post('/update-chi-tiet-hoa-don-nhap', [HoaDonNhapHangController::class, 'updateChiTietHoaDonNhap']);
        Route::post('/nhap-hang-real', [HoaDonNhapHangController::class, 'nhapHang']);
        Route::post('/search', [HoaDonNhapHangController::class, 'search']);
    });

    Route::group(['prefix' => '/hoa-don-nhap-hang'],function(){
        Route::get('/',[HoaDonNhapHangController::class,'viewHD']);
        Route::get('/data-HD',[HoaDonNhapHangController::class,'getDataDH']);
        Route::get('/chi-tiet/{id}', [ChiTietHoaDonNhapHangController::class, 'chiTietHoaDon']);

    });

    Route::group(['prefix' => '/dich-vu'],function(){
        Route::get('/',[HoaDonDichVuController::class,'index']);
        Route::get('/data-hang-hoa',[HoaDonDichVuController::class,'dataHangHoa']);
        Route::post('/search', [HoaDonNhapHangController::class, 'search']);
        Route::post('/them-san-pham-ban', [HoaDonDichVuController::class, 'themSanPhamBan']);
        Route::get('/data',[HoaDonDichVuController::class,'getData']);
        Route::post('/get-hang-hoa', [HoaDonDichVuController::class, 'getHangHoa']);
        Route::post('/delete-hang-hoa', [HoaDonDichVuController::class, 'deleteHangHoaNhapHang']);
        Route::post('/update-chi-tiet-hoa-don-nhap', [HoaDonDichVuController::class, 'updateChiTietHoaDonBan']);
        Route::get('/bill/{id}', [HoaDonDichVuController::class, 'inBill']);
        Route::post('/thanh-toan', [HoaDonDichVuController::class, 'ThanhToan']);
        Route::get('/bill-thanh-toan/{id}', [HoaDonDichVuController::class, 'inBillThanhToan']);
        Route::post('/thong-ke', [ThongKeController::class, 'actionThongKeBanHang']);
    });
    Route::group(['prefix' => '/thong-ke'],function(){

        Route::post('/thong-ke-dich-vu', [ThongKeController::class, 'actionThongKeBanHang']);
        Route::get('/', [ThongKeController::class, 'index']);
        Route::post('/', [ThongKeController::class, 'search']);

        Route::get('/data-HD',[ThongKeController::class,'getDataDH']);
        Route::get('/san-duoc-su-dung-nhieu', [ThongKeController::class, 'indexThongKeSanSuDungNhieu']);
        Route::post('/san-duoc-su-dung-nhieu', [ThongKeController::class, 'searchDataThongKeSanSuDungNhieu']);
        Route::post('/chi-tiet-san-su-dung-nhieu', [ThongKeController::class, 'dataChiTietSanSuDungNhieu']);
    });

    Route::group(['prefix' => '/hoa-don-ban'],function(){
        Route::get('/',[HoaDonDichVuController::class,'viewHD']);
        Route::get('/data-HD',[HoaDonDichVuController::class,'getDataDH']);
        Route::get('/chi-tiet/{id}', [ChiTietHoaDonDichVuController::class, 'chiTietHoaDon']);

    });
    Route::group(['prefix'=>'/bai-viet'],function(){
        Route::get('/',[BaiVietController::class,'index']);
        Route::post('/create',[BaiVietController::class,'store']);
        Route::get('/data',[BaiVietController::class,'getData']);
        Route::post('/changestatus',[BaiVietController::class,'changestatus']);
        Route::post('/update',[BaiVietController::class,'update']);
        Route::post('delete',[BaiVietController::class,'destroy']);
        Route::post('search',[BaiVietController::class,'search']);
    });

    Route::group(['prefix' => '/quyen'], function() {
        Route::get('/', [PhanQuyenController::class, 'index']);
        Route::get('/data', [PhanQuyenController::class, 'Data']);
        Route::get('/data-action', [PhanQuyenController::class, 'DataAction']);
        Route::post('/create', [PhanQuyenController::class, 'create']);
        Route::post('/delete', [PhanQuyenController::class, 'delete']);
        Route::post('/update', [PhanQuyenController::class, 'update']);
        Route::post('/update-action', [PhanQuyenController::class, 'updateAction']);
        Route::get('/update-status/{id}', [PhanQuyenController::class, 'updateStatus']);

    });



});
