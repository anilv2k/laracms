<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;

use Modules\Admin\Entities\Course;

class Admin extends Model
{
    
	protected $fillable = [
        'name', 'email', 'password','is_super','phone','role','university','college'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
	
	
	
	public function course(){
        return $this->hasMany(Course::class,'user_id','id');
    }
	
	
}
