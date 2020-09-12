<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\Admin\Entities\Admin;
use Modules\Admin\Entities\Role;

use Modules\Courses\Entities\University;
use Modules\Courses\Entities\College;

use Theme, Datatable , Module;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
		
		Datatable::setFields(array('id','name','email','created_at'))->setModule('admin')->setSubject('Admins')->showFilters(1);
		Datatable::displayFields(array('id'=>'User ID','name'=>'User Name'))->setListurl('admin/ajax_list')->setOptionurl('admin/ajax_options')->showActions();
			
     	return Theme::uses('admin')->view('admin::list');
		
        
    }



/**
     * Display a listing of the resource.
     * @return Response
     */
    public function ajax_list(Request $request)
    {   
	    $flfields = array('name','email'); // filter like fields
		
		Datatable::showActions(array('view','edit','delete'));
		
		
			
	    $totalData = Admin::count();
		
        $totalFiltered = $totalData; 
		
		$columns= $request->input('columns');
		foreach($columns as $c){ $sortcolumns[]=$c['data']; }
		
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $sortcolumns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        
		if($request->input('filters')){
			$query  =  Admin::select();
			$queryc =  Admin::select();
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
			 $rows = User::offset($start)->limit($limit)->orderBy($order,$dir)->get();
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
			
			
			$password = $request->input('password');
			
			if(!$password){
				
				$validatedData = $request->validate([
					'name'  => 'required|max:50',
					'email' => 'required',
					'avatar' => 'image',
					'phone' => 'required',
					'role' => 'required',
					'university' => '',
					'college' => '',
				]);
				
			}else{
				
				$validatedData = $request->validate([
					'name'  => 'required|max:50',
					'email' => 'required',
					'avatar' => 'image',
					'phone' => 'required',
					'role' => 'required',
					'university' => '',
					'college' => '',
					'password' => 'required',
                    'password_confirm' => 'required|same:password',
				]);
				
				
				$validatedData['password'] = bcrypt($validatedData['password']);
				
			}
			
			
			unset($validatedData['password_confirm']);
			
				//dd($validatedData);
			if($request->input('id')!=""){
				 
		        $id=$request->input('id');
				$uplodfile= Datatable::fileUpload($request,'avatar','avatars');
				if($uplodfile){ $validatedData['avatar']=$uplodfile; }
				Admin::whereId($id)->update($validatedData);
				$message= "User info updated sucessfully!";
				
			}else{
				Admin::create($validatedData);
				$message= "User info added sucessfully!";
			}
		    
			$json_data = array("status"  => true, "message"  => $message );
			
            echo json_encode($json_data);
		
		}else{
			   $id = $request->input('id');	
			   $formdata =  ($id!="")?Admin::findOrFail($id):"[]";
			   
			   if($id==""){
				   $formdata = new Admin;
			   }
				   
			   
			   $formdata->roles = Role::all();
			   $formdata->universities = University::all();
			   $formdata->colleges = College::all();
			  // dd($formdata);
			   
			   Datatable::setModule('admin')->viewFiles($option,$formdata);
		}
		
	}
	
	
	
	
    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('admin::create');
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
        return view('admin::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('admin::edit');
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
