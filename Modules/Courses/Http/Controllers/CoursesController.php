<?php

namespace Modules\Courses\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Courses\Entities\Course;
use Modules\Courses\Entities\Coursetype;

use Modules\Courses\Entities\Curriculum;
use Modules\Admin\Entities\Admin;

use Theme;
Use Datatable;
Use Module;

class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
		
		Theme::setPagetitle("Courses");
		
		$data['coursetype']=Coursetype::all();
		
		$data['courses']=Course::all();$data['courses']=Course::all();
		
		
		$actions = Datatable::getActions(1,array('view','edit'));
		
			
        return Theme::view('courses::index',$data);
		
    }


    public function user(Request $request)
    {
		
		Theme::setPagetitle("My Courses");
		
		$data['coursetype']=Coursetype::all();
		
		$data['courses']=Course::all(); 
		
		
		
		Theme::layout('userlayout');
		    
				$course_obj= new Course();
		    $pages = $course_obj::paginate(3);
            $data['pages'] = $pages;
            if(request()->ajax()){
				
				
				//dd($_REQUEST['level']);
				
			
				
				if(isset($_REQUEST['level'])){
					
					$level =$_REQUEST['level'];
					
					$course_obj::where('level',$level);
					
					
				}
				
				
				 $pages = $course_obj::paginate(3);
                 $data['pages'] = $pages;
				
                $res['data'] = (string)view('courses::courses_content_box', $data);
                $res['links'] = (string)$pages->links();
                return $res;
            }
        // $data['page_type'] = $page;
		
		
        return Theme::view('courses::user_courses',$data);
		
    }
	

	public function details($id)
    {
		
		 Theme::setPagetitle("Course Details");
		 
		$course= Course::find($id);
		 
		$curr = json_decode(Curriculum::whereCourseId($id)->get(),1);
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
		
        return Theme::view('courses::course_details',['curr'=>$data,'course'=>$course]);
		
    }
	
	
	public function contentdetails($id,$fid)
    {
		
		
		 
		$course= Course::find($id);
		
		$content=Curriculum::find($fid);
		
		Theme::setPagetitle($course->name);
		 
		$curr = json_decode(Curriculum::whereCourseId($id)->get(),1);
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
		
        return Theme::view('courses::course_contentdetails',['curr'=>$data,'course'=>$course,'content'=>$content]);
		
    }
	
	
	
	public function list()
    { 
	
		$formdata['users']=Admin::where('role', 'presenter')->get();
		foreach($formdata['users'] as $v){
		$u[]= array('id'=>$v->id, 'name'=>$v->name);
		}

		$formdata['users']=$u;
		$data['fdata']=$formdata; 
		
					
        Datatable::setFields(array('id','name','created_at'))->setModule('courses')->setSubject('Courses')->showFilters('courses');
		Datatable::displayFields(array('id'=>'ID','name'=>'Name'))->setListurl('courses/ajax_list')->setOptionurl('courses/ajax_options')->showActions();
			
     	return Theme::uses('admin')->view('courses::courses_list',$data);
    }

		/**
     * Display a listing of the resource.
     * @return Response
     */
    public function ajax_list(Request $request)
    {   
	    $flfields = array('name','email'); // filter like fields
		
		Datatable::showActions(array('view','edit','delete'));
		
		
			
	    $totalData = Course::count();
		
        $totalFiltered = $totalData; 
		
		$columns= $request->input('columns');
		foreach($columns as $c){ $sortcolumns[]=$c['data']; }
		
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $sortcolumns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        
		if($request->input('filters')){
			$query  =  Course::select();
			$queryc =  Course::select();
			foreach($request->input('filters') as $f){
				 if($f['value']!=""){
						$k= $f['name'];	$v= $f['value'];
						if(in_array($k,$flfields)){
							$query->orwhere($f['name'],'LIKE',"%{$v}%");
							$queryc->orwhere($f['name'],'LIKE',"%{$v}%");
						}else{
							$query->orwhere($f['name'],$v);
							$queryc->orwhere($f['name'],$v);
						}					
				 }
			}
			$qry= $query->offset($start)->limit($limit)->orderBy($order,$dir); 
			$rows = $qry->get(); 				
			$totalFiltered = $queryc->count();

		}else{
			 $rows = Course::offset($start)->limit($limit)->orderBy($order,$dir)->get();
		}
		
		$data = array();
        if(!empty($rows))
        {
            foreach ($rows as $row)
            {
			
                foreach($columns as $column){
					$c=$column['data'];
					if(isset($row->$c))
					$nestedData[$c] = $row->$c;
				    else
					$nestedData[$c] = "";	
				} 
				
				$nestedData['id'] = sprintf("%08d", $nestedData['id']);
				$nestedData['created_at'] = date('j M Y h:i a',strtotime($nestedData['created_at']));
				
				$nestedData['options'] = Datatable::getActions($row->id,array('view','edit'));
				
				
				$nestedData['options'] .= "&emsp;<a  href='".url("courses/$row->id/curriculum")."' ><span class='btn btn-sm btn-info'>Index</span></a>";
				 
				 
				 
			    $data[] = $nestedData; 
				
				//$data[]= $row;
            }
        }
        $json_data = array(
                    "draw"            => intval($request->input('draw')),  
                    "recordsTotal"    => intval($totalData),  
                    "recordsFiltered" => intval($totalFiltered), 
                    "data"            => $data   
                    );
        echo json_encode($json_data); 
    }
	
	
	
	public function ajax_options(Request $request)
    {    
	    		
		$option = $request->input('option');
		$message ="";
		
		if($option=='addeditSave'){
			
			$validatedData = $request->validate([
				'name'  => 'required|max:150',
				'excerpt'  => 'required',
				'description'  => 'required',
				'image' => 'image',
				'level' => 'required',
				'user_id' => 'required'
			]);
				
			if($request->input('id')!=""){
				 
		        $id=$request->input('id');
				$uplodfile= Datatable::fileUpload($request,'image','images');
				if($uplodfile){ $validatedData['image']=$uplodfile; }
				Course::whereId($id)->update($validatedData);
				$message= "Course info updated sucessfully!";
				
			}else{
				Course::create($validatedData);
				$message= "Course info added sucessfully!";
			}
		    
			$json_data = array("status"  => true, "message"  => $message );
			
            echo json_encode($json_data);
		
		}else{
			   $id = $request->input('id');	
			   $formdata =  ($id!="")?Course::findOrFail($id):"";
			   
			   if(!$formdata){
				   
				   $formdata = new  Course();
			   }
			   
			   $formdata->users= Admin::where('role', 'presenter')->get();
			   
			   
			   Datatable::setModule('courses')->viewFiles($option,$formdata,'courses');
		}
		
	}
	
	
	
     /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id="")
    {
        return Theme::view('courses::cousedetails');
    }

	/**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('courses::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

	
    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('courses::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
