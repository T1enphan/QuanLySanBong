@extends('admin.share.master')
@section('noi_dung')
<div class="row" id="app">
    <div class="col-4">
        <div class="card card  border-bottom border-3 border-0s">
            <div class="card-header">
                <h6>Tạo Hóa Đơn Nhập Hàng</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <div class="table-responsive" style="max-height: 450px">
                        <table class="table mb-0">
                            <thead>
                                 <tr>
                                    <th class="align-middle text-center">Tìm kiếm</th>
                                    <th >
                                        <input v-model="key_search" v-on:keyup.enter="search()" type="text" class="form-control">
                                    </th>
                                    <th class="text-center text-white">
                                        <button class="btn btn-primary btn-sm radius-30 px-4" v-on:click="search()">Tìm Kiếm</button>
                                    </th>
                                </tr>
                                <tr class="table-light">
                                    <th class="align-middle text-center">#</th>
                                    <th class="align-middle text-center">Tên Hàng</th>
                                    <th class="align-middle text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template v-for="(value, key) in list_hang">
                                    <tr>
                                        <th class="text-center align-middle">@{{ key + 1 }}</th>
                                        <td class="align-middle">@{{ value.ten_hang }}</td>
                                        <td class="text-center">
                                            <button class="btn btn-primary btn-sm radius-30 px-4" v-on:click="addHang(value)">Thêm</button>
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
    <div class="col-8">
        <div class="card card  border-bottom border-3 border-0">
            <div class="card-header">
               <h6>Danh Sách Nhập Hàng</h6>
            </div>
            <div class="card-body">

                <table class="table mb-0">
                    <thead>
                        <tr>
                            {{-- <th class="align-middle text-nowrap text-center" colspan="2"> Chọn nhà cung cấp</th> --}}
                            <th class="align-middle" colspan="2">
                                <select class="form-control mb-3" v-model="id_nha_cung_cap">
                                    <option value="0">Chọn nhà cung cấp</option>
                                    <template v-for="(value, key) in list_ncc">
                                        <option v-bind:value="value.id">@{{ value.ten_cong_ty}}</option>
                                    </template>
                                </select>
                            </th>
                            <th class="text-center align-middle">Tổng Tiền</th>
                            <td class="align-middle">
                                <b>@{{ number_format(tong_tien) }}</b>
                            </td>
                            <td class="align-middle" colspan="3">
                                <i class="text-capitalize">@{{ tien_chu }}</i>
                            </td>
                        </tr>
                        <tr class="table-light">
                            <th>#</th>
                            <th>Tên Sản Phẩm</th>
                            <th>Số Lượng</th>
                            <th>Đơn Giá</th>
                            <th>Thành Tiền</th>
                            <th>Ghi Chú</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template v-for="(value, key) in data_nhap_hang">
                            <tr>
                                <th class=" align-middle">@{{ key + 1}}</th>
                                <td class="align-middle text-nowrap">@{{ value.ten_hang }}</td>
                                <td class="align-middle  text-nowrap">
                                    <input class="form-control" type="number" v-model="value.so_luong_nhap" v-on:change="updateChiTietHoaDonNhap(value)">
                                </td>
                                <td class="align-middle  text-nowrap">
                                    <input class="form-control" type="number" v-model="value.don_gia_nhap" v-on:change="updateChiTietHoaDonNhap(value)">
                                </td>
                                <td class="align-middle">@{{ number_format(value.thanh_tien) }}</td>
                                <td class="align-middle  text-nowrap">
                                    <input class="form-control" type="text" v-model="value.ghi_chu" v-on:change="updateChiTietHoaDonNhap(value)">
                                </td>
                                <td class="align-middle ">
                                    <div class="d-flex order-actions  ">
                                        <a v-on:click="del = value"  class="ms-3" data-bs-toggle="modal"data-bs-target="#deleteModal"><i class="bx bxs-trash " v-on:click="hang_hoa = value"></i></a>

                                    </div>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
                <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header ">
                                <h1 class="modal-title fs-5 " id="exampleModalLabel">Xóa</h1>
                                <button type="button" class="btn-close " data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div>
                                Bạn có chắc chắn muốn xóa loại khách hàng: <b class=" text-uppercase">@{{ hang_hoa.ten_hang }}</b> này không?
                            </div>
                        </div>
                        <div class="modal-footer">

                                <button type="button" class="btn btn-secondary btn-sm radius-30 px-4"
                                data-bs-dismiss="modal">Đóng</button>
                            <button v-on:click="accpectDel()" type="button" class="btn btn-primary btn-sm radius-30 px-4">Xác nhận</button>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-white">
                <div class="row">

                    <div class="col-md-12">
                        <button class="btn btn-secondary w-100" v-on:click="nhapHang()">Nhập Hàng</button>
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
        el : "#app",
            data : {
                list_ncc        : [],
                list_hang        : [],
                data_nhap_hang  : [],
                hang_hoa          : {},
                tong_tien       : 0,
                tien_chu        : '',
                id_nha_cung_cap : 0,
                id_hoa_don_nhap : 0,
                key_search      : '',


            },
            created() {
                this.loadDataNCC();
                this.loadDanhSachHang();
                this.loadTableNhapHang();
            },
            methods : {
                number_format(number) {
                    return new Intl.NumberFormat('vi-VI', { style: 'currency', currency: 'VND' }).format(number);
                },
                search() {
                    var payload = {
                        'key_search'    :   this.key_search
                    }
                    axios
                        .post('/admin/nhap-hang/search', payload)
                        .then((res) => {
                            this.list_hang = res.data.list;
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0]);
                            });
                        });
                },
                loadDataNCC() {
                    axios
                        .get('/admin/nha-cung-cap/data')
                        .then((res) => {
                            this.list_ncc  =  res.data.data;
                        });
                },
                loadDanhSachHang() {
                    axios
                        .get('/admin/nhap-hang/data-hang-hoa')
                        .then((res) => {
                            this.list_hang = res.data.data;
                        });
                },
                loadTableNhapHang() {
                    this.time = 20;
                    axios
                        .get('/admin/nhap-hang/data')
                        .then((res) => {
                            this.data_nhap_hang = res.data.data;
                            this.tong_tien       = res.data.tong_tien;
                            this.tien_chu        = res.data.tien_chu;
                        });
                },

                addHang(value) {
                    axios
                        .post('/admin/nhap-hang/add-san-pham-nhap-hang', value)
                        .then((res) => {
                            if(res.data.status) {
                                toastr.success(res.data.message);
                                this.loadTableNhapHang();
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

                accpectDel() {
                    axios
                        .post('/admin/nhap-hang/delete-hang-hoa', this.hang_hoa)
                        .then((res) => {
                            if(res.data.status) {
                                toastr.success(res.data.message);
                                this.loadTableNhapHang();
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
                        .post('/admin/nhap-hang/update-chi-tiet-hoa-don-nhap', value)
                        .then((res) => {
                            if(res.data.status) {
                                toastr.success(res.data.message);
                                this.loadTableNhapHang();
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
                nhapHang(){
                    var payload = {
                        'id_nha_cung_cap' : this.id_nha_cung_cap,
                        'tong_tien_nhap'  : this.tong_tien,
                    }
                    axios
                        .post('/admin/nhap-hang/nhap-hang-real', payload)
                        .then((res) => {
                            if(res.data.status) {
                                toastr.success(res.data.message);
                                if(res.data.nhapHang.id_nha_cung_cap) {
                                    this.id_hoa_don_nhap = res.data.nhapHang.id;
                                    this.loadTableNhapHang();
                                } else {
                                    this.loadTableNhapHang();
                                }
                            } else {
                                toastr.error(res.data.message);
                                this.loadTableNhapHang();

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
