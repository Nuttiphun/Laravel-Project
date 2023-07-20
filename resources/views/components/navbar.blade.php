<div class="navbar-headr">
    <a href="/" class="navbar-brand">
        BikeShop
    </a>
</div>

<div class="navbar-collapse collape">
    <ul class="nav navbar-nav">
        <li><a href="/">หน้าแรก</a></li>
        <li><a href="/home">สินค้า</a></li>
        <li><a href="/product/category">ประเภทสินค้า</a></li>
        @guest
        @else
            <li><a href="/order">รายการสั่งซื้อ</a></li>
            <li><a href="/customer">จัดการข้อมูลผู้ใช้</a></li>
            <li><a href="/product">จัดการข้อมูลสินค้า</a></li>
            {{-- <li><a href="#">รายงาน</a></li> --}}
        @endguest
    </ul>
    <ul class="nav navbar-nav navbar-right">
        <li>
            <a href="/cart/view">
                <i class="fa fa-shopping-cart"></i> ตะกร้า
                <span class="cart_total_item label label-danger">
                    {{-- @if (Session::get('cart_items'))
                        {!! count(Session::get('cart_items')) !!}
                    @else 0
                    @endif --}}
                </span>
            </a>
        </li>
        @guest
            <li><a href="{{ route('login') }}">ล็อกอิน</a></li>
            <li><a href="{{ route('register') }}">ลงทะเบียน</a></li>
        @else
            <li><a href="#">{{ Auth::user()->name }}</a></li>
            <li><a class="btnLogout" href="#">ออกจากระบบ </a></li>
            {{-- <li>
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
            </li> --}}
        @endguest
    </ul>

</div>
