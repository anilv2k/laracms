<?php

namespace Modules\Exam\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Exam\Entities\Question;
use Theme;
class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        // add a table of exam with mapping to -> course_id
        // add an answers table with mapping to exam_id, question_id
        // add a pivot table for exam_question [exam_id,question_id]

        // $question = Question::with('questions_option')->paginate(1);
        $question = Question::with('questions_option')->simplePaginate(1);
        $data = ['question' => $question];
        if(request()->ajax()){
            $res['data'] = (string)view('exam::exam_content', $data);
            $res['links'] = (string)$question->links();
            return $res;
        }
        // return($question);
        Theme::asset()->themePath()->add('exam-js','js/exam.js','script');
        return Theme::view('exam::index',$data);
    }


   public function submitanswer()
    {
        echo "------------>";
    }


    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('exam::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('exam::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('exam::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
