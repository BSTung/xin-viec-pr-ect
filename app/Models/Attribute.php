<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Attribute extends Model
{
    protected $table = 'attributes';/*model anh xa toi bang attributes co the khai bao hoac ko khai bao deu duoc*/
    protected $guarded = ['']; /*thêm dòng này để DB ko bảo vệ file nào, tự do thêm xóa sửa*/

    public function getType()
    {
        return Arr::get($this->type, $this->atb_type,"[N\A]");
        //lấy mảng type -> atb_type
    }
    public function category()
    {
        return $this->belongsTo(Category::class,'atb_category_id');
        //Mối quan hệ relationships $this->belongsTo, khóa ngoại 'atb_category_id'
    }
    protected $type = [
        1 => [
            'name' => "Màu sắc",
            'class' => 'label label-info'
        ],
        2 => [
            'name' => 'Bộ nhớ',
            'class' => 'label label-default'
        ],
        3 => [
            'name' => 'Ram',
            'class' => 'label label-danger'
        ],
        4 => [
            'name' => 'Hệ điều hành',
            'class' => 'label label-success'
        ],
    ];
}
