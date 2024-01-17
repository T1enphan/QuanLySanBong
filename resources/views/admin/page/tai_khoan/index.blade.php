@extends('admin.share.master')
@section('noi_dung')
    <div class="row" id="app">

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                   <h6> Tạo Tài Khoản</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Họ Và Tên</label>
                        <input v-model="add.ho_va_ten" type="text" class="form-control" placeholder="Nhập vào họ và tên *">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input v-model="add.email" type="email" class="form-control" placeholder="Nhập vào email *">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Số Điện Thoại</label>
                        <input v-model="add.so_dien_thoai" type="tel" class="form-control" placeholder="Nhập vào số điện thoại *">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ngày Sinh</label>
                        <input v-model="add.ngay_sinh" type="date" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Địa Chỉ</label>
                        <input v-model="add.dia_chi" type="text" class="form-control" placeholder="Nhập vào họ và tên *">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mật Khẩu</label>
                        <input v-model="add.password" type="password" class="form-control" placeholder="Nhập vào mật khẩu *">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Xác Nhận Mật Khẩu</label>
                        <input v-model="add.re_password" type="password" class="form-control" placeholder="Nhập lại mật khẩu *">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Chọn Quyền</label>
                        <select v-model="add.id_quyen" class="form-control">
                            <option value="0">Admin</option>
                            <template v-for="(v, k) in list_quyen">
                                <option v-bind:value="v.id">@{{ v.ten_quyen }}</option>
                            </template>
                        </select>
                    </div>

                </div>
                <div class="card-footer text-end">
                    <button type="button" class="btn btn-secondary btn-sm radius-30 px-4" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary btn-sm radius-30 px-4" v-on:click="createTaiKhoan()">Xác nhận</button>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card  border-bottom border-3 border-0">
                <div class="card-header">
                    <b>Danh Sách Tài Khoản</b>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr class="table-light">
                                    <th class=" align-middle">#</th>
                                    <th class=" align-middle">Họ Và Tên</th>
                                    <th class=" align-middle">Email</th>
                                    <th class=" align-middle">Số Điện Thoại</th>
                                    <th class=" align-middle">Ngày Sinh</th>
                                    <th class=" align-middle">Địa Chỉ</th>
                                    <th class=" align-middle">Quyền</th>
                                    <th class=" align-middle">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                             <tr v-for="(value , key) in list">
                                <th class=" align-middle">@{{key + 1}}</th>
                                <td class="align-middle">@{{ value.ho_va_ten}}</td>
                                <td class="align-middle">@{{ value.email}}</td>
                                <td class=" align-middle">@{{ value.so_dien_thoai}}</td>
                                <td class=" align-middle">@{{ value.ngay_sinh}}</td>
                                <td class="align-middle">@{{ value.dia_chi}}</td>
                                <td class="align-middle">@{{ value.ten_quyen }}</td>
                                <td class=" align-middle text-nwrap">
                                    <div class="d-flex order-actions  ">
                                        <a v-on:click="password_new = value" data-bs-toggle="modal"data-bs-target="#changePasswordModal"><i class="bx bxs-key"></i></a>
                                        <a v-on:click="edit = value"  class="ms-3" data-bs-toggle="modal"data-bs-target="#updateModal" ><i class="bx bxs-edit"></i></a>
                                        <a v-on:click="del = value"  class="ms-3" data-bs-toggle="modal"data-bs-target="#deleteModal"><i class="bx bxs-trash "></i></a>
                                    </div>


                                </td>
                             </tr>
                            </tbody>
                        </table>
                        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header ">
                                        <h1 class="modal-title fs-5 " id="exampleModalLabel">Xóa</h1>
                                        <button type="button" class="btn-close " data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div >
                                            <p>Bạn có chắc chắn muốn xoá <b >@{{del.ho_va_ten}}</b> không?</p>
                                            <p><b>Lưu ý:</b> Thao tác này sẽ không thể hoàn tác</p>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm radius-30 px-4"
                                        data-bs-dismiss="modal">Đóng</button>
                                    <button v-on:click="DelAdmin()" type="button" class="btn btn-primary btn-sm radius-30 px-4">Xác nhận</button>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header ">
                                        <h1 class="modal-title fs-5 " id="exampleModalLabel">Cập nhật</h1>
                                        <button type="button" class="btn-close " data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Họ Và Tên</label>
                                            <input v-model="edit.ho_va_ten" type="text" class="form-control" placeholder="Nhập vào họ và tên *">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input v-model="edit.email" type="email" class="form-control" placeholder="Nhập vào email *">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Số Điện Thoại</label>
                                            <input v-model="edit.so_dien_thoai" type="tel" class="form-control" placeholder="Nhập vào số điện thoại *">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Ngày Sinh</label>
                                            <input v-model="edit.ngay_sinh" type="date" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Địa Chỉ</label>
                                            <input v-model="edit.dia_chi" type="text" class="form-control" placeholder="Nhập vào họ và tên *">
                                        </div>
                                        {{-- <div class="mb-3">
                                            <label class="form-label">Quyền Tài Khoản</label>
                                            <select v-model="edit.id_quyen" class="form-control">
                                                @foreach ($quyen as $key => $value)
                                                    <option value="{{$value->id}}">{{$value->ten_quyen}}</option>
                                                @endforeach
                                            </select>
                                        </div> --}}
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm radius-30 px-4"
                                        data-bs-dismiss="modal">Đóng</button>
                                    <button v-on:click="UpdateAdmin()" type="button" class="btn btn-primary btn-sm radius-30 px-4">Xác nhận</button>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header ">
                                        <h1 class="modal-title fs-5 " id="exampleModalLabel">Đổi Mật Khẩu</h1>
                                        <button type="button" class="btn-close " data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" v-model="password_new.id">
                                        <div class="mb-3">
                                            <label class="form-label">Mật Khẩu</label>
                                            <input type="password" class="form-control" name="password" v-model="password_new.password_new" placeholder="Nhập vào mật khẩu mới *">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Xác Nhận Mật Khẩu</label>
                                            <input type="password" class="form-control" name="re_password" v-model="password_new.re_password"  placeholder="Nhập lại mật khẩu mới *">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm radius-30 px-4"
                                        data-bs-dismiss="modal">Đóng</button>
                                    <button v-on:click="changePassWord()" type="button" class="btn btn-primary btn-sm radius-30 px-4">Xác nhận</button>

                                    </div>
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
        el   : "#app",
        data : {
            add                 : {},
            list                : [],
            del                 : {},
            edit                : {},
            password_new        : {},
            list_quyen          : []

        },
        created() {
            this.loadData();
            this.laodDataQuyen();
        },
        methods : {
            createTaiKhoan(){
                axios
                    .post('/admin/tai-khoan/create', this.add)
                    .then((res) => {
                        if(res.data.status) {
                            toastr.success(res.data.message);
                            this.loadData();
                            this.add = {};
                        }
                    })
                    .catch((res) => {
                        $.each(res.response.data.errors, function(k, v) {
                            toastr.error(v[0]);
                        });
                    });
            },

            laodDataQuyen(){
                axios
                    .get('/admin/tai-khoan/data-quyen')
                    .then((res) => {
                        this.list_quyen  =  res.data.data;
                    });
            },

            loadData() {
                axios
                    .get('/admin/tai-khoan/data')
                    .then((res) => {
                        this.list  =  res.data.list;
                    });
            },
            DelAdmin() {
                axios
                    .post('/admin/tai-khoan/delete', this.del)
                    .then((res) => {
                        if (res.data.status) {
                            toastr.success(res.data.message);
                            this.loadData();
                            $('#deleteModal').modal('hide');
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
            UpdateAdmin() {
                axios
                    .post('/admin/tai-khoan/update',this.edit)
                    .then((res) => {
                        if(res.data.status) {
                            toastr.success(res.data.message);
                            this.loadData();
                            $('#updateModal').modal('hide');
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
            changePassWord() {

                axios
                    .post('/admin/tai-khoan/change-password', this.password_new)
                    .then((res) => {
                        if(res.data.status) {
                            toastr.success(res.data.message);
                            this.loadData();
                            $('#changePasswordModal').modal('hide');
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
