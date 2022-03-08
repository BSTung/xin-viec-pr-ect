<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">

<style>
    .navi ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
        background-color: #26E4D6;
    }

    .navi li {
        float: left;
    }

    .navi li a {
        display: block;
        color: white;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
    }

    .navi li a:hover:not(.active) {
        background-color: #111;
    }

    .navi .active {
        background-color: #266EE4;
    }
</style>

<!--<section class="top-header desktop">
    <div class="container">
        <div class="content">
            <div class="left">
                <a href="" title="Chăm sóc khách hàng" rel="nofollow">Chăm sóc khách hàng</a>
            </div>
            <div class="right">
                @if (Auth::check())
                    <a href="">Xin chào {{ Auth::user()->name }}</a>
                    <a href="">Quản lý tài khoản</a>
                    <a href="">Đăng xuất </a>
                @else
                    <a href="">Đăng ký</a>
                    <a href="">Đăng nhập</a>
                @endif
            </div>
        </div>
    </div>
</section>-->

<!--<section class="top-header mobile">
    <div class="container">
        <div class="content">
            <div class="left">
                <a href="" title="Chăm sóc khách hàng" rel="nofollow">Chăm sóc khách hàng</a>
                @if (Auth::check())
                    <a href="">Xin chào {{ Auth::user()->name }}</a>
                    <a href="">Quản lý tài khoản</a>
                    <a href="{{  route('get.logout') }}">Đăng xuất </a>
                @else
                    <a href="">Đăng ký</a>
                    <a href="">Đăng nhập</a>
                @endif
            </div>
        </div>
    </div>
</section>-->

<div class="commonTop">
    <div id="headers">
        <div class="container header-wrapper">
            <!--Thay đổi-->
            <div class="logo">
                <a href="" class="desktop">
                    <img src="" style="height: 45px; width: 65px;" alt="Home">
                </a>
                <a href="" class="mobile">
                    <img src="" style="height: 30px; width: 30px;" alt="Home">
                </a>
                <li>
                    <span class="menu js-menu-cate"><i class="la la-list-ul"></i> </span>
                </li>
            </div>
            <div>

            </div>
            <div class="search">

                <form action="{{ $link_search ?? route('get.product.list',['k' => Request::get('k')]) }}" role="search" method="GET">
                    <input type="text" name="k" value="{{ Request::get('k') }}" class="form-control" placeholder="Tìm kiếm sản phẩm ...">
                    <button type="submit" class="btnSearch">
                        <i class="la la-search"></i>
                        <span>Tìm kiếm</span>
                    </button>
                </form>

            </div>
            <ul class="right">
                <li>
                    <!--<a href="" title="Giỏ hàng">
                        <i class="la la-shopping-cart"></i>
                        <span class="text">
                            <span class="">Giỏ hàng ()</span>
                            <span></span>
                        </span>
                    </a>-->
                </li>
                <li class="desktop">
                    <a href="tel:0337857855" title="">
                        <i class="la la-phone"></i>
                        <span class="text">
                            <span class="">Hotline</span>
                            <span>0337857855</span>
                        </span>
                    </a>
                </li>
            </ul>
            <div id="menu-main" class="container" style="display: none;">
                <ul class="menu-list">
                    @foreach($categories as $item)
                        <li>
                            <a href="{{  route('get.category.list', $item->c_slug) }}"
                               title="{{  $item->c_name }}" class="js-open-menu">
                                <img src="{{ asset(pare_url_file($item->c_avatar)) }}" alt="{{ $item->c_name }}">
                                <span>{{  $item->c_name }}</span>
                                @if (isset($item->children) && count($item->children))
                                    <span class="fa fa-angle-right"></span>
                                @else
                                    <span></span>
                                @endif
                            </a>
                            @if (isset($item->children) && count($item->children))
                                <div class="submenu">
                                    <div class="group">
                                        <div class="item">
                                            @foreach($item->children as $children)
                                                <a href="{{  route('get.category.list', $children->c_slug.'-'.$children->id) }}"
                                                   title="{{  $children->c_name }}" class="js-open-menu">
                                                    <span>{{  $children->c_name }}</span>
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>


        </div>

    </div>
    <div class="navi">

    <ul>
        <div class="container header-wrapper">
            <li><a class="active" href="#home">Trang chủ</a></li>
            @foreach($categories as $item)
            <li><a href="{{  route('get.category.list', $item->c_slug) }}">{{$item->c_name}}</a></li>
            @endforeach
        </div>
    </ul>
</div>
</div>
