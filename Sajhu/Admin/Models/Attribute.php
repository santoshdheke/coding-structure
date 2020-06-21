<?php

namespace Module\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $fillable = [
        'attribute_title', 'attributeable_type', 'attributeable_id', 'rank', 'input_type'
    ];

    public function measurement()
    {
        return $this->belongsTo(Measurement::class);
    }

    public function attributeable()
    {
        return $this->morphTo();
    }
}
