<?php
namespace App\Http\Controllers\Admin;
use App\Http\Requests\AdminRequestCategory;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Carbon\Carbon; /*Xử lý thời gian khởi tạo*/

class AdminCategoryController extends AdminController
{
    public function index(){
        $categories = Category::paginate(4); /*phân trang bằng paginate*/
        $viewData = [
            'categories' => $categories /*DB categories ánh xạ tới $categories*/
            ];
        return view('admin.category.index', $viewData); /*trả kết quả $viewData về view*/
    }
    public function create(){
        $categories = $this->getCategoriesSort();
        return view('admin.category.create', compact('categories'));
    }
    public function store(AdminRequestCategory $request){
        $data               = $request->except('_token'); /*lấy hết tất cả giá trị ngoài trừ except*/
        $data['c_slug']     = Str::slug($request->c_name); /*trag laravel search *slug ra cú pháp, thư viện, truyền tham số vào*/
        $data['created_at'] = Carbon::now(); /*trag laravel search *carbon ra cú pháp, thư viện xử lý date time*/
        if ($request->c_avatar) {
            $image = upload_image('c_avatar');
            if ($image['code'] == 1)
                $data['c_avatar'] = $image['name'];
        }

        $id = Category::insertGetId($data); /*trả về id vừa insert*/
        return redirect()->back(); /*nếu tồn tại id thì back lại trang vừa rồi*/
    }
    public function active($id){
        $category = Category::find($id); /*lấy $category cần chỉnh sửa theo $id*/
        $category->c_status = ! $category->c_status; /*từ id của $category chuyển đổi trạng thái (1-0)*/
        $category->save();
        return redirect()->back(); /*sau khi save quay trở lại trang ban đầu*/
    }
    public function hot($id){
        $category = Category::find($id);
        $category->c_hot = ! $category->c_hot;
        $category->save();
        return redirect()->back();
    }
    public function delete($id){
        $category = Category::find($id);
        if ($category) $category->delete(); /*check nếu tồn tại $category thì $category->delete*/
        return redirect()->back();
    }
    public function edit($id){
        $category = Category::find($id);

        return view('admin.category.update',compact('category')); /*compact truyền dữ liệu ra view, $category=category*/
    }
    public function update($id, AdminRequestCategory $request){
        $category = Category::find($id);
        $data = $request->except('_token');
        $data['c_slug'] = Str::slug($request->c_name);
        $data['updated_at'] = Carbon::now();
        if ($request->c_avatar) {
            $image = upload_image('c_avatar');
            if ($image['code'] == 1)
                $data['c_avatar'] = $image['name'];
        }

        $category->update($data);
        return redirect()->back();
    }
    protected function getCategoriesSort()
    {
        $categories = Category::where('c_status', Category::STATUS_ACTIVE)
            ->select('id', 'c_parent_id', 'c_name')->get();

        $listCategoriesSort = [];
        Category::recursive($categories, $parent = 0, $level = 1, $listCategoriesSort);
        return $listCategoriesSort;
    }
}
