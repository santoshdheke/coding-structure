<?php

namespace Module\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class Measurement extends Model
{
    protected $fillable = [
        'title', 'parent_id', 'compare_parent_value', 'rank'
    ];

    public function parent()
    {
        return $this->belongsTo(Measurement::class, 'parent_id', 'id');
    }

    public function childs()
    {
        return $this->hasMany(Measurement::class, 'parent_id', 'id');
    }
}
