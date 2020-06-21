<?php

namespace Module\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use Module\Vendor\Models\Vendor;

class Product extends Model
{
    protected $fillable = [
        'product_name', 'main_product_image', 'short_description',
        'long_description', 'category_id', 'status', 'in_stock', 'vendor_id', 'price'
    ];

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'attribute_product_pivot');
    }

    public function getRouteKeyName()
    {
        return 'id';
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function getSelectedPriceAttribute($currencyId)
    {
        $productPriceInDolor = Currency::whereId($this->currenty_id)->pluck('compare_with_dolor');
        $selectPriceInDolor = Currency::whereId($currencyId)->pluck('compare_with_dolor');
        $productPrice = $this->price;

        return $selectPriceInDolor / $productPriceInDolor * $productPrice;
    }

    public function category()
    {
        return $this->belongsTo(MiniSubCategory::class,'category_id');
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
