@extends('user.share.master')
@section('body')
<section class="row contact_form_row">
    <div class="container" id="app">
        <div class="row">
            <div class="col-sm-6 contact_form_area">
                <h3 class="contact_section_title">Đăng Ký</h3>
                <div class="contactForm row m0">
                    <div class="row contact_form">
                        <div class="row m0">
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <label for="contact_fname">Họ</label>
                                    <input type="text" v-model="add.ho_lot" class="form-control">
                                </div>
                                <div class="input-group">
                                    <label for="contact_femail">Email</label>
                                    <input type="email" v-model="add.email" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <label for="contact_lname">Tên</label>
                                    <input type="text" v-model="add.ten" class="form-control">
                                </div>
                                <div class="input-group">
                                    <label for="contact_fphone">Số Điện Thoại</label>
                                    <input type="tel" v-model="add.so_dien_thoai" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row m0">
                            <div class="col-sm-4">
                                <label for="contact_lname">Giới tính</label>
                                <div class="row m0">
                                     <div class="col-sm-12">
                                        <div class="col-sm-4">
                                            <input type="radio" id="nu" v-model="add.gioi_tinh" name="gender" value="0" class="form-control">
                                        </div>
                                        <div class="col-sm-7">
                                            <label for="nu">Nữ</label>
                                        </div>
                                     </div>
                                     <div class="col-sm-12">
                                        <div class="col-sm-4">
                                            <input type="radio" id="nam" v-model="add.gioi_tinh" name="gender" value="1"class="form-control">
                                        </div>
                                        <div class="col-sm-7">
                                            <label for="nam">Nam</label>
                                        </div>
                                     </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label for="contact_fphone">Nhập Lại Mật Khẩu</label>
                                <input type="password" v-model="add.re_password" class="form-control">
                            </div>
                            <div class="col-sm-4">
                                <label for="contact_lname">Mật Khẩu</label>
                                <input type="password" v-model="add.password" class="form-control">
                            </div>
                            <div class="col-sm-12" style="margin-top: 15px">
                                <label for="contact_fmsg">Địa Chỉ</label>
                                <textarea v-model="add.dia_chi" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="row m0">
                            <div class="col-sm-12 text-right">
                                <button v-on:click="dangKy()" class="submit_btn">Đăng Ký</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-sm-6 contact_form_area">
                <h3 class="contact_section_title">Đăng Nhập</h3>
                <div class="contactForm row m0">
                    <div class="row contact_form">
                        <div class="row m0">
                            <div class="col-sm-12">
                                <label for="contact_fmsg">Email</label>
                                <input v-on:keyup.enter="dangNhap()" type="email" v-model="login.email" class="form-control">
                            </div>
                            <div class="col-sm-12" style="margin-top: 15px">
                                <label for="contact_fmsg">Mật Khẩu</label>
                                <input v-on:keyup.enter="dangNhap()" type="password" v-model="login.password" class="form-control">
                            </div>
                        </div>
                        <div class="row m0">
                            <div class="col-sm-12 text-right">
                                <button v-on:click="dangNhap()" class="submit_btn">Đăng Nhập</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('js')
<script>
    new Vue({
        el      :   '#app',
        data    :   {
            add : {},
            login : {}
        },
        created()   {

        },
        methods :   {
            dangKy(){
                console.log(this.add)
                axios
                    .post('/user/action-dang-ky', this.add)
                    .then((res) => {
                        if(res.data.status){
                            toastr.success(res.data.message);
                            this.add = {};
                        }
                    })
                    .catch((res) => {
                        $.each(res.response.data.errors, function(k, v) {
                            toastr.error(v[0], 'Error');
                        });
                    });
            },

            dangNhap(){
                axios
                    .post('/user/action-dang-nhap', this.login)
                    .then((res) => {
                        if(res.data.status == 1){
                            toastr.success(res.data.message);
                            setTimeout(() => {
                                window.location.href = '/schedule';
                            }, 1000);
                        }else if(res.data.status == 2){
                            toastr.warning(res.data.message);
                        }else{
                            toastr.error(res.data.message);
                        }
                    })
                    .catch((res) => {
                        toastr.error(res.response.data.message);
                    });
            }
        },
    });
</script>
@endsection
