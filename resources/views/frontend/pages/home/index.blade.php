@extends('layouts.app_master_frontend')

@section('css')
    <style>
        <?php $style = file_get_contents('css/home_insights.min.css');echo $style;?>
    </style>
@stop

@section('content')
    <!--slide-->
    <div id="content-slide">
        <div class="spinner">
            <div class="rect1"></div>
            <div class="rect2"></div>
            <div class="rect3"></div>
            <div class="rect4"></div>
            <div class="rect5"></div>
        </div>
    </div>
    <div class="container" id="before-slide">
        <div class="product-one">
<!--            <div class="top">
                <a href="#" title="" class="main-title">SẢN PHẨM BÁN CHẠY</a>
            </div>-->
        <div class="product-three">
            <div class="top">
                <a href="#" title="" class="main-title">SẢN PHẨM MỚI</a>
            </div>
            <div class="bot">
                <div class="left">
                    <div class="image">
                        @if (isset($event3->e_link))
                            <a href="{{  $event3->e_link }}" title="" class="{{ $event3->e_name }}" target="_blank">
                                <img style="height: 310px;" class="lazyload lazy" alt="{{ $event3->e_name }}" src="{{  asset('images/preloader.gif') }}"  data-src="{{  pare_url_file($event3->e_banner) }}" />
                            </a>
                        @endif
                    </div>
                </div>
                <div class="right js-product-one owl-carousel owl-theme owl-custom">
                    @if (isset($productsNew))
                        @foreach($productsNew as $product)
                            <div class="item">
                                @include('frontend.components.product_item',['product' => $product])
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

        <div class="product-two">
            <div class="top">
                <a href="#" class="main-title">SẢN PHẨM NỔI BẬT</a>
            </div>
            <div class="bot">
                @if (isset($productsHot))
                    @foreach($productsHot as $product)
                        <div class="item">
                            @include('frontend.components.product_item',['product' => $product])
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="product-two" id="product-recently"></div>
    </div>
@stop

@section('script')
    <script>
        var CSS = "{{ asset('css/home.min.css') }}";
    </script>
    <script type="text/javascript">
        <?php $js = file_get_contents('js/home.js');echo $js;?>
    </script>
@stop
