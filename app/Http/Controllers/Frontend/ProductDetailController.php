<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use  App\Models\Product;

class ProductDetailController extends FrontendController
{
    public function getProductDetail(Request $request, $slug)
    {
        $arraySlug = explode('-', $slug); //chuyển về 1 mảng dùng explode
        $id = array_pop($arraySlug);

        if ($id) {
            $product = Product::findOrFail($id);
            $viewData = [
                'product' => $product
            ];
            return view('frontend.pages.product_detail.index', $viewData);
        }
        return redirect()->to('/');
    }
}
