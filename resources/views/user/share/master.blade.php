<!doctype html>
<head>
	@include('user.share.css')
    <style>
        .vertical-align-middle {
          vertical-align: middle !important;
        }
      </style>
</head>

<body class="default about_page">
    <div>
        <section class="row top_bar">
            <div class="container">
                <div class="row m0">
                    <div class="fleft schedule"><strong><i class="fa fa-clock-o"></i> Schedule</strong>: Monday - Sunday - 05:00 - 21:00</div>

                    <div class="fright contact_info">
                        <div class="fleft phone" style="margin-right: 10px">
                            @if (Auth::guard('user')->user())
                            <a href="/profile-client"><strong>Chào, {{Auth::guard('user')->user()->ho_va_ten}}</strong></a>
                            @else

                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <nav class="navbar navbar-default navbar-static-top navbar2">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="localhost:8000/schedule"><img src="/assets_user/images/logo/3.png" alt=""></a>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main_nav" aria-expanded="false">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="book-appointment.html" class="navbar-toggle visible-xs" data-toggle="modal" data-target="#appointmefnt_form_pop">Đặt sân</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="main_nav">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="active"><a href="/schedule">Lịch Sân Bóng</a></li>
                        <li class="active"><a href="/danh-sach-san-dat">Danh Sách Sân Đặt</a></li>
                        <li class="active"><a href="/bai-viet">Bài Viêt</a></li>
                        <li class="active"><a href="/lien-he">Liên Hệ</a></li>
                        @if (Auth::guard('user')->user())
                        <li class="active"><a href="/logout">Đăng Xuất</a></li>
                        <li class="hidden-xs book"><a href="#" data-toggle="modal" data-target="#appointmefnt_form_pop">Đặt sân</a></li>
                        @else
                        <li class="hidden-xs book"><a href="/user/register">Đăng Nhập</a></li>
                        @endif
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container -->
        </nav>

        @yield('body')

        <section class="row quick_blocks_row quick_blocks_row2">
            <div class="container">
                <div class="row">

                </div>
            </div>
        </section>

        <section class="row book_banner">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-md-9">
                        <div class="row m0">
                            <h3 class="bannerTitle">ONLINE HASSLE FREE Appointment BOOKING</h3>
                            <h5>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque lacinia, ipsum eu vulputate pulvinar,</h5>
                        </div>
                    </div>
                    <div class="col-sm-4 col-md-3">
                        <div class="row m0">
                            <a href="#appointment" class="view_all">book your appointment</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @yield('modals')
    </div>

    @include('user.share.js')
    @yield('js')
</body>
</html>
