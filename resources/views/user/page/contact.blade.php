@extends('user.share.master')
@section('body')
<div id="app">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <img src="/assets_user/images/slider/homepage1/everyday.png" style="height: 450px; width: 1150px;">
            </div>
        </div>
    </div>
    <section class="row contact_form_row">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 contact_form_area">
                    <h3 class="contact_section_title">Liên Hệ Chúng Tôi</h3>
                    <div class="contactForm row m0">
                        <div class="row contact_form">
                            <div class="row m0">
                                <div class="col-sm-12">
                                    <div class="input-group">
                                        <label for="contact_fname">Họ và tên</label>
                                        <input type="text" v-model="add.ho_va_ten" class="form-control" name="contact_fname">
                                    </div>
                                    <div class="input-group">
                                        <label for="contact_femail">E-mail</label>
                                        <input type="email" v-model="add.email" class="form-control" name="contact_femail">
                                    </div>
                                    <div class="input-group">
                                        <label for="contact_fphone">Số Điện Thoại</label>
                                        <input type="tel" v-model="add.so_dien_thoai" class="form-control" name="contact_fphone">
                                    </div>
                                </div>
                            </div>
                            <div class="row m0">
                                <div class="col-sm-12">
                                    <label for="contact_fmsg">Nội Dung</label>
                                    <textarea name="contact_fmsg" v-model="add.noi_dung" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="row m0">
                                <div class="col-sm-12">
                                   <button class="submit_btn" v-on:click="guiLienHe()">Gửi</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 contact_address">
                    <h3 class="contact_section_title">Địa Chỉ</h3>
                    <div class="row address m0">
                        <div class="media address_line">
                            <div class="media-left icon"><i class="fa fa-map-marker"></i></div>
                            <div class="media-body address_text">09 Hùng Vương, Thành Phố Đà Nẵng</div>
                        </div>
                        <div class="media address_line">
                            <div class="media-left icon"><i class="fa fa-envelope"></i></div>
                            <div class="media-body address_text">quanlysanbong@gmail.com</div>
                        </div>
                        <div class="media address_line">
                            <div class="media-left icon"><i class="fa fa-phone"></i></div>
                            <div class="media-body address_text">0889470271</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@section('js')
<script>
    new Vue({
        el      :   '#app',
        data    :   {
            add : {}
        },
        created()   {

        },
        methods :   {
            guiLienHe(){
                axios
                    .post('/send-lien-he', this.add)
                    .then((res) => {
                        if(res.data.status){
                            toastr.success(res.data.message)
                            this.add = {}
                        }
                    })
                    .catch((res) => {
                        $.each(res.response.data.errors, function(k, v) {
                            toastr.error(v[0], 'Error');
                        });
                    });
            }
        },
    });
</script>
@endsection
