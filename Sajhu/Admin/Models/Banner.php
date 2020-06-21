<?php

namespace Module\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = [
        'image', 'banner_name', 'bannerable_id', 'bannerable_type'
    ];

    public function bannerable()
    {
        return $this->morphTo();
    }

    public function getImagePathAttribute()
    {
        return asset(str_replace('public', 'storage', $this->image));
    }

}
