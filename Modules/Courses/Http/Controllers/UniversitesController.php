<?php

namespace Modules\Courses\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Courses\Entities\University;
use Theme;
Use Datatable;
Use Module;


class UniversitesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
		
		Theme::setPagetitle("Universites");
		
		$data['universities']=University::all();
		
        return Theme::view('courses::universites',$data);
       
    }

	public function details($id)
    {
		
		 Theme::setPagetitle("University");
		
		 $data['university']=University::find($id);
		
         return Theme::view('courses::university_details',$data);
		
    }
	
	
	public function list()
    {
        Datatable::setFields(array('id','name','email'))->setModule('user')->setSubject('University')->showFilters(1);
		Datatable::displayFields(array('id'=>'ID','name'=>'Name'))->setListurl('university/ajax_list')->setOptionurl('university/ajax_options')->showActions();
			
     	return Theme::uses('admin')->view('courses::universitieslist');
    }

	
		/**
     * Display a listing of the resource.
     * @return Response
     */
    public function ajax_list(Request $request)
    {   
	    $flfields = array('name','email'); // filter like fields
		
		Datatable::showActions(array('view','edit','delete'));
		
		
			
	    $totalData = University::count();
		
        $totalFiltered = $totalData; 
		
		$columns= $request->input('columns');
		foreach($columns as $c){ $sortcolumns[]=$c['data']; }
		
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $sortcolumns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        
		if($request->input('filters')){
			$query  =  University::select();
			$queryc =  University::select();
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
			 $rows = University::offset($start)->limit($limit)->orderBy($order,$dir)->get();
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
				'email' => 'required',
				'phone' => 'required',
				'weburl' => 'required',
				'address'  => 'required',
				'shortdesc'  => 'required',
				'description'  => 'required',
				'image' => 'image',
				'logo' => 'image',
				'banner' => 'image',
				'shortcode' => 'required',
				'banner_caption' => '',
			]);
				
			if($request->input('id')!=""){
				 
		        $id=$request->input('id');
				$uplodfile= Datatable::fileUpload($request,'image','universites');
				if($uplodfile){ $validatedData['image']=$uplodfile; }
				
				$uplodfile= Datatable::fileUpload($request,'logo','universites');
				if($uplodfile){ $validatedData['logo']=$uplodfile; }
				
				$uplodfile= Datatable::fileUpload($request,'banner','universites');
				if($uplodfile){ $validatedData['banner']=$uplodfile; }
				
				
				University::whereId($id)->update($validatedData);
				$message= "University info updated sucessfully!";
				
			}else{
				University::create($validatedData);
				$message= "University info added sucessfully!";
			}
		    
			$json_data = array("status"  => true, "message"  => $message );
			
            echo json_encode($json_data);
		
		}else{
			   $id = $request->input('id');	
			   $formdata =  ($id!="")?University::findOrFail($id):"";
			   Datatable::setModule('courses')->viewFiles($option,$formdata,'university');
		}
		
	}
	
	
	
	public function aboutus()
    {
		
	   
         Theme::setPagetitle("About Us");
		 
		 $subsiteid=config("app.subsiteid");
		 $data['university']=University::find($subsiteid);
		
         return Theme::view('courses::university_aboutus',$data);
    }
	
	public function contactus()
    {
          Theme::setPagetitle("Contact us");
		
		  $subsiteid=config("app.subsiteid");
		  $data['university']=University::find($subsiteid);
		
         return Theme::view('courses::university_contactus',$data);
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
