<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Keyword;
use App\Models\Product;
use App\Models\Attribute;
use App\Http\Requests\AdminRequestProduct;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{
    public function index(Request $request){
        $products = Product::with('category:id,c_name');
        if ($id = $request->id) $products->where('id',$id);
        if ($name = $request->name) $products->where('pro_name','like', '%'.$name.'%');
        if ($category = $request->category) $products->where('pro_category_id',$category);

        $products = $products->orderByDesc('id')->paginate(4);
        $categories = Category::all();
        $viewData = [
            'products'   => $products,
            'categories' => $categories,
            'query'      => $request->query()
        ];
        return view('admin.product.index', $viewData);
    }
    public function create()
    {
        $categories = Category::all();
        $attributeOld = [];
        $keywordOld = [];

        $attributes = $this->syncAttributeGroup();
        $keywords = Keyword::all();


        return view('admin.product.create', compact('categories', 'attributeOld', 'attributes', 'keywords', 'keywordOld'));
    }
    public function store(AdminRequestProduct $request){
        $data = $request->except('_token', 'pro_avatar', 'attribute', 'keywords');
        $data['pro_slug']     = Str::slug($request->pro_name); /*trag laravel search *slug ra cú pháp, thư viện, truyền tham số vào*/
        $data['created_at'] = Carbon::now(); /*trag laravel search *carbon ra cú pháp, thư viện xử lý date time*/

        /*nếu tồn tại file ảnh thì trả về mảng data (pro_avatar = name)*/
        if($request->pro_avatar){
            $image = upload_image('pro_avatar');
            if($image['code'] == 1)
                $data['pro_avatar'] = $image['name'];
        }

        $id = Product::insertGetId($data); /*trả về id vừa insert*/;
        if($id) {
            $this->syncAttribute($request->attribute, $id);
            $this->syncKeyword($request->keywords, $id);
            if ($request->file) {

                $this->syncAlbumImageAndProduct($request->file, $id);
            }
        }

        return redirect()->back();
    }
    public function edit($id){
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $attributes = $this->syncAttributeGroup();
        $keywords   = Keyword::all();

        $attributeOld = \DB::table('products_attributes')
            ->where('pa_product_id', $id)
            ->pluck('pa_attribute_id')
            ->toArray();

        $keywordOld = \DB::table('products_keywords')
            ->where('pk_product_id', $id)
            ->pluck('pk_keyword_id')
            ->toArray();

        if (!$attributeOld) $attributeOld = [];
        if (!$keywordOld)   $keywordOld = [];

        $images = \DB::table('product_images')
            ->where("pi_product_id", $id)
            ->get();

        $viewData = [
            'categories' => $categories,
            'product'    => $product,
            'attributes' => $attributes,
            'attributeOld' => $attributeOld,
            'keywords'   => $keywords,
            'keywordOld' => $keywordOld,
            'images'     => $images ?? []
        ];
        return view('admin.product.update', $viewData);
    }
    public function update($id, AdminRequestProduct $request){
        $product = Product::find($id);
        $data = $request->except('_token', 'pro_avatar', 'attribute', 'keywords');
        $data['pro_slug']     = Str::slug($request->pro_name); /*trag laravel search *slug ra cú pháp, thư viện, truyền tham số vào*/
        $data['updated_at'] = Carbon::now(); /*trag laravel search *carbon ra cú pháp, thư viện xử lý date time*/

        /*nếu tồn tại file ảnh thì trả về mảng data (pro_avatar = name)*/
        if($request->pro_avatar){
            $image = upload_image('pro_avatar');
            if($image['code'] == 1)
                $data['pro_avatar'] = $image['name'];
        }
        $update = $product->update($data);
        if ($update) {
            $this->syncAttribute($request->attribute, $id);
            $this->syncKeyword($request->keywords, $id);

            if ($request->file) {

                $this->syncAlbumImageAndProduct($request->file, $id);
            }
        }
        return redirect()->back();
    }
    public function delete($id){
        $product = Product::find($id);
        if ($product) $product->delete();/*check nếu tồn tại $product thì $product->delete*/
        return redirect()->back();
    }
    public function hot($id){
        $product = Product::find($id);
        $product->pro_hot = ! $product->pro_hot;
        $product->save();
        return redirect()->back();
    }
    public function active($id){
        $product = Product::find($id); /*lấy $category cần chỉnh sửa theo $id*/
        $product->pro_active = ! $product->pro_active; /*từ id của $category chuyển đổi trạng thái (1-0)*/
        $product->save();
        return redirect()->back(); /*sau khi save quay trở lại trang ban đầu*/
    }
    protected function syncAttribute($attributes, $idProduct)
    {
        if (!empty($attributes)) {
            $datas =[];
            foreach ($attributes as $key => $value) {
                $datas[] = [
                    'pa_product_id'     => $idProduct,
                    'pa_attribute_id'   => $value
                ];
            }
            if (!empty($datas)) {
                \DB::table('products_attributes')->where('pa_product_id', $idProduct)->delete();
                \DB::table('products_attributes')->insert($datas);
            }
        }
    }
    public function syncAttributeGroup()
    {
        $attributes = Attribute::get();
        $groupAttribute = [];
        foreach ($attributes as $key => $attribute) {
            $key = $attribute->gettype($attribute->atb_type)['name'];
            $groupAttribute[$key] [] = $attribute->toArray();
        }
        return $groupAttribute;
    }
    private function syncKeyword($keywords, $idProduct) {
        if (!empty($keywords)) {
            $datas = [];
            foreach ($keywords as $key => $keyword) {
                $datas[] = [
                    'pk_product_id' => $idProduct,
                    'pk_keyword_id' => $keyword
                ];
            }
            \DB::table('products_keywords')->where('pk_product_id', $idProduct)->delete();
            \DB::table('products_keywords')->insert($datas);
        }
    }
}
