@extends('admin.share.master')
@section('noi_dung')
<div id="app" class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"> Thêm Mới Quyền</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form id="formdata" v-on:submit.prevent="add()">
                            <div class="modal-body">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="col-md-12 mb-2">
                                            <label class="form-label">Tên Quyền</label>
                                            <input type="text" name="ten_quyen" class="form-control">
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <label class="form-label">Trạng Thái</label>
                                            <select name="tinh_trang" class="form-control">
                                                <option value="1">Hoạt Động</option>
                                                <option value="0">Tạm Tắt</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-sm radius-30 px-4" data-bs-dismiss="modal">Close</button>
                                <button  class="btn btn-primary btn-sm radius-30 px-4" type="submit">Thêm Mới</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-header">
                <div class="row">
                    <div class="col-md-10">

                        <div class="input-group md-form form-sm form-2 pl-0">
                            <div class="input-group-append">
                                <h6> Danh Sách Quyền</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-original-title="test"
                            data-bs-target="#exampleModal"><i class="fa fa-plus-square" aria-hidden="true"></i></button>
                    </div>
                </div>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr class="table-light">
                                <th class="text-center align-middle">#</th>
                                <th class="text-center align-middle">Tên Quyền</th>
                                <th class="text-center align-middle">Trạng Thái</th>
                                <th class="text-center align-middle">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(value , index) in list_quyen" class="bg-light">
                                <th class="align-middle">@{{ index + 1 }}</th>
                                <td class="align-middle">@{{ value.ten_quyen }}</td>
                                <td class="align-middle text-center">
                                    <button v-if="value.tinh_trang == 1" v-on:click="changeIsOpen(value.id)"
                                    class="btn btn-success btn btn-sm radius-30 px-4">Hoạt Động</button>
                                    <button v-else class="btn btn-white btn btn-sm radius-30 px-4" v-on:click="changeIsOpen(value.id)">Tạm
                                        Tắt</button>
                                </td>
                                {{-- <td class=" align-middle">
                                    <button class="btn btn-info"
                                        v-on:click="cap_quyen = value, getPhanQuyenDetail(value.list_rule)">Cấp
                                        Quyền</button>
                                    <button class="btn btn-primary" v-on:click="getDetail(value)" data-bs-toggle="modal"
                                        data-bs-target="#editModal"><i class="fa-solid fa-pen-to-square"
                                            style="margin-left: 4px"></i></button>
                                    <button class="btn btn-danger" v-on:click="getDetail(value)" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal"><i class="fa-solid fa-trash"
                                            style="margin-left: 4px"></i></button>
                                </td> --}}

                                <td class="text-center text-nowrap align-middle">

                                    <div class="d-flex order-actions  ">
                                        {{-- <button class="btn btn-info"
                                    v-on:click="cap_quyen = value, getPhanQuyenDetail(value.list_rule)">Cấp
                                    Quyền</button> --}}
                                        <button  v-on:click="cap_quyen = value, getPhanQuyenDetail(value.list_rule)"
                                        class="btn btn-primary btn btn-sm radius-30 px-4">Cấp quyền</button>
                                        <a v-on:click="getDetail(value)" data-bs-toggle="modal"
                                        data-bs-target="#editModal" class="ms-3"><i class="bx bxs-edit"></i></a>
                                        <a  v-on:click="getDetail(value)" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal"  class="ms-3" ><i class="bx bxs-trash "></i></a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                {{-- Model Xoa --}}
                <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Xóa Quyền</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Bạn có chắc chắn muốn xóa quyền: <b class="text-danger">"@{{ detail_quyen.ten_quyen }}"</b> này
                                không?
                            </div>
                            <div class="modal-footer">
                                <button type="button"class="btn btn-secondary btn-sm radius-30 px-4"
                                    data-bs-dismiss="modal">Close</button>
                                <button v-on:click="delete_quyen()" type="button" class="btn btn-primary btn-sm radius-30 px-4"
                                    data-bs-dismiss="modal">Xác Nhận</button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Model Edit --}}
                <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Chỉnh Sửa Quyền</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="col-md-12 mb-2">
                                    <label class="form-label">Tên Quyền</label>
                                    <input type="text" name="ten_quyen" v-model="detail_quyen.ten_quyen"
                                        class="form-control">
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label class="form-label">Trạng Thái</label>
                                    <select class="form-control" v-model="detail_quyen.tinh_trang">
                                        <option value="1">Hoạt Động</option>
                                        <option value="0">Tạm Tắt</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button"class="btn btn-secondary btn-sm radius-30 px-4"
                                    data-bs-dismiss="modal">Close</button>
                                <button v-on:click="update_quyen()" type="button" class="btn btn-primary btn-sm radius-30 px-4">Xác
                                    Nhận</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <p>
                    <h6>Phân Quyền</h6> <b class="text-danger">@{{ cap_quyen.ten_quyen }}</b></p>
                </div>
            </div>
            <div class="card-body ">
                <div class="row">
                    <template v-for="(value, index) in list_action">
                        <div class="col-md-6 ">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" v-model="array_action"
                                    v-bind:value="value.id" v-bind:id="'check_' +  value.id">
                                <label class="form-check-label"
                                    v-bind:for="'check_' +  value.id">@{{ value.ten_action }}</label>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
            <div class="card-footer">
                <div class="text-center">
                    <button  class="btn btn-primary btn-sm radius-30 px-4" v-on:click="capNhapPhanQuyen()" style="width: 100%">Cập Nhập Phân
                        Quyền</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    new Vue({
        el: '#app',
        data: {
            list_quyen: [],
            detail_quyen: {},
            list_action: [],
            array_action: [],
            cap_quyen: {},
        },
        created() {
            this.loadDataQuyen();
            this.loadDataAction();
        },
        methods: {
            add(id, name) {
                var paramObj = {};
                $.each($('#formdata').serializeArray(), function(_, kv) {
                    if (paramObj.hasOwnProperty(kv.name)) {
                        paramObj[kv.name] = $.makeArray(paramObj[kv.name]);
                        paramObj[kv.name].push(kv.value);
                    } else {
                        paramObj[kv.name] = kv.value;
                    }
                });
                axios
                    .post('/admin/quyen/create', paramObj)
                    .then((res) => {
                        if (res.data.status) {
                            toastr.success(res.data.message);
                            this.loadDataQuyen();
                            $('#formdata').trigger("reset");
                            $('#exampleModal').modal('hide');
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
            changeIsOpen(id) {
                axios
                    .get('/admin/quyen/update-status/' + id)
                    .then((res) => {
                        if (res.data.status == 1) {
                            toastr.success(res.data.message);
                            this.loadDataQuyen();
                        } else if (res.data.status == 2) {
                            toastr.warning(res.data.message);
                            this.loadDataQuyen();
                        } else {
                            toastr.error(res.data.message);
                        }
                    })
                    .catch((res) => {
                        var listError = res.response.data.errors;
                        $.each(listError, function(key, value) {
                            toastr.error(value[0]);
                        });
                    });
            },
            update_quyen() {
                axios
                    .post('/admin/quyen/update', this.detail_quyen)
                    .then((res) => {
                        if (res.data.status) {
                            toastr.success(res.data.message);
                            this.loadDataQuyen();
                            $('#editModal').modal('hide');
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

            loadDataQuyen() {
                axios
                    .get('/admin/quyen/data')
                    .then((res) => {
                        this.list_quyen = res.data.data;
                    });
            },

            getDetail(value) {
                this.detail_quyen = Object.assign({}, value);
            },

            delete_quyen() {
                axios
                    .post('/admin/quyen/delete', this.detail_quyen)
                    .then((res) => {
                        if (res.data.status == 1) {
                            toastr.success(res.data.message, "Success");
                            this.loadData();
                        } else if (res.data.status == 0) {
                            toastr.error(res.data.message, "Error");
                        } else if (res.data.status == 2) {
                            toastr.warning(res.data.message, "Warning");
                        } else {
                            toastr.error(res.data.message, "Error");
                        }

                    })
                    .catch((res) => {
                        $.each(res.response.data.errors, function(k, v) {
                            toastr.error(v[0]);
                        });
                    });
            },

            loadDataAction() {
                axios
                    .get('/admin/quyen/data-action')
                    .then((res) => {
                        this.list_action = res.data.data;
                    });
            },

            capNhapPhanQuyen() {
                var payload = {
                    'id_quyen': this.cap_quyen.id,
                    'list_rule': this.array_action.toString()
                }
                axios
                    .post('/admin/quyen/update-action', payload)
                    .then((res) => {
                        if (res.data.status) {
                            toastr.success(res.data.message);
                            this.loadDataQuyen();
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

            getPhanQuyenDetail(list_rule) {
                if (list_rule) {
                    if (list_rule.indexOf(","))
                        this.array_action = list_rule.split(",");
                    else {
                        this.array_action.push(list_rule);
                    }
                } else {
                    this.array_action = [];
                }
            }
        },
    });
</script>
@endsection
