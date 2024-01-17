@extends('user.share.master')
@section('js_top')
<script>
    let bookingData
    axios.get('/pitch-data').then((res) => {
        bookingData = res.data.data
    })
</script>
@endsection
@section('body')
    <section class="row page_intro">
        <div class="row m0 inner">
            <div class="container">
                <div class="row">
                    <h5>service</h5>
                    <h2>football timetable</h2>
                </div>
            </div>
        </div>
    </section>

    <section class="row timetable_row" id="app">
        <div class="container">
            <div class="row">
                <ul class="list-unstyled timeTableFilters" id="sans_filter">
                    @foreach ($sans as $key => $san)
                        <li data-filter="{{$san->slug_ten_san}}" class="{{$key == 0 ? 'active' : ''}}">{{$san->ten_san}}</li>
                    @endforeach
                </ul>
                <div class="row m0 table-responsive">
                    <table class="table timeTable" width="1700px">
                        <thead>
                            <tr>
                                <th width="200px">{{$week}}</th>
                                <th width="250px">Thứ 2</th>
                                <th width="250px">Thứ 3</th>
                                <th width="250px">Thứ 4</th>
                                <th width="250px">Thứ 5</th>
                                <th width="250px">Thứ 6</th>
                                <th width="250px">Thứ 7</th>
                                <th width="250px">Chủ Nhật</th>
                            </tr>
                        </thead>
                        <tbody>
                             <tr id="5to6">
                                <td>05.00 - 06.00</td>
                                <td class="monday cell"></td>
                                <td class="tuesday cell"></td>
                                <td class="wednesday cell"></td>
                                <td class="thusday cell"></td>
                                <td class="friday cell"></td>
                                <td class="saturday cell"></td>
                                <td class="sunday cell"></td>
                            </tr>
                             <tr id="6to7">
                                <td>06.00 - 07.00</td>
                                <td class="monday cell"></td>
                                <td class="tuesday cell"></td>
                                <td class="wednesday cell"></td>
                                <td class="thusday cell"></td>
                                <td class="friday cell"></td>
                                <td class="saturday cell"></td>
                                <td class="sunday cell"></td>
                            </tr>
                            <tr id="7to8">
                                <td>07.00 - 08.00</td>
                                <td class="monday cell"></td>
                                <td class="tuesday cell"></td>
                                <td class="wednesday cell"></td>
                                <td class="thusday cell"></td>
                                <td class="friday cell"></td>
                                <td class="saturday cell"></td>
                                <td class="sunday cell"></td>
                            </tr> <!--Row 1-->
                            <tr id="8to9">
                                <td>08.00 - 09.00</td>
                                <td class="monday cell"></td>
                                <td class="tuesday cell"></td>
                                <td class="wednesday cell"></td>
                                <td class="thusday cell"></td>
                                <td class="friday cell"></td>
                                <td class="saturday cell"></td>
                                <td class="sunday cell"></td>
                            </tr> <!--Row 2-->
                            <tr id="9to10">
                                <td>09.00 - 10.00</td>
                                <td class="monday cell"></td>
                                <td class="tuesday cell"></td>
                                <td class="wednesday cell"></td>
                                <td class="thusday cell"></td>
                                <td class="friday cell"></td>
                                <td class="saturday cell"></td>
                                <td class="sunday cell"></td>
                            </tr> <!--Row 3-->
                            <tr id="10to11">
                                <td>10.00 - 11.00</td>
                                <td class="monday cell"></td>
                                <td class="tuesday cell"></td>
                                <td class="wednesday cell"></td>
                                <td class="thusday cell"></td>
                                <td class="friday cell"></td>
                                <td class="saturday cell"></td>
                                <td class="sunday cell"></td>
                            </tr> <!--Row 4-->
                            <tr id="11to12">
                                <td>11.00 - 12.00</td>
                                <td class="monday cell"></td>
                                <td class="tuesday cell"></td>
                                <td class="wednesday cell"></td>
                                <td class="thusday cell"></td>
                                <td class="friday cell"></td>
                                <td class="saturday cell"></td>
                                <td class="sunday cell"></td>
                            </tr> <!--Row 5-->
                            <tr id="12to13">
                                <td>12.00 - 13.00</td>
                                <td class="monday cell"></td>
                                <td class="tuesday cell"></td>
                                <td class="wednesday cell"></td>
                                <td class="thusday cell"></td>
                                <td class="friday cell"></td>
                                <td class="saturday cell"></td>
                                <td class="sunday cell"></td>
                            </tr> <!--Row 6-->
                            <tr id="13to14">
                                <td>13.00 - 14.00</td>
                                <td class="monday cell"></td>
                                <td class="tuesday cell"></td>
                                <td class="wednesday cell"></td>
                                <td class="thusday cell"></td>
                                <td class="friday cell"></td>
                                <td class="saturday cell"></td>
                                <td class="sunday cell"></td>
                            </tr> <!--Row 7-->
                            <tr id="14to15">
                                <td>14.00 - 15.00</td>
                                <td class="monday cell"></td>
                                <td class="tuesday cell"></td>
                                <td class="wednesday cell"></td>
                                <td class="thusday cell"></td>
                                <td class="friday cell"></td>
                                <td class="saturday cell"></td>
                                <td class="sunday cell"></td>
                            </tr> <!--Row 8-->
                            <tr id="15to16">
                                <td>15.00 - 16.00</td>
                                <td class="monday cell"></td>
                                <td class="tuesday cell"></td>
                                <td class="wednesday cell"></td>
                                <td class="thusday cell"></td>
                                <td class="friday cell"></td>
                                <td class="saturday cell"></td>
                                <td class="sunday cell"></td>
                            </tr> <!--Row 9-->
                            <tr id="16to17">
                                <td>16.00 - 17.00</td>
                                <td class="monday cell"></td>
                                <td class="tuesday cell"></td>
                                <td class="wednesday cell"></td>
                                <td class="thusday cell"></td>
                                <td class="friday cell"></td>
                                <td class="saturday cell"></td>
                                <td class="sunday cell"></td>
                            </tr> <!--Row 10-->
                            <tr id="17to18">
                                <td>17.00 - 18.00</td>
                                <td class="monday cell"></td>
                                <td class="tuesday cell"></td>
                                <td class="wednesday cell"></td>
                                <td class="thusday cell"></td>
                                <td class="friday cell"></td>
                                <td class="saturday cell"></td>
                                <td class="sunday cell"></td>
                            </tr>
                            <tr id="18to19">
                                <td>18.00 - 19.00</td>
                                <td class="monday cell"></td>
                                <td class="tuesday cell"></td>
                                <td class="wednesday cell"></td>
                                <td class="thusday cell"></td>
                                <td class="friday cell"></td>
                                <td class="saturday cell"></td>
                                <td class="sunday cell"></td>
                                {{-- <td rowspan="2" class="cardiac cell">Cardiac Clinic<span class="room">Room:18</span><span class="time_b">11.00 - 15.00</span>Dr. Moxica Nene</td>
                                <td></td>
                                <td rowspan="2" class="cardiac cell">Cardiac Clinic<span class="room">Room:18</span><span class="time_b">11.00 - 15.00</span>Dr. Moxica Nene</td> --}}
                            </tr> <!--Row 13-->
                            <tr id="19to20">
                                <td>19.00 - 20.00</td>
                                <td class="monday cell"></td>
                                <td class="tuesday cell"></td>
                                <td class="wednesday cell"></td>
                                <td class="thusday cell"></td>
                                <td class="friday cell"></td>
                                <td class="saturday cell"></td>
                                <td class="sunday cell"></td>
                            </tr> <!--Row 14-->
                            <tr id="20to21">
                                <td>20.00 - 21.00</td>
                                <td class="monday cell"></td>
                                <td class="tuesday cell"></td>
                                <td class="wednesday cell"></td>
                                <td class="thusday cell"></td>
                                <td class="friday cell"></td>
                                <td class="saturday cell"></td>
                                <td class="sunday cell"></td>
                            </tr> <!--Row 15-->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('modals')
    <div class="modal fade" id="appointmefnt_form_pop" tabindex="-1" role="dialog" aria-labelledby="appointmefnt_form_pop">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="row m0 appointment_home_form2">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-times-circle-o"></i>
                        </button>
                        <h2 class="title">ĐẶT SÂN</h2>
                        <div class="form_inputs row m0">
                            <div class="row m0 input_row">
                                <div class="col-sm-12 col-md-12 col-lg-6 p0">
                                    <label for="app_fname">Họ</label>
                                    <input type="text" class="form-control" id="app_fname" placeholder="Họ" disabled>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6 p0">
                                    <label for="app_lname">Tên</label>
                                    <input type="text" class="form-control" id="app_lname" placeholder="Tên" disabled>
                                </div>
                            </div>

                            <div class="row m0 input_row">
                                <label for="app_phone">Số điện thoại</label>
                                <input type="tel" class="form-control" id="app_phone" placeholder="Số điện thoại" disabled>
                            </div>

                            <div class="row m0 input_row">
                                <label for="pitch_type">Loại sân</label>
                                <select class="form-control" id="pitch_type" placeholder="Chọn loại sân">
                                <option value="0">Chọn Loại Sân</option>
                                @foreach ($loaiSans as $loaiSan)
                                    <option value="{{ $loaiSan['id'] }}">{{ $loaiSan['loai_san'] }}</option>
                                @endforeach
                                </select>
                            </div>

                            <div class="row m0 input_row">
                                <label for="pitch">Sân</label>
                                <select class="form-control mt-1" id="pitch">
                                    <option value="0">Chọn Sân</option>
                                </select>
                            </div>

                            <div class="row m0 input_row">
                                <label for="order_date">Ngày</label>
                                <div class="input-append date">
                                    <input type="text" class="form-control" name="date" id="order_date" placeholder="Chọn ngày">
                                    <span class="add-on"><i class="icon-th"></i></span>
                                </div>
                            </div>

                            <div class="row m0 input_row">
                                <div class="col-sm-12 col-md-12 col-lg-6 p0">
                                    <label for="start_time">Giờ bắt đầu</label>
                                    <input type="time" class="form-control" id="start_time" placeholder="Chọn giờ">
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6 p0">
                                    <label for="end_time">Giờ kết thúc</label>
                                    <input type="time" class="form-control" id="end_time" placeholder="Chọn giờ">
                                </div>
                            </div>
                            <div class="row m0 input_row">
                                <label>Số tiền</label>
                                <input disabled id="dis_money" class="form-control">
                            </div>
                        <button class="form-control" id="submit_dat_san">Đặt sân ngay</button>
                        </div>
                    </div>
            </div>
        </div>
@endsection
@section('js')

<script>
    const pitchs = {!! json_encode($sans->toArray()) !!}
    const loaiSans = {!! json_encode($loaiSans->toArray()) !!}
    const khachHang = {!! auth('user')->user() !!}
    if (khachHang) {
        $('#app_fname').val(khachHang.ho_lot)
        $('#app_lname').val(khachHang.ten)
        $('#app_phone').val(khachHang.so_dien_thoai)
    }
    const firstActivePitch = pitchs[0]
</script>
<script>
    $(document).ready(function() {
        const datSanForm = {
            'gio_ket_thuc': undefined,
            'so_tien': undefined,
            'gio_bat_dau': undefined,
            'id_san' : undefined,
        }
        if (khachHang) {
            datSanForm.id_khach_hang = khachHang.id
        }
        // console.log(pitchs,loaiSans)
        function number_format(number, decimals = 0, dec_point = ",", thousands_sep = ".") {
            var n = number;
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
        }
        var tableCell = $(".cell");

        function clearTable() {
            tableCell.empty()
            tableCell.removeAttr('style')
        }

        $(".timeTableFilters").on("click", "li", function () {
            $(".active").removeClass("active");
            $(this).addClass("active");
            clearTable()
            loadTable( $(this).attr("data-filter"))
        });

        function loadTable(san_slug){
            // Time table data
            const pitchData = bookingData[san_slug]
            console.log(pitchData)
            if(pitchData == undefined) {
                clearTable()
                return 0;
            }
            $.each(pitchData, (k, item) => {
                day = item.day
                time_id = item.time_id
                time_span = item.time_span
                slug_ten_san = item.slug_ten_san
                ten_san = item.ten_san
                tinh_trang = item.tinh_trang_thue
                loai_san = item.loai_san
                let color = '#43b9f6'
                let extra_text = 'Đã đặt trước'
                if (tinh_trang === 1) {
                    color = '#fe824c'
                    extra_text = 'Đang hoạt động'
                } else  if (tinh_trang === 2) {
                    color = '#808080'
                    extra_text = 'Đã kết thúc'
                }
                var a = $('#'+ time_id + ' .' + day)
                .text(ten_san)
                .attr('style', 'background: ' + color)
                .attr('rowspan', time_span)
                .attr('data-san', slug_ten_san)
                .attr('data-time-id', time_id)
                .attr('id', slug_ten_san + '-' + time_id)
                .append(`<span class="room">${loai_san}</span> <span class="time_b">${extra_text}</span>`)
            })
        }
        loadTable(firstActivePitch.slug_ten_san)

        $("#pitch_type").on("change", () => {
            const loai_san_id = $("#pitch_type").val()
            datSanForm.loai_san_id = loai_san_id
            datSanForm.id_san = undefined
            datSanForm.ngay = undefined
            html = '';
            $.each(pitchs , (key, pitch) => {
                if(pitch.id_loai_san == loai_san_id){
                    html+= `<option value="${pitch.id}">${ pitch.ten_san }</option>`
                }
           })
            $("#pitch").append(html)
        })

        $("#pitch").on("change", () => {
            const idSan = $("#pitch").val()
            datSanForm.id_san = idSan
            let money = 0
            if (idSan != 0) {
                money = pitchs.find((element) => element.id == idSan).tien_goc
                datSanForm.so_tien = money
                datSanForm.tien_goc = money
            }
            $("#dis_money").val(number_format(money) + "VNĐ")
        })

        $("#order_date").on("change", () => {
            datSanForm.ngay = $("#order_date").val()
        })

        function setMoney() {
            if(datSanForm.gio_bat_dau !== undefined && datSanForm.gio_ket_thuc !== undefined && datSanForm.so_tien != undefined) {
                const startHour = datSanForm.gio_bat_dau.split(':')[0];
                const endHour = datSanForm.gio_ket_thuc.split(':')[0];
                const duration = endHour - startHour

                if (duration <= 0) {
                    toastr.error('Giờ chọn không đúng, vui lòng chọn lại')
                    datSanForm.gio_bat_dau = undefined
                    datSanForm.gio_ket_thuc = undefined
                    datSanForm.so_tien = datSanForm.tien_goc
                    $("#end_time").val(null)
                    $("#start_time").val(null)
                    return 0;
                } else {
                    const tien = datSanForm.tien_goc * datSanForm.extra_fee * duration
                    datSanForm.so_tien = tien
                    $('#dis_money').val(number_format(tien) + "VNĐ")
                }
            }
        }


        $("#start_time").on("change", () => {
            if (datSanForm.gio_ket_thuc !== undefined) {
                datSanForm.gio_ket_thuc = undefined
                datSanForm.so_tien = datSanForm.tien_goc
            }
            time = $("#start_time").val()
            const hour = time.split(':')[0];
            const convertedTime = `${hour}:00`;
            $("#start_time").val(convertedTime)
            datSanForm.gio_bat_dau = convertedTime
            axios
                .get('/admin/san/extra-fee?time='+ datSanForm.gio_bat_dau)
                .then((res) => {
                    datSanForm.extra_fee =  res.data.extra_fee
                })
        })

        $("#end_time").on("change", () => {
            time = $("#end_time").val()
            const hour = time.split(':')[0];
            const convertedTime = `${hour}:00`;
            datSanForm.gio_ket_thuc = convertedTime
            $("#end_time").val(convertedTime)
            setMoney()
        })
        function checkFormData() {
            if(datSanForm.id_san == undefined ||
            datSanForm.ngay == undefined ||
            datSanForm.gio_bat_dau == undefined ||
            datSanForm.gio_ket_thuc == undefined ||
            datSanForm.so_tien == undefined ||
            datSanForm.id_khach_hang == undefined) return 0
            return 1
        }
        $("#submit_dat_san").on("click", () => {
            if(checkFormData()){
                datSanForm.gio_bat_dau = datSanForm.ngay + " " + datSanForm.gio_bat_dau
                datSanForm.gio_ket_thuc = datSanForm.ngay + " " + datSanForm.gio_ket_thuc
                axios.post('/dat-san', datSanForm)
                .then((res) => {
                    if(res.data.status){
                        toastr.success(res.data.message)
                    }
                    const {data, message} = res.data
                    const {id_hoa_don, so_tien_thanh_toan_truoc} = data
                    localStorage.setItem("a", message)
                    setTimeout(() => {
                        window.location.href = "/danh-sach-san-dat" // Làm ở đây nha Huy
                    }, 1000);
                }).catch((res) => {
                    $.each(res.response.data.errors, function(k, v) {
                        toastr.error(v[0], 'Error');
                    });
                });
            }
            toastr.error("Không được để trống")
        })
    });
</script>
@endsection
