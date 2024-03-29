@extends('admin.share.master')
@section('noi_dung')
<div class="row" id="app">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-column align-items-center text-center">
                    @php
                        $user = Auth::guard('admin')->user();
                    @endphp
                    <img src="{{ $user->anh_dai_dien != null ? $user->anh_dai_dien :  "/assets/images/avatars/avatar-2.png" }}" alt="Admin" class="rounded-circle p-1 bg-primary" width="300px" height="300px">
                    <div class="mt-3">
                        <h4>{{ $user ? $user->ho_va_ten : "Chưa Có Tên" }}</h4>
                        {{-- <p class="text-secondary mb-1">adasdas</p>
                        <p class="text-muted font-size-sm">ádasds</p> --}}
                    </div>
                </div>
                <hr class="my-4" />
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h6>Thông tin Cá Nhân</h6>
            </div>
            <div class="card-body">
                <form id="updateProfilee">
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Họ Và Tên</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <input type="text" class="form-control" name="ho_va_ten" placeholder="Nhập họ và tên" v-model="user.ho_va_ten"/>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Email</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <input type="text" class="form-control" placeholder="Nhập vào Email" name="email" v-model="user.email" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Số Điện Thoại</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <input type="text" class="form-control" placeholder="Nhập vào số điện thoại" name="so_dien_thoai" v-model="user.so_dien_thoai"/>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Ngày Sinh</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <input type="date" class="form-control" name="ngay_sinh" v-model="user.ngay_sinh"/>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Địa Chỉ</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <input type="text" class="form-control" name="dia_chi" v-model="user.dia_chi"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-9 text-secondary">
                            <button class="btn btn-primary btn-sm radius-30 px-4" type="submit" v-on:click="updateProfile($event)">Lưu Thông Tin</button>
                        </div>
                    </div>
                </form>

                <hr class="my-4" />
                <div class="row mb-4 text-center">
                    <div class="col-sm-3">
                        <h5 class="mb-0 text-nowrap">Thay Đổi Mật Khẩu</h5>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Mật Khẩu Mới</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <input type="password" class="form-control" name="password" v-model="password_new.password" placeholder="Nhập vào mật khẩu của bạn"/>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Nhập Lại Mật Khẩu Mới</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <input type="password" class="form-control" name="re_password" v-model="password_new.re_password" placeholder="Nhập vào mật khẩu của bạn"/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-9 text-secondary">
                        <button class="btn btn-primary btn-sm radius-30 px-4" v-on:click="changePassWord()">Lưu Mật Khẩu</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    var user = <?php echo json_encode($user); ?>;
    new Vue({
        el      :  '#app',
        data    :  {
            user                : user,
            password_new        : {},
        },
        created() {

        },
        methods :   {
            date_format(now) {
                return moment(now).format('DD/MM/yyyy');
            },
            number_format(number, decimals = 2, dec_point = ",", thousands_sep = ".") {
                var n = number,
                c = isNaN((decimals = Math.abs(decimals))) ? 2 : decimals;
                var d = dec_point == undefined ? "," : dec_point;
                var t = thousands_sep == undefined ? "." : thousands_sep,
                    s = n < 0 ? "-" : "";
                var i = parseInt((n = Math.abs(+n || 0).toFixed(c))) + "",
                    j = (j = i.length) > 3 ? j % 3 : 0;

                return (s +(j ? i.substr(0, j) + t : "") +i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) +(c? d +
                        Math.abs(n - i)
                            .toFixed(c)
                            .slice(2)
                        : "")
                );
            },

            updateProfile(e) {
                e.preventDefault();
                var paramObj = {};
                    $.each($('#updateProfilee').serializeArray(), function(_, kv) {
                        if (paramObj.hasOwnProperty(kv.name)) {
                            paramObj[kv.name] = $.makeArray(paramObj[kv.name]);
                            paramObj[kv.name].push(kv.value);
                        } else {
                            paramObj[kv.name] = kv.value;
                        }
                    });

                axios
                    .post('/admin/tai-khoan/update-thong-tin-ca-nhan', paramObj)
                    .then((res) => {
                        if (res.data.status) {
                            toastr.success(res.data.message);
                        }
                    })
                    .catch((res) => {
                        $.each(res.response.data.errors, function(k, v) {
                            toastr.error(v[0]);
                        });
                    });
            },

            changePassWord() {
                this.password_new.id = this.user.id;
                axios
                    .post('/admin/tai-khoan/change-password-profile', this.password_new)
                    .then((res) => {
                        if (res.data.status) {
                            toastr.success(res.data.message);
                        }
                    })
                    .catch((res) => {
                        $.each(res.response.data.errors, function(k, v) {
                            toastr.error(v[0]);
                        });
                    });
            }


        }
    });
</script>
@endsection
