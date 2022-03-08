<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequestAttribute;
use App\Models\Category;
use App\Models\Attribute;
use Illuminate\Support\Str;

class AdminAttributeController extends Controller
{
    public function index(){
        $attributes = Attribute::with('category:id,c_name')->orderByDesc('id')
            ->get();

        // để sử dụng function"category" trong model Attribute dùng "with('category:id,c_name')"
        //sắp xếp theo thứ tự "id" giảm dần "orderByDesc"

        $viewData = [
            'attributes' => $attributes /*DB attributes ánh xạ tới $attributes*/
        ];
        return view('admin.attribute.index', $viewData);
    }
    public function create(){
        $categories = Category::select('id', 'c_name')->get();

        return view('admin.attribute.create', compact('categories'));
    }
    public function store(AdminRequestAttribute $request){
        $data               = $request->except('_token'); /*lấy hết tất cả giá trị ngoài trừ except*/
        $data['atb_slug']     = Str::slug($request->atb_name); /*trag laravel search *slug ra cú pháp, thư viện, truyền tham số vào*/
        $data['created_at'] = Carbon::now(); /*trag laravel search *carbon ra cú pháp, thư viện xử lý date time*/

        $id = Attribute::insertGetId($data); /*trả về id vừa insert*/
        return redirect()->back(); /*nếu tồn tại id thì back lại trang vừa rồi*/
    }
    public function edit($id){
        $attribute = Attribute::find($id);
        $categories = Category::select('id', 'c_name')->get();

        return view('admin.attribute.update',compact('attribute', 'categories')); /*compact truyền dữ liệu ra view, $attribute=attribute*/
    }
    public function update($id, AdminRequestAttribute $request){
        $attribute = Attribute::find($id);
        $data = $request->except('_token');
        $data['atb_slug'] = Str::slug($request->atb_name);
        $data['updated_at'] = Carbon::now();

        $attribute->update($data);
        return redirect()->back();
    }
    public function delete($id){
        $attribute = Attribute::find($id);
        if ($attribute) $attribute->delete(); /*check nếu tồn tại $attribute thì $attribute->delete*/
        return redirect()->back();
    }
}
