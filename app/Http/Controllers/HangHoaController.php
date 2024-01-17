<?php

namespace App\Http\Controllers;

use App\Http\Requests\HangHoa\CreateHangHoacRequest;
use App\Models\HangHoa;
use App\Models\LoaiHangHoa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HangHoaController extends Controller
{
    public function index()
    {
        return view('admin.page.hang_hoa.index');
    }

    public function store(CreateHangHoacRequest $request)
    {
        $data = $request->all();
        $hang_hoa = HangHoa::create($data);
        $admin = Auth::guard('admin')->user();
        $noi_dung = $admin->ho_va_ten . ' đã thêm mới hàng hóa có tên: ' . $hang_hoa->ten_hang;
        $this->createLog($admin->id, $noi_dung, \App\Models\Log::INSERT);
        return response()->json([
            'status'    => true,
            'message'   => 'Đã tạo mới thành công!',
        ]);
    }

    public function getData()
    {
        $data = HangHoa::join('loai_hang_hoas', 'hang_hoas.id_loai_hang', 'loai_hang_hoas.id')
                    ->select('hang_hoas.*','loai_hang_hoas.ten_loai_hang')
                    ->orderBy('loai_hang_hoas.id')
                    ->get();

        return response()->json([
            'data'  => $data
        ]);
    }

    public function changeStatus(Request $request)
    {
        $hangHoa = HangHoa::find($request->id);

        if($hangHoa) {
            $hangHoa->tinh_trang = !$hangHoa->tinh_trang;
            $hangHoa->save();
            $admin = Auth::guard('admin')->user();
            $trang_thai = $hangHoa->tinh_trang == 1 ? 'Còn Kinh Doanh' : 'Dừng Kinh Doanh';
            $noi_dung = $admin->ho_va_ten . ' đã cập nhật trạng thái thành '. $trang_thai .' khu vực có tên: ' . $hangHoa->ten_hang;
            $this->createLog($admin->id, $noi_dung, \App\Models\Log::UPDATE);
            return response()->json([
                'status'    => true,
                'message'   => 'Đã đổi trạng thái thành công!'
            ]);
        }
    }

    public function update(Request $request)
    {
        $hangHoa = HangHoa::where('id', $request->id)->first();

        $data = $request->all();

        $hangHoa->update($data);
        $admin = Auth::guard('admin')->user();
        $noi_dung = $admin->ho_va_ten . ' đã cập nhật hàng hóa có tên: ' . $hangHoa->ten_hang;
        $this->createLog($admin->id, $noi_dung, \App\Models\Log::UPDATE);
        return response()->json([
            'status'    => true,
            'message'   => 'Đã cập nhật được thông tin!',
        ]);
    }

    public function destroy(Request $request)
    {
        $hangHoa = HangHoa::where('id', $request->id)->first();
        $hangHoa->delete();
        $admin = Auth::guard('admin')->user();
        $noi_dung = $admin->ho_va_ten . ' đã xóa hàng hóa có tên: ' . $hangHoa->ten_hang;
        $this->createLog($admin->id, $noi_dung, \App\Models\Log::DELETE);
        return response()->json([
            'status'    => true,
            'message'   => 'Đã xóa thành công!',
        ]);
    }
    public function getDataLHH()
    {
        $data =  LoaiHangHoa::where('tinh_trang', 1)
                            ->select('loai_hang_hoas.*')
                            ->get();
        return response()->json([
            'data'  => $data
        ]);
    }
}
