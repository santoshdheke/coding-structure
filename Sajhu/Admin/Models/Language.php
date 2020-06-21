<?php

namespace Module\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $fillable = [
        'country_name', 'country_code', 'flag'
    ];
}
