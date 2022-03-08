<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;


class HomeController extends FrontendController
{
    public function index(){
        /*Sản phẩm mới lọc theo pro_active*/
        $productsNew = Product::where('pro_active', 1) /*$proNew trong model Product với điều kiện pro_active=1*/
        -> orderByDesc('id')
        -> limit(4) /*giới hạn hiển thị 4 sản phẩm*/
        -> select('id', 'pro_name', 'pro_slug', 'pro_avatar', 'pro_price', 'pro_sale') /*chỉ lấy những dữ liệu cần lấy*/
        -> get();

        /*Sản phẩm HOT lọc thoe pro_hot*/
        $productsHot = Product::where([
            'pro_active' => 1,
            'pro_hot' => 0
        ])  //$proHot trong model Product với điều kiện pro_active=1* và 'pro_hot' => 0

            -> orderByDesc('id')
            -> limit(4) /*giới hạn hiển thị 4 sản phẩm*/
            -> select('id', 'pro_name', 'pro_slug', 'pro_avatar', 'pro_price', 'pro_sale') /*chỉ lấy những dữ liệu cần lấy*/
            -> get();

        $viewData = [
            'productsNew' => $productsNew,
            'productsHot' => $productsHot
            ];
        return view('frontend.pages.home.index', $viewData);
    }
}
