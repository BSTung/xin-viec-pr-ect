<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use App\User;


class Product extends Model
{
    protected $guarded = [''];
    public $country = [
        "1" => "iPhone",
        "2" => "SAMSUNG",
        "3" => "oppo",
        "4" => "vivo",
        "5" => "xiaomi",
        "6" => "realme",
        "7" => "MacBook",
        "8" => "ASUS",
        "9" => "hp",
        "10" => "Lenovo",
        "11" => "Acer",
        "12" => "DELL",
        "13" => "MSI",
        "14" => "Apple Watch",
        "15" => "G-Shock",

    ];

    public function getCountry()
    {
        return Arr::get($this->country, $this->pro_country,"[N\A]");
    }


    public function category()
    {
        return $this->belongsTo(Category::class,'pro_category_id');
    }

    public function keywords()
    {
        return $this->belongsToMany(Keyword::class,'products_keywords', 'pk_product_id', 'pk_keyword_id');
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class,'products_attributes', 'pa_product_id', 'pa_attribute_id');
    }

    public function favourite()
    {
        return $this->belongsToMany(User::class,'user_favourite', 'uf_product_id', 'uf_user_id');
    }

    //apiProduct
    protected $product = 'products';
    protected $fillable = [
        'id',
        'pro_name',
        'pro_slug',
        'pro_price',
        'pro_category_id',
        'pro_admin_id',
        'pro_sale',
        'pro_avatar',
        'pro_view',
        'pro_hot',
        'pro_active',
        'pro_pay',
        'pro_description',
        'pro_content',
        'pro_review_total',
        'pro_review_star',
        'pro_number',
        'pro_resistant',
        'pro_energy',
        'pro_country'
    ];
}
