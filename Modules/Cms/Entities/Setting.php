<?php

namespace Modules\Cms\Entities;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
	    'name', 'value', 'default','type',
	];
}
