<?php

namespace Modules\Exam\Entities;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
	 'id','question','explanation'
	];

	public function questions_option(){
		return $this->hasMany(QuestionsOption::class,'question_id')->orderBy('id');
	}
}
