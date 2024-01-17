@extends('admin.share.master')
@section('noi_dung')
    <div class="row" id="app">
        <div class="col">
            <div class="text-end">
                <button class="btn btn-primary btn-sm radius-30 px-4 mb-2" data-bs-toggle="modal"
                    data-bs-target="#CreateBaivietModal">Tạo bài viết</button>
            </div>
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <h5>Danh Sách Bài viết</h5>
                    </div>
                    <div class="row">
                        <div class="col-md-11">
                            <th colspan="2">
                                <input v-model="key_search" v-on:keyup.enter="search()" type="text" class="form-control">
                            </th>
                        </div>
                        <div class="col-md-1">
                            <th class="text-center text-white">
                                <button v-on:click="search()" class="btn btn-primary btn-sm radius-30 px-4">Search</button>
                            </th>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table mb-0">
                        <thead>
                            <tr class="table-light">
                                <th class="text-center" scope="col">#</th>
                                <th class="text-center" scope="col">Tiêu Đề Bài Viết</th>
                                <th class="text-center" scope="col">Hình Ảnh</th>
                                <th class="text-center" scope="col">Mô Tả Ngắn</th>
                                <th class="text-center" scope="col">Mô Tả Chi Tiết</th>
                                <th class="text-center" scope="col">Trạng Thái</th>
                                <th class="text-center" scope="col">Thể Loại</th>
                                <th class="text-center" scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(value, key) in list" class=" align-middle">
                                <td class="text-center align-middle" scope="col">@{{ key + 1 }}</td>
                                <td scope="col">@{{ value.tieu_de_bai_viet }}</td>
                                <td scope="col" class="text-center">
                                    <img style="height: 120px; width: 150px" v-bind:src="value.hinh_anh_bai_viet"
                                        alt="">
                                </td>
                                <td scope="col">
                                    <div class="text-center align-middle">
                                        <button class="btn btn-primary " data-bs-toggle="modal"
                                            data-bs-target="#MotaNganModal"><i class="fa-solid fa-comment"></i></button>
                                    </div>
                                    <div class="modal fade" id="MotaNganModal" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Mô tả ngắn</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    @{{ value.mo_ta_ngan_bai_viet }}
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td scope="col">
                                    <div class="text-center align-middle">
                                        <button class="btn btn-primary " data-bs-toggle="modal"
                                            data-bs-target="#MoTaCTModal"><i class="fa-solid fa-comment"></i></button>
                                    </div>
                                    <div class="modal fade" id="MoTaCTModal" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Mô tả chi tiết</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <span v-html="value.mo_ta_chi_tiet_bai_viet">

                                                    </span>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td scope="col" class="text-center">
                                    <button class="btn btn-primary btn btn-sm radius-30 px-4"
                                        v-on:click="changeStatus(value)" v-if="value.trang_thai == 0">Hiển thị</button>
                                    <button class="btn btn-white btn-sm radius-30 px-4" v-on:click="changeStatus(value)"
                                        v-if="value.trang_thai == 1">Tạm Tắt</button>
                                </td>
                                <td scope="col" class="text-center">
                                    <button class="btn btn-primary btn btn-sm radius-30 px-4" v-if="value.the_loai == 0">Tin
                                        tức thể thao</button>
                                    <button class="btn btn-primary btn btn-sm radius-30 px-4" v-if="value.the_loai == 1">Tin
                                        tức
                                        sân</button>
                                </td>
                                <td class="text-center text-nowrap align-middle">

                                    <div class="d-flex order-actions  ">
                                        <a v-on:click="edit_bv(value)" data-bs-toggle="modal"
                                        data-bs-target="#UpdateBaivietModal" ><i class="bx bxs-edit"></i></a>
                                        <a  data-bs-toggle="modal" data-bs-target="#DelBaivietModal"
                                        v-on:click="del = value"  class="ms-3" ><i class="bx bxs-trash "></i></a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="modal fade" id="CreateBaivietModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Thêm Mới Bài Viết</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Tiêu đề bài viết</label>
                                            <input v-model="tieu_de_bai_viet" v-on:keyup="chuyenThanhSlug()"
                                                class="form-control" type="text">
                                        </div>
                                        <div class="col-md-4">
                                            <label>Slug đề bài viết</label>
                                            <input disabled v-model="slug_bai_viet" class="form-control" type="text">
                                        </div>
                                        <div class="col-md-4">
                                            <label>Hình Ảnh</label>
                                            <input v-model="add.hinh_anh_bai_viet" class="form-control" type="text">
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-6">
                                            <label>Thể loại</label>
                                            <select v-model="add.the_loai" class="form-control">
                                                <option value="0">Tin tức thể thao</option>
                                                <option value="1">Tin tức sân</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Trạng Thái</label>
                                            <select v-model="add.trang_thai" class="form-control">
                                                <option value="0">Hiển Thị</option>
                                                <option value="1">Tạm Tắt</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col">
                                            <label>Mô tả ngắn</label>
                                            <textarea v-model="add.mo_ta_ngan_bai_viet" class="form-control" name="" id="" cols="1"
                                                rows="5"></textarea>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col">
                                            <label>Mô tả chi tiết</label>
                                            <textarea class="form-control" name="mo_ta_chi_tiet_bai_viet" id="mo_ta_chi_tiet_bai_viet" cols="1"
                                                rows="5"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm radius-30 px-4"
                                        data-bs-dismiss="modal">Close</button>
                                    <button v-on:click="themMoi()" type="button" class="btn btn-primary btn-sm radius-30 px-4">Thêm
                                        Mới</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="UpdateBaivietModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Cập nhật</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Tiêu đề bài viết</label>
                                            <input v-model="edit.tieu_de_bai_viet" v-on:keyup="chuyenThanhSlug()"
                                                class="form-control" type="text">
                                        </div>
                                        <div class="col-md-4">
                                            <label>Slug đề bài viết</label>
                                            <input disabled v-model="edit.slug_bai_viet" class="form-control"
                                                type="text">
                                        </div>
                                        <div class="col-md-4">
                                            <label>Hình Ảnh</label>
                                            <input v-model="edit.hinh_anh_bai_viet" class="form-control" type="text">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Thể loại</label>
                                            <select v-model="edit.the_loai" class="form-control">
                                                <option value="0">Tin tức thể thao</option>
                                                <option value="1">Tin tức sân</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Trạng Thái</label>
                                            <select v-model="edit.trang_thai" class="form-control">
                                                <option value="0">Hiển thị</option>
                                                <option value="1">Tạm Tắt</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label>Mô tả ngắn</label>
                                            <textarea v-model="edit.mo_ta_ngan_bai_viet" class="form-control" name="" id="" cols="1"
                                                rows="5"></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label>Mô tả chi tiết</label>
                                            <textarea v-html=edit.mo_ta_chi_tiet_bai_viet class="form-control" name="update_mo_ta_chi_tiet"
                                                id="update_mo_ta_chi_tiet" cols="1" rows="5"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm radius-30 px-4"
                                        data-bs-dismiss="modal">Close</button>
                                    <button v-on:click="updateBaiViet()" type="button"class="btn btn-primary btn-sm radius-30 px-4">Cập
                                        nhật</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="DelBaivietModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Xóa</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Bạn muốn xóa bài viết <b class="text-danger">@{{ del.tieu_de_bai_viet }}</b>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm radius-30 px-4"
                                            data-bs-dismiss="modal">Close</button>
                                        <button v-on:click="delBaiViet()" type="button" class="btn btn-primary btn-sm radius-30 px-4">Xóa Bài
                                            Viết</button>
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
                el: '#app',
                data: {
                    add: {},
                    list: [],
                    slug_bai_viet: '',
                    tieu_de_bai_viet: '',
                    edit: {},
                    del: {},
                    key_search: '',
                },
                created() {
                    this.loadData();
                },
                methods: {
                    toSlug(str) {
                        str = str.toLowerCase();
                        str = str
                            .normalize('NFD')
                            .replace(/[\u0300-\u036f]/g, '');
                        str = str.replace(/[đĐ]/g, 'd');
                        str = str.replace(/([^0-9a-z-\s])/g, '');
                        str = str.replace(/(\s+)/g, '-');
                        str = str.replace(/-+/g, '-');
                        str = str.replace(/^-+|-+$/g, '');

                        return str;
                    },
                    search() {
                        var payload = {
                            'key_search': this.key_search
                        }
                        axios
                            .post('/admin/bai-viet/search', payload)
                            .then((res) => {
                                this.list = res.data.list;
                            })
                            .catch((res) => {
                                $.each(res.response.data.errors, function(k, v) {
                                    toastr.error(v[0]);
                                });
                            });
                    },
                    themMoi() {
                        this.add.slug_bai_viet = this.slug_bai_viet;
                        this.add.tieu_de_bai_viet = this.tieu_de_bai_viet;
                        this.add.mo_ta_chi_tiet_bai_viet = CKEDITOR.instances['mo_ta_chi_tiet_bai_viet'].getData(),
                            axios
                            .post('/admin/bai-viet/create', this.add)
                            .then((res) => {
                                if (res.data.status) {
                                    toastr.success(res.data.message);
                                    this.loadData();
                                    $('#CreateBaivietModal').modal('hide');
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
                    loadData() {
                        axios
                            .get('/admin/bai-viet/data')
                            .then((res) => {
                                this.list = res.data.data;
                            });
                    },
                    chuyenThanhSlug() {
                        this.slug_bai_viet = this.toSlug(this.tieu_de_bai_viet);
                    },
                    chuyenThanhSlugEdit() {
                        this.edit.slug_bai_viet = this.toSlug(this.edit.tieu_de_bai_viet);
                    },
                    changeStatus(v) {
                        axios
                            .post('/admin/bai-viet/changestatus', v)
                            .then((res) => {
                                if (res.data.status) {
                                    toastr.success(res.data.message);
                                    this.loadData();
                                }else{
                                    toastr.error(res.data.message);
                                }
                            });
                    },
                    updateBaiViet() {
                        this.edit.mo_ta_chi_tiet_bai_viet = CKEDITOR.instances['update_mo_ta_chi_tiet'].getData();
                        axios
                            .post('/admin/bai-viet/update', this.edit)
                            .then((res) => {
                                if (res.data.status) {
                                    toastr.success(res.data.message);
                                    this.loadData();
                                    $('#UpdateBaivietModal').modal('hide');
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
                    edit_bv(value) {
                        this.edit = Object.assign({}, value);
                        CKEDITOR.instances.update_mo_ta_chi_tiet.setData(this.edit.mo_ta_chi_tiet_bai_viet);
                    },
                    delBaiViet() {
                        axios
                            .post('/admin/bai-viet/delete', this.del)
                            .then((res) => {
                                if (res.data.status == 1) {
                                    toastr.success(res.data.message);
                                    this.loadData();
                                    $('#DelBaivietModal').modal('hide');
                                } else if (res.data.status == 0) {
                                    toastr.error(res.data.message);
                                } else if (res.data.status == 2) {
                                    toastr.warning(res.data.message);
                                }
                            });
                    },
                },
            })
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.19.1/ckeditor.js"></script>
        <script>
            $(document).ready(function() {
                CKEDITOR.replace('mo_ta_chi_tiet_bai_viet');
                CKEDITOR.replace('update_mo_ta_chi_tiet');
            })
        </script>
    @endsection
