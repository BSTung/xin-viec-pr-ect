<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    const STATUS_ACTIVE = 1;
    const STATUS_HIDE = 0;
    protected $table = 'categories';/*model anh xa toi bang categories co the khai bao hoac ko khai bao deu duoc*/
    protected $guarded = ['']; /*thêm dòng này để DB ko bảo vệ file nào, tự do thêm xóa sửa*/

    public static function recursive($categories ,$parents = 0 ,$level = 1 ,&$listCategoriesSort)
    {
        if(count($categories) > 0 )
        {
            foreach ($categories as $key => $value) {
                if($value->c_parent_id  == $parents)
                {
                    $value->level = $level;
                    $listCategoriesSort[] = $value;
                    unset($categories[$key]);
                    $parent = $value->id;

                    self::recursive($categories , $parent ,$level + 1 , $listCategoriesSort);
                }
            }
        }
    }
}
