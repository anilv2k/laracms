<?php

namespace Modules\Courses\Entities;

use Illuminate\Database\Eloquent\Model;

use Modules\Courses\Entities\University;



class College extends Model
{
  	protected $fillable = [
        'name', 'email', 'password','university_id',
    ];
	
	
	
	public function university(){
        return $this->hasOne(University::class,'id','university_id');
    }
	
}
