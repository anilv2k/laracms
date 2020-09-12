<?php

namespace Modules\Courses\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\Courses\Entities\Calendarevent;

use Theme,Datatable, Module;


class CalendareventsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        //return view('courses::calenderevents_index');
		
		Datatable::setFields(array('id','name'))->setSubject('Calendar Events')->setModule('courses')->showFilters('calendarevents');
		Datatable::displayFields(array('id'=>'ID','name'=>'Name'))->setListurl('calendar/ajax_list')->setOptionurl('calendar/ajax_options')->showActions();
			
     	return Theme::uses('admin')->view('courses::calendarevents_index');
    }

	
	public function getevents(){
		
		$totalData = Calendarevent::all();
			
		//dd($totalData);	
		
		foreach($totalData as $c){
			
			if($c->start_date==$c->end_date)
			$cdata[]=array('id'=>$c->id,'title'=>$c->name,'start'=>$c->start_date);
		    else
			$cdata[]=array('id'=>$c->id,'title'=>$c->name,'start'=>$c->start_date,'end'=>$c->end_date);	
		}
		
		return $cdata;
		
			
	}
	
		/**
     * Display a listing of the resource.
     * @return Response
     */
    public function ajax_list(Request $request)
    {   
	    $flfields = array('name','email'); // filter like fields
		
		Datatable::showActions(array('view','edit','delete'));
		
		
			
	    $totalData = Calendarevent::count();
		
        $totalFiltered = $totalData; 
		
		$columns= $request->input('columns');
		foreach($columns as $c){ $sortcolumns[]=$c['data']; }
		
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $sortcolumns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        
		if($request->input('filters')){
			$query  =  Calendarevent::select();
			$queryc =  Calendarevent::select();
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
			 $rows = Calendarevent::offset($start)->limit($limit)->orderBy($order,$dir)->get();
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
				//$nestedData['created_at'] = date('j M Y h:i a',strtotime($nestedData['created_at']));
				
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
				'name'  => 'required|max:100',
				'start_date'  => 'required',
				'end_date'  => 'required',
				
			]);
				
				
			//dd($validatedData);
			
			
			$validatedData['start_date']= date('Y-mm-dd',strtotime($validatedData['start_date']));
			$validatedData['end_date']= date('Y-mm-dd',strtotime($validatedData['end_date']));
			
			if($request->input('id')!=""){
				 
		        $id=$request->input('id');
				
				Calendarevent::whereId($id)->update($validatedData);
				$message= "University info updated sucessfully!";
				
			}else{
				Calendarevent::create($validatedData);
				$message= "University info added sucessfully!";
			}
		    
			$json_data = array("status"  => true, "message"  => $message );
			
            echo json_encode($json_data);
		
		}else{
			   $id = $request->input('id');	
			   $formdata =  ($id!="")?Calendarevent::findOrFail($id):"";
			   Datatable::setModule('courses')->viewFiles($option,$formdata,'calendarevents');
		}
		
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
        return view('courses::show');
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
