<?php

namespace Modules\Exam\Entities;

use Illuminate\Database\Eloquent\Model;

class QuestionsOption extends Model
{
    protected $fillable = [
	 'id','question_id','option','correct',
	];

    public function question()
    {
        return $this->belongsTo(Question::class,'id','question_id');
    }
}
