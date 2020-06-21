<?php

namespace Module\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class NonMeasurement extends Model
{
    protected $fillable = [
        'title', 'parent_id', 'key', 'rank'
    ];

    public function parent()
    {
        return $this->belongsTo(NonMeasurement::class, 'parent_id', 'id');
    }

    public function childs()
    {
        return $this->hasMany(NonMeasurement::class, 'parent_id', 'id');
    }
}
