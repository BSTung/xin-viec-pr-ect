<style type="text/css">
    .item__content .active a {
        color: red;
    }
</style>
<div class="filter-sidebar">
    @if (isset($country))
        <div class="item">
            <div class="item__title">Thương Hiệu</div>
            <div class="item__content">
                <ul>
                    @foreach($country as $key => $item)
                        <li class="{{ Request::get('country') == $key ? "active" : "" }} js-param-search" data-param="country={{ $key }}">
                            <a href="{{ request()->fullUrlWithQuery(['country'=> $key]) }}">
                                <span>{{ $item }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
    @if (isset($attributes))
        @foreach($attributes as $key => $attribute)
            <div class="item">
                <div class="item__title">{{ $key }}</div>
                <div class="item__content">
                    <ul>
                        @foreach($attribute as $item)
                            <li class=" js-param-search {{ Request::get('attr_'.$item['atb_type']) == $item['id'] ? "active" : "" }}"
                                data-param="attr_{{ $item['atb_type'] }}={{ $item['id'] }}">
                                <a href="{{ request()->fullUrlWithQuery(['attr_'.$item['atb_type'] => $item['id']]) }}">
                                    <span>{{ $item['atb_name'] }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
    @endforeach
@endif
</div>
