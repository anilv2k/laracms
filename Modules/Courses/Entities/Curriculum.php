<?php

namespace Modules\Courses\Entities;

use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    protected $table = 'curriculum';
    protected $fillable = ['title','parent_id','course_id','file_name','file_type','file_length'];
}
