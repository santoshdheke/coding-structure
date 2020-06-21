<?php

namespace Module\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $fillable = [
        'currency_name', 'front_symbol', 'back_symbol', 'compare_with_dolor'
    ];

    public function getValueAttribute()
    {
        $value = '';

        if ($this->front_symbol){
            $value = $this->front_symbol.' ';
        }

        $value = $value . $this->compare_with_dolor;

        if ($this->back_symbol){
            $value = $value.' '.$this->back_symbol;
        }

        return $value;
    }
}
