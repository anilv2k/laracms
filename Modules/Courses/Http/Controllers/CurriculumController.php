<?php

namespace Modules\Courses\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Modules\Courses\Entities\Course;
use Modules\Courses\Entities\Curriculum;
use Theme, Datatable, Module;

class CurriculumController extends Controller
{
    public function __construct()
    {
        Theme::uses('admin');
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Course $course)
    {
        // dd($course);
        Theme::setTitle('Curriculum - '.$course->name);
        $curr = json_decode(Curriculum::whereCourseId($course->id)->get(),1);
        Theme::asset()->themePath()->add('curriculum','js/curriculum.js','scripts');
        // dd($curr);
        $data = [];
        foreach($curr as $cur){
            if($cur['parent_id']==0){
                $data[$cur['id']] = $cur;
            }else{
                $data[$cur['parent_id']]['lessons'][] = $cur;
            }

        }
        // dd($data);
        return Theme::of('courses::curriculum',['curr'=>$data,'course'=>$course])->render();
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('courses::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store_section(Request $request)
    {
        $data = $request->validate([
            'title' => 'required'
        ]);

        $curr = new Curriculum();
        $curr->title = $request->title;
        $curr->parent_id=0;
        $curr->course_id = $request->course_id;
        $curr->save();
        //dd($curr);

        return ['status'=>true, 'curr'=>$curr];
    }

    public function store_lesson(Request $request)
    {
        switch ($request->file_type) {
            case 'video':
                $file_type = 'mp4';
                break;
            case 'pdf': $file_type='pdf';
            default: $file_type='pdf';
                break;
        }
        
        $data = $request->validate([
            'title' => 'required',
            'lesson_file'=>["required",'file',"mimes:$file_type",],
            'file_type'=>'required',
            'file_length'=>'required',
            'course_id' => 'required|numeric',
            'parent_id' => 'required|numeric'
        ]);


		//$file_name= Datatable::fileUpload($request,'file_name','curriculum'.DIRECTORY_SEPARATOR.$file_type);
		//if($file_name){ $data['file_name']=$file_name; }
				

        $file_name = $request->file('lesson_file')->store('public/'.'curriculum'.DIRECTORY_SEPARATOR.$file_type);
		
	
		
        unset($data['lesson_file']);
        $data['file_name'] = $file_name;
        //  dd($data);
        $curr = Curriculum::create($data);

        return ['status'=>true, 'curr'=>$curr];
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Curriculum $curriculum)
    {
        return $curriculum;
        // return view('courses::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('courses::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update_section(Request $request, Curriculum $curriculum)
    {
        $request->validate(['title'=>'required']);

        $curriculum->title = $request->title;
        $curriculum->save();
        return ['status'=>true, 'curr'=>$curriculum];
    }

    public function update_lesson(Request $request, Curriculum $curriculum)
    {
        
        switch ($request->file_type) {
            case 'video':
                $file_type = 'mp4';
                break;
            case 'pdf': $file_type='pdf';
            default: $file_type='pdf';
                break;
        }
        
        $data = $request->validate([
            'title' => 'required',
            'lesson_file'=>['file',"mimes:$file_type",],
            'file_type'=>'required',
            'file_length'=>'required',
            'course_id' => 'required|numeric',
            'parent_id' => 'required|numeric'
        ]);
        
		
		$file_name = $request->file('lesson_file')->store('curriculum'.DIRECTORY_SEPARATOR.$file_type);
        unset($data['lesson_file']);
        $data['file_name'] = $file_name;
		
		
		
        $curriculum->title = $request->title;
        $curriculum->title = $request->title;
        $curriculum->title = $request->title;
        $curriculum->title = $request->title;
        $curriculum->save();

        return ['status'=>true, 'curr'=>$curriculum];
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function delete_section(Curriculum $curriculum)
    {
        $deleted_lessons = Curriculum::where('parent_id',$curriculum->id)->delete();
        $del = $curriculum->delete();
        return ['status'=>$del, 'deleted_lessons'=>$deleted_lessons];
    }

    public function delete_lesson(Curriculum $curriculum)
    {
        $file_stat = Storage::delete($curriculum->file_name);
        $del = $curriculum->delete();

        return ['status'=>$del, 'file_stat'=>$file_stat];
    }

    public function get_sections($course_id)
    {
        return Curriculum::select('id','title')->whereCourseId($course_id)->get();
    }
}
