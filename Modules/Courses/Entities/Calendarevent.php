<?php

namespace Modules\Courses\Entities;

use Illuminate\Database\Eloquent\Model;

class Calendarevent extends Model
{
    protected $fillable = [
	 'id','name','start_date','end_date'
	];
}
