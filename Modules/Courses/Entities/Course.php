<?php

namespace Modules\Courses\Entities;

use Illuminate\Database\Eloquent\Model;

use Modules\Admin\Entities\Admin;

class Course extends Model
{
      	protected $fillable = [
        'id','name','image','excerpt','description','user_id','level',
         ];
		 
		 
		 
		public function user(){
			
        return $this->hasOne(Admin::class,'id','user_id');
    
        }
	
}
