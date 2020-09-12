<?php

namespace Modules\Courses\Entities;

use Illuminate\Database\Eloquent\Model;

class University extends Model
{
  
	
	protected $fillable = [
        'name', 'email','image','address','description','phone','weburl','shortcode','logo','banner','banner_caption','shortdesc',
    ];
	
	
	public function college(){
        return $this->hasMany(College::class,'university_id','id');
    }
}
