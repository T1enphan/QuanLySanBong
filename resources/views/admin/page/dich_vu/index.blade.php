@extends('admin.share.master')
@section('noi_dung')
    <div class="row" id="app">
        <div class="col-6">
            <div class="card card  border-bottom border-3 border-0">
                <div class="card-header">
                    <div class="row">
                        <div class="col-2 ">
                            <h6 class="align-middle text-center text-nowrap mt-2"> <b>Tìm kiếm</b></h6>
                        </div>
                        <div class="col-6">
                            <input v-model="key_search" v-on:keyup.enter="search()" type="text" class="form-control">
                        </div>
                        <div class="col-4 text-center">
                            <button class="btn btn-primary btn-sm radius-30 px-4" v-on:click="search()">Tìm Kiếm</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="table-responsive" style="max-height: 600px">
                            <table class="table table-striped">
                                <thead>
                                    <div class="col">
                                        <div class="card">
                                            <div class="card-body">
                                                <ul class="nav nav-tabs nav-dark " role="tablist">
                                                    <li class="nav-item mt-2 " role="presentation"
                                                        v-on:click="getHangHoa(0)">
                                                        <a class="nav-link active" data-bs-toggle="tab" href="#primaryhome"
                                                            role="tab" aria-selected="true">
                                                            <div class="d-flex align-items-center">
                                                                <div class="tab-icon">
                                                                </div>
                                                                <div class="tab-title">Tất Cả</div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <template v-for="(value, key) in listLoaiHang">
                                                        <li class="nav-item mt-2" role="presentation"
                                                            v-on:click="getHangHoa(value.id)">
                                                            <a class="nav-link active" data-bs-toggle="tab"
                                                                href="#primaryhome" role="tab" aria-selected="true">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="tab-icon">
                                                                    </div>
                                                                    <div class="tab-title">@{{ value.ten_loai_hang }}</div>
                                                                </div>
                                                            </a>
                                                        </li>
                                                    </template>
                                                </ul>
                                                <div class="tab-content py-3">
                                                    <div class="tab-pane fade show active" id="primaryhome" role="tabpanel">
                                                        <div class="row">
                                                            <template v-for="(value, key) in list_hang">

                                                                <div class="col-3">
                                                                    <div class="card card  border-bottom border-3 border-0"
                                                                        style="max-width: 150px; height: 120px"
                                                                        v-on:click="addHang(value)">
                                                                        <div class="card-body">
                                                                            <div class="text-center align-middle">
                                                                                <span
                                                                                    class="my-4 text-wrap "><b>@{{ value.ten_hang }}</b></span>
                                                                                {{-- <h6 class="my-4 text-wrap  ">@{{ value.ten_hang }}</h6> --}}
                                                                            </div>
                                                                        </div>
                                                                        <div class="card-footer">
                                                                            <p class="mb-0 bg-while text-nowrap">
                                                                                @{{ number_format(value.gia_hang, 0) }}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </template>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card card border-bottom border-3 border-0">
                <div class="card-header">
                    <h6>Danh Sách Bán Hàng</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive" style="max-height: 570px">
                        <table class="table mb-0">
                            <thead>
                                <tr class="table-light">

                                    <th class="text-center align-middle text-nowrap">Tổng Tiền</th>
                                    <td class="align-middle">
                                        <b>@{{ number_format(tong_tien) }}</b>
                                    </td>
                                    <td class="align-middle" colspan="3">
                                        <i class="text-capitalize">@{{ tien_chu }}</i>
                                    </td>
                                </tr>
                                <tr class="table-light">
                                    <th class="text-center">#</th>
                                    <th class="text-center text-nowrap">Tên Sản Phẩm</th>
                                    <th class="text-center">Số Lượng</th>
                                    <th class="text-center">Đơn Giá</th>
                                    <th class="text-center">Thành Tiền</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template v-for="(value, key) in data_ban_hang">
                                    <tr>
                                        <th class="text-center align-middle">@{{ key + 1 }}</th>
                                        <td class="align-middle text-nowrap">@{{ value.ten_hang }}</td>
                                        <td class="align-middle text-center text-nowrap">
                                            <input class="form-control" type="number" v-model="value.so_luong_ban"
                                                v-on:change="updateChiTietHoaDonNhap(value)">
                                        </td>
                                        <td class="align-middle text-center text-nowrap">
                                            <input class="form-control" disabled type="number" v-model="value.don_gia_ban"
                                                v-on:change="updateChiTietHoaDonNhap(value)">
                                        </td>
                                        <td class="align-middle">@{{ number_format(value.thanh_tien) }}</td>
                                        <td class="align-middle text-center text-nowrap">
                                            <div class="d-flex order-actions  ">
                                                <a v-on:click="hang_hoa = value" class="ms-3"
                                                    data-bs-toggle="modal"data-bs-target="#deleteModal"><i
                                                        class="bx bxs-trash "></i></a>
                                            </div>

                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header ">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Xóa Hàng</h1>
                                    <button type="button" class="btn-close " data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div>
                                        Bạn có chắc chắn muốn xóa loại khách hàng: <b
                                            class=" text-uppercase">@{{ hang_hoa.ten_hang }}</b> này không?
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm radius-30 px-4"
                                        data-bs-dismiss="modal">Đóng</button>
                                    <button v-on:click="accpectDel()" type="button"
                                        class="btn btn-primary btn-sm radius-30 px-4">Xác nhận</button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-white">
                    <div class="row">
                        <div class="col-md-6">

                        </div>
                        <div class="col-md-3">
                            <a class="btn btn-secondary btn-sm radius-30 px-4 w-100" target="_blank"
                                v-bind:href="'/admin/dich-vu/bill/' + bill.id_hoa_don_dich_vu">Tạm Tính</a>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-secondary btn-sm radius-30 px-4 w-100" v-on:click="thanhToan()">Thanh
                                Toán</button>
                        </div>
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
                list_hang: [],
                key_search: '',
                data_ban_hang: [],
                hang_hoa: {},
                bill: {
                    'id_hoa_don_dich_vu': 0
                },
                listLoaiHang: [],
                tong_tien: 0,
                tien_chu: '',
                id_hoa_don_ban: 0,

            },
            created() {
                this.loadDanhSachHang();
                this.loadTableBanHang();
                this.loadDataLoaiHang();
            },
            methods: {
                number_format(number) {
                    return new Intl.NumberFormat('vi-VI', {
                        style: 'currency',
                        currency: 'VND'
                    }).format(number);
                },
                search() {
                    var payload = {
                        'key_search': this.key_search
                    }
                    axios
                        .post('/admin/dich-vu/search', payload)
                        .then((res) => {
                            this.list_hang = res.data.list;
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0]);
                            });
                        });
                },
                loadDataLoaiHang() {
                    axios
                        .get('/admin/hang-hoa/data-lhh')
                        .then((res) => {
                            this.listLoaiHang = res.data.data;
                        });
                },
                getHangHoa(id) {
                    var payload = {
                        'id': id,
                    };
                    axios
                        .post('/admin/dich-vu/get-hang-hoa', payload)
                        .then((res) => {
                            this.list_hang = res.data.data;
                        })
                },

                loadDanhSachHang() {
                    axios
                        .get('/admin/dich-vu/data-hang-hoa')
                        .then((res) => {
                            this.list_hang = res.data.data;
                        });
                },
                addHang(value) {
                    axios
                        .post('/admin/dich-vu/them-san-pham-ban', value)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.message);
                                this.loadTableBanHang();
                            } else {
                                toastr.error(res.data.message);
                            }
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0]);
                            });
                        });
                },
                loadTableBanHang() {
                    // this.time = 20;
                    axios
                        .get('/admin/dich-vu/data')
                        .then((res) => {
                            this.data_ban_hang = res.data.data;
                            this.tong_tien = res.data.tong_tien;
                            this.tien_chu = res.data.tien_chu;
                        });
                },
                accpectDel() {
                    axios
                        .post('/admin/dich-vu/delete-hang-hoa', this.hang_hoa)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.message);
                                this.loadTableBanHang();

                            } else {
                                toastr.error(res.data.message);
                            }
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0]);
                            });
                        });
                },
                updateChiTietHoaDonNhap(value) {
                    axios
                        .post('/admin/dich-vu/update-chi-tiet-hoa-don-nhap', value)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.message);
                                this.loadTableBanHang();

                            } else {
                                toastr.error(res.data.message);
                                this.loadTableBanHang();
                            }
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0]);
                            });
                        });
                },
                thanhToan() {
                    var payload = {
                        'tong_tien': this.tong_tien,
                    }
                    axios
                        .post('/admin/dich-vu/thanh-toan', payload)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.message);
                                if (res.data.banHang) {
                                    this.id_hoa_don_ban = res.data.banHang.id;
                                    this.loadTableBanHang();
                                    var link = '/admin/dich-vu/bill-thanh-toan/' + this.id_hoa_don_ban;
                                    window.open(link, '_blank');

                                } else {
                                    this.loadTableBanHang();
                                }
                            } else {
                                toastr.error(res.data.message);
                                this.loadTableBanHang();

                            }
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0]);
                            });
                        });
                },


            }
        });
    </script>
@endsection
