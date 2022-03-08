<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AdminRequestKeyword;
use Carbon\Carbon;
use App\Models\Keyword;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Lcobucci\JWT\Signer\Key;

class AdminKeywordController extends Controller
{
    public function index(){
        $keywords = Keyword::paginate(6);
        $viewData = [
          'keywords' => $keywords
        ];
        return view('admin.keyword.index', $viewData);
    }
    public function create(){
        return view('admin.keyword.create');
    }
    public function store(AdminRequestKeyword $request){
        $data               = $request->except('_token'); /*lấy hết tất cả giá trị ngoài trừ except*/
        $data['k_slug']     = Str::slug($request->k_name); /*trag laravel search *slug ra cú pháp, thư viện, truyền tham số vào*/
        $data['created_at'] = Carbon::now(); /*trag laravel search *carbon ra cú pháp, thư viện xử lý date time*/

        $id = Keyword::insertGetId($data); /*trả về id vừa insert*/
        return redirect()->back(); /*nếu tồn tại id thì back lại trang vừa rồi*/
    }
    public function hot($id){
        $keyword = Keyword::find($id);  /*lấy $keyword cần chỉnh sửa theo $id*/
        $keyword->k_hot = ! $keyword->k_hot; /*từ id của $keyword chuyển đổi trạng thái (1-0)*/
        $keyword->save();
        return redirect()->back(); /*sau khi save quay trở lại trang ban đầu*/
    }
    public function edit($id){
        $keyword = Keyword::find($id);

        return view('admin.keyword.update',compact('keyword')); /*compact truyền dữ liệu ra view, $keyword=keyword*/
    }
    public function update($id, AdminRequestKeyword $request){
        $keyword = Keyword::find($id);
        $data = $request->except('_token');
        $data['k_slug'] = Str::slug($request->k_name);
        $data['updated_at'] = Carbon::now();

        $keyword->update($data);
        return redirect()->back();
    }
    public function delete($id){
        $keyword = Keyword::find($id);
        if ($keyword) $keyword->delete(); /*check nếu tồn tại $keyword thì $keyword->delete*/
        return redirect()->back();
    }
}
