<?php

namespace Modules\Exam\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Exam\Entities\Question;
use Modules\Exam\Entities\QuestionsOption;
use Modules\Courses\Entities\Course;



use Theme,Datatable, Module;


class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('exam::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
	 
	 
	 
	public function list()
    {   
	    
		//$formdata['universities']=Question::all();

		$data['fdata']=array();
							
        Datatable::setFields(array('id','question' ))->setModule('exam')->setSubject('Questions')->showFilters('question');
		Datatable::displayFields(array('id'=>'ID','question'=>'Question'))->setListurl('questions/ajax_list')->setOptionurl('questions/ajax_options')->showActions();
			
     	return Theme::uses('admin')->view('exam::question_list',$data);
    }

		/**
     * Display a listing of the resource.
     * @return Response
     */
    public function ajax_list(Request $request)
    {   
	    $flfields = array('name'); // filter like fields
		
		Datatable::showActions(array('view','edit','delete'));
		
		
			
	    $totalData = Question::count();
		
        $totalFiltered = $totalData; 
		
		$columns= $request->input('columns');
		foreach($columns as $c){ $sortcolumns[]=$c['data']; }
		
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $sortcolumns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        
		if($request->input('filters')){
			$query  =  Question::select();
			$queryc =  Question::select();
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
			 $rows = Question::offset($start)->limit($limit)->orderBy($order,$dir)->get();
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
				$nestedData['question'] =$nestedData['question'];
				
				//dd($nestedData);
				
				$nestedData['options'] = Datatable::getActions($row->id,array('view','edit'));
				
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
			    'course_id' => 'required',
 				'question'  => 'required|max:150',
				'explanation'  => '',
				'correct'  => 'required',
			]);
				
			$qoption = $request->input('qoption');
			$correct = $request->input('correct');
		    		
			if($request->input('id')!=""){
				 
		        $id=$request->input('id');
				$question= Question::whereId($id)->first();
				
				$i=0;
				foreach($question->questions_option as $qopt){
					
					$vData['option']= $qoption[$i];
					
					if($correct==$qopt->id)
					$vData['correct']= 1;
                    else
					$vData['correct']= 0;	
					
					QuestionsOption::whereId($qopt->id)->update($vData);
					$i +=1;
				}
				
				unset($validatedData['correct']);
				Question::whereId($id)->update($validatedData);
				
				$message= "Question info updated sucessfully!";
				
			}else{
				
				unset($validatedData['correct']);
				$qid=Question::create($validatedData);
				
				$i=0;
				foreach($qoption as $opt){
					
					$vData['option']= $opt;
					
					$vData['question_id']=$qid->id;
					
					if(($i+1)==$correct)
					$vData['correct']= 1;
                    else
					$vData['correct']= 0;	
					
					QuestionsOption::create($vData);
					$i +=1;
				}
				
			    
			    
				//dd('adding record');
				
				
				$message= "Question info added sucessfully!";
			}
		    
			$json_data = array("status"  => true, "message"  => $message );
			
            echo json_encode($json_data);
		
		}else{
			   $id = $request->input('id');	
			   $formdata =  ($id!="")?Question::findOrFail($id):"";
			   
			   if($id==""){  $formdata =(object)array(); } 
			   
				$formdata->courses=Course::all();
				foreach($formdata->courses as $v){
				$u[]= array('id'=>$v->id, 'name'=>$v->name); }

				$formdata->courses=$u;
					
			   Datatable::setModule('exam')->viewFiles($option,$formdata,'question');
		}
		
	}
	


	
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
