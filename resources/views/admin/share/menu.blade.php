<div class="sidebar-wrapper" data-simplebar="true" >
    <div class="sidebar-header">
        <div>
            <img src="/assets_admin/images/logo-icon.png" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <a class="logo-text" href="/admin/thong-ke">Rocker</a>

        </div>
        {{-- <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div> --}}
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        @if (Auth::guard('admin')->user()->id_quyen == 1)
            {{-- Quản Lý Sân --}}
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="fa-solid fa-futbol"></i>
                    </div>
                    <div class="menu-title">Quản Lý Sân</div>
                </a>
                <ul>
                    <li> <a href="/admin/khu-vuc"><i class="bx bx-right-arrow-alt"></i>Khu Vực</a>
                    </li>
                    <li> <a href="/admin/loai-san"><i class="bx bx-right-arrow-alt"></i>Loại Sân</a>
                    </li>
                    <li> <a href="/admin/san"><i class="bx bx-right-arrow-alt"></i>Sân</a>
                    </li>
                    <li> <a href="/admin/san/danh-sach-san"><i class="bx bx-right-arrow-alt"></i>Mở Sân</a>
                    </li>
                </ul>
            </li>
            {{-- Khách Hàng --}}
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="fa-solid fa-users"></i>
                    </div>
                    <div class="menu-title">Khách Hàng</div>
                </a>
                <ul>
                    <li> <a href="/admin/loai-khach-hang"><i class="bx bx-right-arrow-alt"></i>Loại Khách Hàng</a>
                    </li>
                    <li> <a href="/admin/khach-hang"><i class="bx bx-right-arrow-alt"></i>Khách Hàng</a>
                    </li>
                </ul>
            </li>
            {{-- Tài Khoản Admin --}}
            <li>
                <a href="/admin/tai-khoan" >
                    <div class="parent-icon"><i class="fa-solid fa-user"></i>
                    </div>
                    <div class="menu-title">Tài Khoản Admin</div>
                </a>
            </li>
            {{-- Nhà Cung Cấp --}}
            <li>
                <a href="/admin/nha-cung-cap" >
                    <div class="parent-icon"><i class="fa-solid fa-truck-field-un"></i>
                    </div>
                    <div class="menu-title">Nhà Cung Cấp</div>
                </a>

            </li>
            {{-- Hàng Hóa --}}
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="fa-solid fa-store"></i>
                    </div>
                    <div class="menu-title">Hàng Hóa</div>
                </a>
                <ul>
                    <li> <a href="/admin/nhap-hang"><i class="bx bx-right-arrow-alt"></i>Nhập Hàng</a>
                    </li>
                    <li> <a href="/admin/loai-hang-hoa"><i class="bx bx-right-arrow-alt"></i>Loại Hàng</a>
                    </li>
                    <li> <a href="/admin/hang-hoa"><i class="bx bx-right-arrow-alt"></i>Danh Sách Hàng Hóa</a>
                    </li>

                </ul>
            </li>
            {{-- Giao Dịch --}}
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="fa-sharp fa-solid fa-tent-arrow-left-right"></i>
                    </div>
                    <div class="menu-title">Quản Lý Hóa Đơn</div>
                </a>
                <ul>

                    <li> <a href="/admin/hoa-don-nhap-hang"><i class="bx bx-right-arrow-alt"></i>Hóa Đơn Nhập Hàng</a>
                    </li>
                    <li> <a href="/admin/hoa-don-ban"><i class="bx bx-right-arrow-alt"></i>Hóa Đơn Dịch Vụ</a>
                        <li> <a href="/admin/san/hoa-don-thue-san"><i class="bx bx-right-arrow-alt"></i>Hóa Đơn Thuê Sân</a>
                    </li>
                </ul>
            </li>
            {{-- Dịch Vụ --}}
            <li>
                <a href="/admin/dich-vu" >
                    <div class="parent-icon"><i class="fa-brands fa-dyalog"></i>
                    </div>
                    <div class="menu-title">Dịch Vụ</div>
                </a>

            </li>

            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="fa-sharp fa-solid fa-tent-arrow-left-right"></i>
                    </div>
                    <div class="menu-title">Giải Đấu</div>
                </a>
                <ul>
                    <li> <a href="/admin/giai-dau"><i class="bx bx-right-arrow-alt"></i>Danh Sách Giải Đấu</a>
                    </li>
                </ul>
            </li>
            {{-- cài đặt chung --}}
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="fa-sharp fa-solid fa-tent-arrow-left-right"></i>
                    </div>
                    <div class="menu-title">Quản Lý Chung</div>
                </a>
                <ul>
                    <li> <a href="/admin/log"><i class="bx bx-right-arrow-alt"></i>Log</a></li>
                    <li> <a href="/admin/quyen"><i class="bx bx-right-arrow-alt"></i>Phân Quyền</a></li>
                    <li> <a href="/admin/bai-viet"><i class="bx bx-right-arrow-alt"></i>Bài Viết</a></li>
                </ul>
            </li>
        @else
            <li>
                <a href="/admin/san/danh-sach-san" >
                    <div class="parent-icon"><i class="fa-regular fa-futbol"></i>
                    </div>
                    <div class="menu-title">Mở Sân</div>
                </a>
            </li>
            <li>
                <a href="/admin/khach-hang" >
                    <div class="parent-icon"><i class="fa-solid fa-user"></i>
                    </div>
                    <div class="menu-title">Khách Hàng</div>
                </a>
            </li>
            <li>
                <a href="/admin/nhap-hang" >
                    <div class="parent-icon"><i class="fa-solid fa-store"></i>
                    </div>
                    <div class="menu-title">Nhập Hàng</div>
                </a>
            </li>
            <li>
                <a href="/admin/dich-vu" >
                    <div class="parent-icon"><i class="fa-brands fa-dyalog"></i>
                    </div>
                    <div class="menu-title">Dịch Vụ</div>
                </a>
            </li>
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="fa-sharp fa-solid fa-tent-arrow-left-right"></i>
                    </div>
                    <div class="menu-title">Giao Dịch</div>
                </a>
                <ul>

                    <li> <a href="/admin/hoa-don-nhap-hang"><i class="bx bx-right-arrow-alt"></i>Hóa Đơn Nhập Hàng</a>
                    </li>
                    <li> <a href="/admin/hoa-don-ban"><i class="bx bx-right-arrow-alt"></i>Hóa Đơn Bán</a>
                        <li> <a href="/admin/san/hoa-don-thue-san"><i class="bx bx-right-arrow-alt"></i>Hóa Đơn Thuê Sân</a>
                    </li>
                </ul>
            </li>
        @endif

    </ul>
    <!--end navigation-->
</div>
