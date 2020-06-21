<?php

namespace Module\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'category_title', 'category_slug', 'category_icon', 'parent_id', 'status', 'have_child', 'unit'
    ];

    public function getRouteKeyName()
    {
        return 'category_slug';
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'attribute_category_pivot');
    }

    public function getAttributeIdsAttribute()
    {
        return \DB::table('attribute_category_pivot')->where('category_id',$this->id)->pluck('attribute_id')->toArray();
    }

    public function child()
    {
        return $this->hasMany(Category::class,'parent_id');
    }
}
