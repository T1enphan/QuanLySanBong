@extends('admin.share.master')
@section('noi_dung')
<div class="row" id="app">

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
               <h6> Tạo Khách Hàng</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Họ Lót</label>
                    <input v-model="add.ho_lot"type="text" class="form-control" placeholder="Nhập vào họ lót *">
                </div>
                <div class="mb-3">
                    <label class="form-label">Tên</label>
                    <input v-model="add.ten" type="text" class="form-control" placeholder="Nhập vào tên *">
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input v-model="add.email" type="text" class="form-control" placeholder="Nhập vào email *">
                </div>
                <div class="mb-3">
                    <label class="form-label">Số Điện Thoại</label>
                    <input v-model="add.so_dien_thoai" type="text" class="form-control" placeholder="Nhập vào số điện thoại *">
                </div>
                <div class="mb-3">
                    <label class="form-label">Địa Chỉ</label>
                    <input v-model="add.dia_chi" type="text" class="form-control" placeholder="Nhập vào địa chỉ*">
                </div>
                <div class="mb-3">
                    <label class="form-label">Giới Tính</label>
                    <select v-model="add.gioi_tinh" class="form-control">
                        <option value="1">Nam</option>
                        <option value="0">Nữ</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Loai Khách Hàng</label>
                    <select v-model="add.id_loai_khach" class="form-control">
                        <template v-for="(value, key) in listLKhach">
                            <option v-bind:value="value.id">@{{value.ten_loai_khach}}</option>
                        </template>

                    </select>
                </div>
            </div>
            <div class="card-footer text-end">
                <button type="button" class="btn btn-secondary btn-sm radius-30 px-4" data-bs-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary btn-sm radius-30 px-4" v-on:click="createKhachHang()">Xác nhận</button>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card  border-bottom border-3 border-0">
            <div class="card-header">
                <h5>Danh Sách Khách Hàng</h5>


            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr >
                                <th class="align-middle text-center">Tìm kiếm</th>
                                <th colspan="2">
                                    <input v-model="key_search" v-on:keyup.enter="search()" type="text" class="form-control">
                                </th>
                                <th class="text-center text-white">
                                    <button class=" btn btn-primary btn-sm radius-30 px-4" v-on:click="search()">Tìm Kiếm</button>
                                </th>
                            </tr>
                            <tr class="table-light">
                                <th class="text-center align-middle">#</th>
                                <th class="text-center align-middle">Họ & Tên</th>
                                <th class="text-center align-middle">Email</th>
                                <th class="text-center align-middle">Số Điện Thoại</th>
                                <th class="text-center align-middle">Địa Chỉ</th>
                                <th class="text-center align-middle">Giới Tính</th>
                                <th class="text-center align-middle">Loại Khách Hàng</th>
                                <th class="text-center align-middle">Phần Trăm Giảm</th>
                                <th class="text-center align-middle">Tình Trạng</th>
                                <th class="text-center align-middle">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-for="(value, key) in list">
                                <tr>
                                    <th class="align-middle">@{{ key + 1 }}</th>
                                    <td class="align-middle">@{{ value.ho_va_ten }}</td>
                                    <td class="align-middle">@{{ value.email }}</td>
                                    <td class="align-middle ">@{{ value.so_dien_thoai }}</td>
                                    <td class="align-middle">@{{ value.dia_chi }}</td>
                                    <td class="align-middle">
                                        <span v-if="value.gioi_tinh == 1">Nam</span>
                                        <span v-else>Nữ</span>
                                    </td>
                                    <td class="align-middle">@{{ value.ten_loai_khach }}</td>
                                    <td class="align-middle text-center">@{{ value.phan_tram_giam }}%</td>
                                    <td class="align-middle text-center">
                                        <button v-if="value.is_active == 1" v-on:click="doiTrangThai(value)" class="btn btn-success btn-sm radius-30 px-4">Hiển Thị</button>
                                        <button v-else class="btn btn-warning btn-sm radius-30 px-4" v-on:click="doiTrangThai(value)">Tạm Khóa</button>
                                    </td>
                                    <td class="align-middle text-nowrap">
                                        <div class="d-flex order-actions  ">
                                            <a v-on:click="edit = value" data-bs-toggle="modal"data-bs-target="#updateModal" ><i class="bx bxs-edit"></i></a>
                                            <a v-on:click="del = value"  class="ms-3" data-bs-toggle="modal"data-bs-target="#deleteModal"><i class="bx bxs-trash "></i></a>
                                        </div>
                                    </td>
                                </tr>
                            </template>

                        </tbody>
                    </table>
                </div>
                <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header ">
                                <h1 class="modal-title fs-5 " id="exampleModalLabel">Cập nhật</h1>
                                <button type="button" class="btn-close " data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Họ & Tên</label>
                                <input v-model="edit.ho_va_ten"type="text" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input v-model="edit.email" type="text" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Số Điện Thoại</label>
                                <input v-model="edit.so_dien_thoai" type="text" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Địa Chỉ</label>
                                <input v-model="edit.dia_chi" type="text" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Giới Tính</label>
                                <select v-model="edit.gioi_tinh" class="form-control">
                                    <option value="1">Nam</option>
                                    <option value="0">Nữ</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Loai Khách Hàng</label>
                                <select v-model="edit.id_loai_khach" class="form-control">
                                    <template v-for="(value, key) in listLKhach">
                                        <option v-bind:value="value.id">@{{value.ten_loai_khach}}</option>
                                    </template>

                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm radius-30 px-4"
                            data-bs-dismiss="modal">Đóng</button>
                        <button v-on:click="updateKhachHang()" type="button" class="btn btn-primary btn-sm radius-30 px-4">Xác nhận</button>

                        </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header ">
                                <h1 class="modal-title fs-5 " id="exampleModalLabel">Xóa Khách Hàng @{{ del.ho_va_ten }}</h1>
                                <button type="button" class="btn-close " data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                        <div class="modal-body">
                            <div >
                                Bạn có chắc chắn muốn xóa khách hàng <b class=" text-uppercase">@{{ del.ho_va_ten }}</b> này không?
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm radius-30 px-4"
                            data-bs-dismiss="modal">Đóng</button>
                        <button v-on:click="delKhachHang()" type="button" class="btn btn-primary btn-sm radius-30 px-4">Xác nhận</button>

                        </div>
                        </div>
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
                add            : {},
                listLKhach       : [],
                list           : [],
                edit           : {},
                del            : {},
                key_search : '',
            },
            created() {
                this.loadDataLoaiKhach();
                this.loadData();

            },
            methods : {
                search() {
                    var payload = {
                        'key_search'    :   this.key_search
                    }
                    axios
                        .post('/admin/khach-hang/search', payload)
                        .then((res) => {
                            this.list = res.data.list;
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0]);
                            });
                        });
                },
                createKhachHang() {
                    axios
                        .post('/admin/khach-hang/create', this.add)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.message);
                                this.loadData();
                            }else{
                                toastr.error(res.data.message);
                            }
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0]);
                            })

                        });
                },
                loadDataLoaiKhach() {
                    axios
                        .get('/admin/khach-hang/data-lkh')
                        .then((res) => {
                            this.listLKhach  =  res.data.data;
                        });
                },

                loadData() {
                    axios
                        .get('/admin/khach-hang/data')
                        .then((res) => {
                            this.list  =  res.data.data;

                        });
                },
                updateKhachHang() {

                    axios
                        .post('/admin/khach-hang/update', this.edit)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.message);
                                this.loadData();
                                $('#updateModal').modal('hide');
                            }else{
                                toastr.error(res.data.message);
                            }
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0]);
                            })
                        });
                },
                delKhachHang() {
                    axios
                        .post('/admin/khach-hang/delete', this.del)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.message);
                                this.loadData();
                                $('#deleteModal').modal('hide');
                            }else{
                                toastr.error(res.data.message);
                            }
                        });
                },

                doiTrangThai(value){
                    axios
                        .post('/admin/khach-hang/doi-trang-thai', value)
                        .then((res) => {
                            if(res.data.status){
                                toastr.success(res.data.message);
                                this.loadData();
                            }
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0], 'Error');
                            });
                        });
                },


            }
    });
</script>
@endsection
