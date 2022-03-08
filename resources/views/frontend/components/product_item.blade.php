@if (isset($product))
    <div class="product-item">
        <a href="{{ route ('get.product.detail', $product->pro_slug. '-'.$product->id)}}" title="" class="avatar image contain">
            <img alt="" src="{{asset(pare_url_file($product->pro_avatar)) }}" class="lazyload">
        </a>
        <a href="{{ route ('get.product.detail', $product->pro_slug. '-'.$product->id)}}"
           title="{{ $product->pro_name}}" class="title">
            <h3>{{ $product->pro_name}}</h3>
        </a>
        @if ($product->pro_sale)
            <p>
            <p class="percent">-{{ $product->pro_sale}}%</p>
            @php
                $price = ((100 - $product->pro_sale) * $product->pro_price) / 100;
            @endphp
            <p class="price">{{ number_format($price,0,',','.')}} đ</p>
            <p class="price-sale">{{ number_format($product->pro_price,0,',','.')}} đ</p>
            </p>
        @else
            <p class="price">{{ number_format($product->pro_price,0,',','.')}} đ</p>
        @endif
    </div>
@endif
