<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
    <style>
        #invoice-POS {
            box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
            padding: 2mm;
            margin: 0 auto;
            width: 50mm;
            background: #FFF;
        }

        h1 {
            font-size: 1.5em;
            color: #222;
        }

        h2 {
            font-size: .9em;
        }

        h3 {
            font-size: 1.2em;
            font-weight: 300;
            line-height: 2em;
        }

        p {
            font-size: .7em;
            color: #666;
            line-height: 1.2em;
        }

        #top,
        #mid,
        #bot {
            /* Targets all id with 'col-' */
            border-bottom: 1px solid #EEE;
        }

        #top {
            min-height: 100px;
        }

        #mid {
            min-height: 30px;
        }

        #bot {
            min-height: 50px;
        }

        #top .logo {
            //float: left;
            height: 60px;
            width: 60px;
            background: url(/logo-img.png) no-repeat;
            background-size: 60px 60px;
        }

        .clientlogo {
            float: left;
            height: 60px;
            width: 60px;
            background: url(/logo-img.png) no-repeat;
            background-size: 60px 60px;
            border-radius: 50px;
        }

        .info {
            display: block;
            //float:left;
            margin-left: 0;
        }

        .title {
            float: right;
        }

        .title p {
            text-align: right;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            //padding: 5px 0 5px 15px;
            //border: 1px solid #EEE;
        }

        .tabletitle {
            font-size: .5em;
            background: #EEE;
        }

        .service {
            border-bottom: 1px solid #EEE;
        }

        .item {
            width: 24mm;
        }

        .itemtext {
            font-size: .5em;
            height: 2px;
        }

        #legalcopy {
            margin-top: 5mm;
        }

        }
    </style>
</head>

<body>

    <div id="invoice-POS">

        <center id="top">
            <div class="logo"></div>
            <div class="info">
                <h2>Quản Lý Sân Bóng</h2>
            </div>
            <!--End Info-->
        </center>
        <!--End InvoiceTop-->

        <div id="mid">
            <div class="info">
                <h2 class="text-center mt-3">{{$thanhToan}}</h3>
                    {{-- <p style="15px">
                        Địa Chỉ : Đà Nẵng</br>
                        Email : admin@gmail.com</br>
                        Số Điện Thoại   : 0345884657</br>
                    </p> --}}
            </div>
        </div>
        <!--End Invoice Mid-->

        <div id="bot">
            <div id="table">
                <table>
                    <tr class="tabletitle">
                        <td class="item">
                            <h2>Tên</h2>
                        </td>
                        <td class="item">
                            <h2>SL</h2>
                        </td>
                        <td class="item">
                            <h2>ĐG</h2>
                        </td>

                        <td class="Rate">
                            <h2>TT</h2>
                        </td>
                    </tr>
                    <tr class="service">
                        <td class="tableitem">
                            <p class="itemtext text-nowrap">{{ $hoaDonThueSan->ten_san }}</p>
                        </td>
                        <td class="tableitem">
                            <p class="itemtext text-nowrap">{{ $hoaDonThueSan->so_phut_thue }} phút</p>
                        </td>
                        <td class="tableitem">
                            <p class="itemtext text-nowrap">{{  number_format($hoaDonThueSan->so_tien) }} đ</p>
                        </td>

                        <td class="tableitem">
                            <p class="itemtext text-nowrap">{{ number_format($hoaDonThueSan->so_tien , 0)}} đ</p>
                        </td>
                    </tr>
                    @foreach ($chiTietHoaDonDichVu as $key => $value)
                    <tr class="service">
                        <td class="tableitem">
                            <p class="itemtext text-nowrap">{{ $value->ten_hang }}</p>
                        </td>
                        <td class="tableitem">
                            <p class="itemtext text-nowrap">{{ $value->so_luong_ban }}</p>
                        </td>
                        <td class="tableitem">
                            <p class="itemtext text-nowrap">{{  number_format($value->don_gia_ban) }} đ</p>
                        </td>

                        <td class="tableitem">
                            <p class="itemtext text-nowrap">{{ number_format($value->thanh_tien , 0)}} đ</p>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
            <!--End Table-->
            <div id="legalcopy">
                <div>
                    <table>
                        <tr class="service">
                            <td class="tableitem">
                                <p class="itemtext text-nowrap">Tổng tiền</p>
                            </td>
                            <td class="tableitem">
                                <p class="itemtext text-nowrap">{{number_format($tong_tien)}} đ</p>
                            </td>
                        </tr>
                        <tr class="service">
                            <td class="tableitem">
                                <p class="itemtext text-nowrap">Phần trăm giảm</p>
                            </td>
                            <td class="tableitem">
                                <p class="itemtext text-nowrap">{{ $phanTramGiam }}%</p>
                            </td>
                        </tr>
                        <tr class="service">
                            <td class="tableitem">
                                <p class="itemtext text-nowrap">Tiền trả trước</p>
                            </td>
                            <td class="tableitem">
                                <p class="itemtext text-nowrap">{{number_format($tien_tra_truoc)}} đ</p>
                            </td>
                        </tr>
                        <tr class="service">
                            <td class="tableitem">
                                <p class="itemtext text-nowrap">Tiền phải trả</p>
                            </td>
                            <td class="tableitem">
                                <p class="itemtext text-nowrap">{{number_format($tien_da_giam)}} đ</p>
                            </td>
                        </tr>
                        {{-- <tr class="service">
                            <td class="tableitem">
                                <p class="itemtext text-nowrap">Giảm Giá</p>
                            </td>
                            <td class="tableitem">
                                <p class="itemtext text-nowrap">123123</p>
                            </td>
                        </tr> --}}
                        <tr class="service">
                            <td class="tableitem">
                                <p class="itemtext">Thực thu</p>
                            </td>
                            <td class="tableitem">
                                <p class="itemtext">{{ number_format($tien_da_giam, 0) }} đ <span><i>({{ $tt_chu }})</i></span></p>
                            </td>
                        </tr>
                    </table>
                </div>
                <p class="legal text-center mt-3"><strong>Cảm Ơn Quý Khách</strong> </p>
                <p class="text-center mt-3" > Địa Chỉ : Đà Nẵng</br>
                    Email : admin@gmail.com</br>
                    Số Điện Thoại   : 0345884657</br>
                </p>
            </div>

        </div>
        <!--End InvoiceBot-->
    </div>
    <!--End Invoice-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>
