<?php

namespace Modules\Cms\Entities;

use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title','slug','description','layout','page_type'
    ];
}
