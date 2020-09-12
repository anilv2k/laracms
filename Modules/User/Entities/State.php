<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $fillable = [];
	
	
	 public function users()
    {
        return $this->hasMany('Modules\User\Entities\User');
    }
	
	
}
