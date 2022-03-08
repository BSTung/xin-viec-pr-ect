<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    protected $table = 'keywords';/*model anh xa toi bang keywords co the khai bao hoac ko khai bao deu duoc*/
    protected $guarded = ['']; /*thêm dòng này để DB ko bảo vệ file nào, tự do thêm xóa sửa*/
}
