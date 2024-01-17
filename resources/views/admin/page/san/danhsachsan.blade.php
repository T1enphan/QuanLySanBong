@extends('admin.share.master')
@section('noi_dung')
    <div class="row" id="app">
        <div class="col">
            <div class="text-end">
                <button class="btn btn-primary btn-sm radius-30 px-4 mb-2" v-on:click="add = {}" data-bs-toggle="modal"
                    data-bs-target="#mosanModal1">Mở Sân</button>
            </div>
            <div class="card border-bottom border-3 border-0">
                <div class="card-header d-flex justify-content-between">
                    <h5>Tình Trạng Danh Sách Sân Bóng</h5>

                    <ul class="nav nav-pills mb-3" role="tablist">
                        <li v-on:click="checkSanToiGioDa()" class="nav-item" style="margin-right: 10px" role="presentation">
                            <a class="btn btn-outline-success active" data-bs-toggle="pill" href="#primary-pills-home" role="tab"
                                aria-selected="false" tabindex="-1">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class="fa-solid fa-chart-line"></i>
                                    </div>
                                    <div class="tab-title">Đang Hoạt Động</div>
                                </div>
                            </a>
                        </li>
                        <li v-on:click="checkSanToiGioDa()" class="nav-item" style="margin-right: 10px" role="presentation">
                            <a class="btn btn-outline-warning" data-bs-toggle="pill" href="#primary-pills-profile" role="tab"
                                aria-selected="true">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class="fa-regular fa-calendar-days"></i>
                                    </div>
                                    <div class="tab-title">Sân Đặt Trước</div>
                                </div>
                            </a>
                        </li>
                        <li v-on:click="checkSanToiGioDa()" class="nav-item" role="presentation">
                            <a class="btn btn-outline-danger" data-bs-toggle="pill" href="#primary-pills-contact" role="tab"
                                aria-selected="false" tabindex="-1">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class="fa-solid fa-calendar-xmark"></i>
                                    </div>
                                    <div class="tab-title">Đã Kết Thúc</div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    {{-- <div class="row mb-3">
                    <div class="col-md-3">
                        <label>Chọn Loại Sân</label>
                        <select class="form-control mt-1" v-model="id_loai_san" v-on:change="getDanhSachSanHD(id_loai_san)">
                            <option value="0">Chọn Loại Sân</option>
                            <template v-for="(value, key) in listLoaiSan">
                                <option v-bind:value="value.id">@{{ value.loai_san }}</option>
                            </template>
                        </select>
                    </div>
                </div> --}}
                    <div class="row mb-3">
                        <ul class="nav nav-pills nav-pills-primary mb-3" role="tablist">
                            <li class="nav-item" role="presentation" v-on:click="getDanhSachSanHD(0)">
                                <a class="nav-link active" data-bs-toggle="pill" href="#loai0" role="tab"
                                    aria-selected="true">
                                    <div class="d-flex align-items-center text-dark">
                                        <div class="tab-icon"><i class="fa-solid fa-futbol me-1"></i>
                                        </div>
                                        <div class="tab-title"><b>Tất Cả</b></div>
                                    </div>
                                </a>
                            </li>
                            <template v-for="(value, key) in listLoaiSan">
                                <li class="nav-item" role="presentation" v-on:click="getDanhSachSanHD(value.id)">
                                    <a class="nav-link" data-bs-toggle="pill" v-bind:href="'#loai' + key + 1" role="tab"
                                        aria-selected="false" tabindex="-1">
                                        <div class="d-flex align-items-center text-dark">
                                            <div class="tab-icon"><i class="fa-solid fa-futbol me-1"></i>
                                            </div>
                                            <div class="tab-title"><b>@{{ value.loai_san }}</b></div>
                                        </div>
                                    </a>
                                </li>
                            </template>
                        </ul>
                        {{-- <div class="tab-content" id="danger-pills-tabContent">
                        <template v-for="(value, key) in listLoaiSan">
                            <div class="tab-pane fade" v-bind:id="'loai' + key" role="tabpanel">
                            @{{ value.loai_san }}
                            </div>
                        </template>
                    </div> --}}
                    </div>
                    <div class="row">
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade active show" id="primary-pills-home" role="tabpanel">
                                <div class="row">
                                    <template v-for="(value, key) in listSanHD">
                                        <template v-if="value.tinh_trang_thue == 1 && kiemtraketthuc(value.gio_ket_thuc, value.ngay_thue_san) == false">
                                            <div class="col-3" style="cursor: pointer;">
                                                <div class="card radius-10">
                                                    <div class="card-body" data-bs-toggle="modal"
                                                        data-bs-target="#mosanModal"
                                                        v-on:click="ten_san = value.ten_san, id_san = value.id, moSan(value.id, value.hoa_don_id)">
                                                        <div class="text-center">
                                                            <div
                                                                class="widgets-icons rounded-circle mx-auto bg-light-primary text-primary mb-3">
                                                                <i class="fa-solid fa-futbol"></i>
                                                            </div>
                                                            <h4 class="my-1">@{{ value.ten_san }}</h4>
                                                            <p v-if="kiemtraketthuc(value.gio_ket_thuc, value.ngay_thue_san) == false"
                                                                class="mb-0 text-success">Đang Hoạt Động</p>
                                                                <p v-if="value.id_khach_hang == null">Admin</p>
                                                                <p v-else>@{{ value.ten_khach_hang }} - @{{ value.so_dien_thoai }}</p>
                                                            <p v-else-if="kiemtraketthuc(value.gio_ket_thuc, value.ngay_thue_san) && value.tinh_trang_thue == 1"
                                                                class="mb-0 text-danger">Đã kết thúc</p>
                                                            <p v-else-if=" value.tinh_trang_thue == 3"
                                                                class="mb-0 text-warning">Đặt trước</p>
                                                            <p v-else class="mb-0 text-secondary">Đang Trống</p>
                                                            <p v-if="value.tinh_trang_thue == 1">Thời gian kết thúc:
                                                                @{{ value.gio_ket_thuc }} - @{{ value.ngay_thue_san }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </template>
                                    </template>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="primary-pills-profile" role="tabpanel">
                                <div class="row">
                                    <template v-for="(value, key) in listSanHD">
                                        <template v-if="value.tinh_trang_thue == 3">
                                            <div class="col-3" style="cursor: pointer;">
                                                <div class="card radius-10">
                                                    <div class="card-body" data-bs-toggle="modal"
                                                        data-bs-target="#mosanModal"
                                                        v-on:click="ten_san = value.ten_san, id_san = value.id, moSan(value.id, value.hoa_don_id)">
                                                        <div class="text-center">
                                                            <div
                                                                class="widgets-icons rounded-circle mx-auto bg-light-primary text-primary mb-3">
                                                                <i class="fa-solid fa-futbol"></i>
                                                            </div>
                                                            <h4 class="my-1">@{{ value.ten_san }}</h4>
                                                            <p v-if="value.tinh_trang_thue == 1 && kiemtraketthuc(value.gio_ket_thuc, value.ngay_thue_san) == false"
                                                                class="mb-0 text-success">Đang Hoạt Động</p>
                                                            <p v-else-if="kiemtraketthuc(value.gio_ket_thuc, value.ngay_thue_san) && value.tinh_trang_thue == 1"
                                                                class="mb-0 text-danger">Đã kết thúc</p>
                                                            <p v-else-if="value.tinh_trang_thue == 3"
                                                                class="mb-0 text-warning">Đặt trước</p>
                                                                <p v-if="value.id_khach_hang == null">Admin</p>
                                                                <p v-else>@{{ value.ten_khach_hang }} - @{{ value.so_dien_thoai }}</p>
                                                            <p v-else class="mb-0 text-secondary">Đang Trống</p>
                                                            <p v-if="value.tinh_trang_thue == 3">@{{ value.gio_bat_dau }} -
                                                                @{{ value.gio_ket_thuc }} - @{{ value.ngay_thue_san }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </template>
                                    </template>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="primary-pills-contact" role="tabpanel">
                                <div class="row">
                                    <template v-for="(value, key) in listSanHD">
                                        <template v-if="kiemtraketthuc(value.gio_ket_thuc, value.ngay_thue_san) && value.tinh_trang_thue == 1">
                                            <div class="col-3" style="cursor: pointer;">
                                                <div class="card radius-10">
                                                    <div class="card-body" data-bs-toggle="modal"
                                                        data-bs-target="#mosanModal"
                                                        v-on:click="ten_san = value.ten_san, id_san = value.id, moSan(value.id, value.hoa_don_id)">
                                                        <div class="text-center">
                                                            <div
                                                                class="widgets-icons rounded-circle mx-auto bg-light-primary text-primary mb-3">
                                                                <i class="fa-solid fa-futbol"></i>
                                                            </div>
                                                            <h4 class="my-1">@{{ value.ten_san }}</h4>
                                                            <p v-if="value.tinh_trang_thue == 1 && kiemtraketthuc(value.gio_ket_thuc, value.ngay_thue_san) == false"
                                                                class="mb-0 text-success">Đang Hoạt Động</p>
                                                            <p v-else-if="kiemtraketthuc(value.gio_ket_thuc, value.ngay_thue_san) && value.tinh_trang_thue == 1"
                                                                class="mb-0 text-danger">Đã kết thúc</p>
                                                                <p v-if="value.id_khach_hang == null">Admin</p>
                                                                <p v-else>@{{ value.ten_khach_hang }} - @{{ value.so_dien_thoai }}</p>
                                                            <p v-else-if=" value.tinh_trang_thue == 3"
                                                                class="mb-0 text-warning">Đặt trước</p>
                                                            <p v-else class="mb-0 text-secondary">Đang Trống</p>
                                                            <p v-if="value.tinh_trang_thue == 1">Thời gian kết thúc:
                                                                @{{ value.gio_ket_thuc }} - @{{ value.ngay_thue_san }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </template>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="modal fade" id="mosanModal1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header ">
                        <h5 class="modal-title " id="exampleModalLabel">Mở Sân</h5>
                        <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"></button>
                        {{-- <button type="button" class="btn-close bg-white" data-bs-dismiss="modal"
                    aria-label="Close" v-else v-on:click="huyMoSan()"></button> --}}
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <label>Chọn Loại Sân</label>
                                <select class="form-control mt-1" v-model="id_loai_san"
                                    v-on:change="getDanhSachSan(id_loai_san)">
                                    <option value="0">Chọn Loại Sân</option>
                                    <template v-for="(value, key) in listLoaiSan">
                                        <option v-bind:value="value.id">@{{ value.loai_san }}</option>
                                    </template>
                                </select>
                            </div>
                            <div class="col-6">
                                <label>Chọn Sân</label>
                                <select class="form-control mt-1" v-model="add.id_san" v-on:change="getTien(add.id_san)">
                                    <template v-for="(value, key) in listSan">
                                        <option v-bind:value="value.id">@{{ value.ten_san }}</option>
                                    </template>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label>Chọn ngày</label>
                                <input type="date" v-model="add.ngay_thue_san" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label>Chọn giờ bắt đầu</label>
                                <input type="time" v-model="add.gio_bat_dau" class="form-control"
                                    v-on:change="pickTime(add.gio_bat_dau, 'start')">
                            </div>
                            <div class="col-md-6">
                                <label>Chọn giờ kết thúc</label>
                                <input type="time" v-model="add.gio_ket_thuc" class="form-control"
                                    v-on:change="pickTime(add.gio_ket_thuc, 'end')">
                            </div>
                            <div class="col-md-6 mt-2">
                                <label>Số tiền</label>
                                <input type="number" disabled class="form-control" id="display_tien">
                            </div>
                            {{-- <div class="col-md-6 mt-2">
                                <label>Khách Hàng</label>
                                <select class="form-control" v-model="add.id_khach_hang">
                                    <template v-for="(value, key) in listKhachHang">
                                        <option v-bind:value="value.id">@{{ value.ho_va_ten }} - @{{ value.email }}
                                        </option>
                                    </template>
                                </select>

                            </div> --}}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm radius-30 px-4"
                            data-bs-dismiss="modal">Đóng</button>
                        <button type="button" class="btn btn-primary btn-sm radius-30 px-4"
                            v-on:click="createMoSan()">Xác nhận</button>
                        {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button> --}}
                        {{-- <button type="button" class="btn btn-secondary" v-else data-bs-dismiss="modal" v-on:click="huyMoSan()">Hủy mở sân</button> --}}
                        {{-- <button type="button" class="btn btn-dark" v-on:click="createMoSan()">Xác Nhận</button> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="mosanModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" style="max-width: 100%;">
                <div class="modal-content">
                    <div class="modal-header ">
                        <h5 class="modal-title " id="exampleModalLabel">Mở Sân - @{{ ten_san }}</h5>
                        <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"></button>
                        {{-- <button type="button" class="btn-close bg-white" data-bs-dismiss="modal"
                    aria-label="Close" v-else v-on:click="huyMoSan()"></button> --}}
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h6>Danh sách hàng hóa</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <div class="table-responsive" style="max-height: 450px">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr class="table-secondary">
                                                            <th class="align-middle text-center">#</th>
                                                            <th class="align-middle text-center">Tên Hàng</th>
                                                            <th class="align-middle text-center">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <template v-for="(value, key) in listHangHoa">
                                                            <tr>
                                                                <th class="text-center align-middle">
                                                                    @{{ key + 1 }}</th>
                                                                <td class="align-middle">@{{ value.ten_hang }}</td>
                                                                <td class="text-center">
                                                                    <button v-if="value.so_luong <= 0" disabled
                                                                        type="button"
                                                                        class="btn btn-secondary btn-sm radius-30 px-4">Hết
                                                                        Hàng</button>
                                                                    <button v-else
                                                                        class="btn btn-primary btn-sm radius-30 px-4"
                                                                        v-on:click="addHang(value)">Thêm</button>
                                                                </td>
                                                            </tr>
                                                        </template>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            {{-- <div class="col-md-4">
                                            <label>Chọn ngày</label>
                                            <input type="date" v-model="add.ngay_thue_san" class="form-control">
                                        </div> --}}
                                            <div class="col-md-6">
                                                <label>Chọn ngày</label>
                                                <input type="date" v-on:change="updateMoSan()"
                                                    v-model="add.ngay_thue_san" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label>Chọn giờ bắt đầu</label>
                                                <input type="time" v-on:change="pickTime(add.gio_bat_dau, 'start'), updateMoSan()"
                                                    v-model="add.gio_bat_dau" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label>Chọn giờ kết thúc</label>
                                                <input type="time" v-on:change="pickTime(add.gio_ket_thuc, 'end'), updateMoSan()"
                                                    v-model="add.gio_ket_thuc" class="form-control">
                                            </div>
                                            <div class="col-md-6 mt-2">
                                                <label>Số tiền</label>
                                                <input type="number" v-model="add.so_tien" class="form-control">
                                            </div>
                                            {{-- <div class="col-md-6 mt-2">
                                                <label>Khách Hàng</label>
                                                <select class="form-control" v-on:change="updateMoSan()"
                                                    v-model="add.id_khach_hang">
                                                    <option value="-1">Không</option>
                                                    <template v-for="(value, key) in listKhachHang">
                                                        <option v-bind:value="value.id">@{{ value.ho_va_ten }} - @{{ value.email }}</option>
                                                    </template>
                                                </select>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="card">
                                        <div class="card-header">
                                            Hàng hóa sử dụng
                                        </div>
                                        <div class="card-body">
                                            <table class="table mb-0">
                                                <thead>
                                                    <tr class="table-light">
                                                        <th>#</th>
                                                        <th>Tên hàng hóa</th>
                                                        <th>Số lượng</th>
                                                        <th>Đơn giá</th>
                                                        <th>Thành tiền</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <template v-for="(value, key) in listAddHang">
                                                        <tr>
                                                            <th>@{{ key + 1 }}</th>
                                                            <td>@{{ value.ten_hang }}</td>
                                                            <td>
                                                                <input type="number" class="form-control"
                                                                    v-model="value.so_luong_ban"
                                                                    v-on:change="updateHangHoa(value)">
                                                            </td>
                                                            <td>
                                                                <input type="number" class="form-control"
                                                                    v-model="value.don_gia_ban"
                                                                    v-on:change="updateHangHoa(value)">
                                                            </td>
                                                            <td>@{{ number_format(value.thanh_tien) }} đ</td>

                                                            <td class="text-center">
                                                                <div class="d-flex order-actions  ">
                                                                    <a v-on:click="deleteHangHoa(value)" class="ms-3"><i
                                                                            class="bx bxs-trash text-danger"></i></a>
                                                                </div>
                                                                {{-- <button class="btn btn-danger" v-on:click="deleteHangHoa(value)">Xóa</button> --}}
                                                            </td>
                                                        </tr>
                                                    </template>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="card-footer bg-white text-end">
                                            <p><b>Tổng thanh toán : @{{ number_format(tong_tien) }} đ</b></p>
                                            <p class="mt-3"><b>Phần trăm giảm : @{{ add.phan_tram_giam }}%</b></p>
                                            <p><b>Tiền phải trả : @{{ number_format(add.tien_da_giam) }} đ</b></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-sm radius-30 px-4" data-bs-dismiss="modal"><i
                                class="bx bx-x-circle mr-1"></i> Đóng</button>
                        {{-- <button type="button" class="btn btn-secondary" v-else data-bs-dismiss="modal" v-on:click="huyMoSan()">Hủy mở sân</button> --}}
                        <a class="btn btn-primary btn-sm radius-30 px-4" target="_blank"
                            v-bind:href="'/admin/san/bill-thue-san/' + id_hoa_don_thue">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Tạm
                            Tính
                        </a>
                        <template v-if="add.tinh_trang == 3 || kiemtraketthuc(add.gio_ket_thuc, add.ngay_thue_san) == false ">
                            <button disabled class="btn btn-success btn-sm radius-30 px-4">
                                <i class="bx bx-check-circle mr-1"></i> Thanh Toán
                            </button>
                        </template>
                        <template v-else>
                            <a  type="button" class="btn btn-success btn-sm radius-30 px-4" v-on:click="thanhToanSan()"
                            target="_blank" v-bind:href="'/admin/san/bill-thanh-toan/' + id_hoa_don_thue"><i
                                class="bx bx-check-circle mr-1"></i> Thanh Toán</a>
                        </template>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        new Vue({
            el: "#app",
            data: {
                listLoaiSan: [],
                listHangHoa: [],
                listSanHD: [],
                listSan: [],
                ten_san: '',
                id_hoa_don_thue: 0,
                listKhachHang: [],
                dataSanDangMo: {},
                id_loai_san: 0,
                listAddHang: [],
                thoi_gian_nguoc: '',
                id_san: 0,
                add: {
                    'id_khach_hang': null
                },
                tong_tien: 0,
                tien_goc: 0,
                extra_fee: 0,
            },
            created() {
                this.loadData();
                this.loadHangHoa();
                this.loadKhachHang();
                // this.demNguocThoiGianSan();
                this.getDanhSachSanHD(0)
            },
            methods: {
                date_format(now) {
                    return moment(now).format('DD/MM/yyyy HH:mm:ss');
                },

                number_format(number, decimals = 0, dec_point = ",", thousands_sep = ".") {
                    var n = number,
                        c = isNaN((decimals = Math.abs(decimals))) ? 2 : decimals;
                    var d = dec_point == undefined ? "," : dec_point;
                    var t = thousands_sep == undefined ? "." : thousands_sep,
                        s = n < 0 ? "-" : "";
                    var i = parseInt((n = Math.abs(+n || 0).toFixed(c))) + "",
                        j = (j = i.length) > 3 ? j % 3 : 0;

                    return (s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (
                        c ? d +
                        Math.abs(n - i)
                        .toFixed(c)
                        .slice(2) :
                        ""));
                },

                loadData() {
                    axios
                        .get('/admin/loai-san/data')
                        .then((res) => {
                            this.listLoaiSan = res.data.data;
                        });
                },

                getDanhSachSanHD(id_loai_san) {
                    var payload = {
                        'id': id_loai_san,
                    };
                    axios
                        .post('/admin/san/get-danh-sach-san-hd', payload)
                        .then((res) => {
                            this.listSanHD = res.data.data;
                        })
                },

                getDanhSachSan(id_loai_san) {
                    var payload = {
                        'id': id_loai_san,
                    };
                    console.log(payload);
                    axios
                        .post('/admin/san/get-danh-sach-san', payload)
                        .then((res) => {
                            this.listSan = res.data.data;
                            console.log(this.listSan);
                        })
                },

                loadHangHoa() {
                    axios
                        .get('/admin/san/data-hang-hoa')
                        .then((res) => {
                            this.listHangHoa = res.data.data;
                        });
                },

                getTien(id_san) {
                    const tien = this.listSan.find((element) => element.id === id_san).tien_goc
                    $('#display_tien').val(this.number_format(tien))
                    this.add.so_tien = tien
                    this.tien_goc = tien
                },

                moSan(id, hoa_don_id) {
                    var payload = {
                        'id_san': id,
                        'hoa_don_id': hoa_don_id,
                    };
                    this.add = {};
                    axios
                        .post('/admin/san/mo-san', payload)
                        .then((res) => {
                            if (res.data.status == 1) {
                                this.dataSanDangMo = res.data.dataSanDangMo;
                                this.add = this.dataSanDangMo;
                                this.id_hoa_don_thue = res.data.id_thue_san;
                                this.tong_tien = res.data.tong_tien;
                                this.loadAddHangHoa();
                            }
                        })
                },

                updateMoSan() {
                    this.add.id_hoa_don_thue = this.id_hoa_don_thue;
                    axios
                        .post('/admin/san/update-mo-san', this.add)
                        .then((res) => {
                            if (res.data.status) {
                                $("#mosanModal1").modal('hide');
                                toastr.success(res.data.message);
                                this.getDanhSachSan(this.id_loai_san);
                                this.loadAddHangHoa();
                            } else {
                                toastr.error(res.data.message);
                            }
                        })
                },

                createMoSan() {
                    axios
                        .post('/admin/san/mo-san-real', this.add)
                        .then((res) => {
                            if (res.data.status) {
                                $("#mosanModal1").modal('hide');
                                this.tien = 0
                                $('#display_tien').val(0);
                                toastr.success(res.data.message);
                                setTimeout(() => {
                                    this.getDanhSachSanHD(this.id_loai_san);
                                }, 500);
                            } else {
                                toastr.error(res.data.message);
                            }
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0]);
                            })
                        });
                },



                loadKhachHang() {
                    axios
                        .get('/admin/san/data-khach-hang')
                        .then((res) => {
                            this.listKhachHang = res.data.data;
                        });
                },

                addHang(v) {
                    v.id_hoa_don_thue = this.id_hoa_don_thue;
                    axios
                        .post('/admin/san/add-hang', v)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.message);
                                this.loadAddHangHoa();
                            } else {
                                toastr.error(res.data.message);
                                this.loadAddHangHoa();
                            }
                        })
                },

                updateHangHoa(v) {
                    axios
                        .post('/admin/san/update-hang', v)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.message);
                                this.loadAddHangHoa();
                            } else {
                                toastr.error(res.data.message);
                                this.loadAddHangHoa();
                            }
                        })
                },

                loadAddHangHoa() {
                    axios
                        .get('/admin/san/get-add-hang/' + this.id_hoa_don_thue)
                        .then((res) => {
                            this.listAddHang = res.data.data;
                            this.tong_tien = res.data.tong_tien;
                            this.add.phan_tram_giam = res.data.phan_tram_giam;
                            this.add.tien_da_giam = res.data.tien_da_giam;
                        });
                },

                deleteHangHoa(v) {
                    axios
                        .post('/admin/san/delete-hang', v)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.message);
                                this.loadAddHangHoa();
                            } else {
                                toastr.error(res.data.message);
                                this.loadAddHangHoa();
                            }
                        })
                },

                kiemtraketthuc(thoi_gian_ket_thuc, ngay_thue_san) {
                    var now = moment().format("YYYY-MM-DD HH:mm:ss");
                    var time = ngay_thue_san + ' ' + thoi_gian_ket_thuc;
                    if (time < now) {
                        return true;
                    } else {
                        return false;
                    }
                },

                thanhToanSan() {
                    var payload = {
                        'tong_thanh_toan': this.tong_tien,
                        'tien_da_giam': this.add.tien_da_giam,
                        'id_hoa_don_thue': this.id_hoa_don_thue,
                    };
                    axios
                        .post('/admin/san/thanh-toan-san', payload)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.message);
                                $("#mosanModal").modal('hide');
                                this.getDanhSachSanHD(this.id_loai_san);
                                window.open(res.data.noi_dung_tele, '_blank');
                            }
                        })
                },

                pickTime(time, flag) {
                    const hour = time.split(':')[0];
                    const convertedTime = `${hour}:00`;
                    if (flag === 'start') {
                        if (this.add.gio_ket_thuc !== undefined) {
                            this.add.gio_ket_thuc = undefined
                            this.add.so_tien = this.tien_goc
                        }
                        this.add.gio_bat_dau = convertedTime
                        axios
                            .get('/admin/san/extra-fee?time=' + this.add.gio_bat_dau)
                            .then((res) => {
                                this.extra_fee = res.data.extra_fee
                            })
                    } else {
                        this.add.gio_ket_thuc = convertedTime
                        this.setMoney()
                    }
                },

                setMoney() {
                    if (this.add.gio_bat_dau !== undefined && this.add.gio_ket_thuc !== undefined && this.add
                        .so_tien != undefined) {
                        const startHour = this.add.gio_bat_dau.split(':')[0];
                        const endHour = this.add.gio_ket_thuc.split(':')[0];
                        const duration = endHour - startHour

                        if (duration <= 0) {
                            toastr.error('Giờ chọn không đúng, vui lòng chọn lại')
                            this.add.gio_bat_dau = undefined
                            this.add.gio_ket_thuc = undefined
                            this.add.so_tien = this.tien_goc
                            return 0;
                        } else {
                            const tien = this.tien_goc * this.extra_fee * duration
                            this.add.so_tien = tien
                            $('#display_tien').val(this.number_format(tien))
                        }
                    }
                },

                checkSanToiGioDa(){
                    axios
                        .get('/admin/san/check-gio-san-da')
                        .then((res) => {
                            if(res.data.status){
                                this.getDanhSachSanHD(this.id_loai_san);
                            }
                        })
                }
            }
        });
    </script>
@endsection
