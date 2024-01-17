@extends('user.share.master')
@section('body')

<section class="row contact_form_row">
    <div class="container" id="app">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#home">Thông tin tài khoản</a></li>
            <li><a data-toggle="tab" href="#password">Đổi mật khẩu</a></li>
          </ul>
          <div class="tab-content">
            <div id="home" class="tab-pane fade in active">
                <div class="row" style="margin-top: 15px">
                    <div class="col-sm-12 contact_form_area">
                        <h3 class="contact_section_title">Thông Tin Tài Khoản</h3>
                        <div class="contactForm row m0">
                            <form class="row contact_form">
                                <div class="row m0">
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <label for="contact_fname">Họ và tên</label>
                                            <input type="text" v-model="add.ho_va_ten" class="form-control">
                                        </div>

                                    </div>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <label for="contact_femail">Email</label>
                                            <input disabled type="email" v-model="add.email" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <label for="contact_lname">Địa Chỉ</label>
                                            <input type="text" v-model="add.dia_chi" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <label for="contact_fphone">Số điện thoại</label>
                                            <input type="number" v-model="add.so_dien_thoai" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row m0">
                                    <div class="col-sm-12 text-right">
                                        <input type="button" v-on:click="updateProfileClient()" class="submit_btn" value="Lưu">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div id="password" class="tab-pane fade">
                <div class="row" style="margin-top: 15px">
                    <div class="col-sm-12 contact_form_area">
                        <h3 class="contact_section_title">Đổi mật khẩu</h3>
                        <div class="contactForm row m0">
                            <form class="row contact_form">
                                <div class="row m0">
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <label for="contact_fname">Nhập mật khẩu mới</label>
                                            <input type="text" v-model="add.password" class="form-control">
                                        </div>
                                        <div class="input-group">
                                            <label for="contact_fname">Nhập lại mật khẩu mới</label>
                                            <input type="text" v-model="add.re_password" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row m0">
                                    <div class="col-sm-12 text-right">
                                        <input type="button" v-on:click="updateProfileClient()" class="submit_btn" value="Lưu">
                                    </div>
                                </div>
                            </form>
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
            add : {
                'id'        : '{{$user->id}}',
                'ho_va_ten' : '{{$user->ho_va_ten}}',
                'email' : '{{$user->email}}',
                'dia_chi' : '{{$user->dia_chi}}',
                'so_dien_thoai' : '{{$user->so_dien_thoai}}'
            }
        },
        created()   {

        },
        methods :   {
            updateProfileClient(){
                axios
                    .post('/update-profile-client', this.add)
                    .then((res) => {
                        if(res.data.status){
                            toastr.success(res.data.message);
                            setTimeout(() => {
                                location.reload();
                            }, 800);
                        }
                    })
                    .catch((res) => {
                        $.each(res.response.data.errors, function(k, v) {
                            toastr.error(v[0], 'Error');
                        });
                    });
            },
        },
    });
</script>
@endsection
