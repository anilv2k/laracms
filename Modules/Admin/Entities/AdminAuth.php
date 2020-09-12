<?php

namespace Modules\Admin\Entities;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class AdminAuth extends Authenticatable
{
    use Notifiable;
    protected $table = 'admin_users';
   
    protected $guard = 'admin';


    protected $fillable = [
        'name', 'email', 'password','is_super'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}

