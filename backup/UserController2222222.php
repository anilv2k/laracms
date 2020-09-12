<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\User\Entities\User;
use Illuminate\Support\Facades\Storage;
use Theme;
Use Datatable;
Use Module;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {   
	   return Theme::view('user::index');
    }
	
	 /**
     * Display a listing of the resource.
     * @return Response
     */
    public function dashboard()
    {   
	   
		return Theme::view('user::dashboard');
    }
	
	
	 /**
     * Display a login.
     * @return Response
     */
    public function login()
    {   
	    return Theme::view('user::login');
    }
	
	
	/**
     * Display a login.
     * @return Response
     */
    public function dologin()
    {   
	       $json_data = array(
                    "error" => "invalid login details", 
                    "status" => true   
           );
            
        echo json_encode($json_data); 
    }
	
	
	 /**
     * Display a listing of the resource.
     * @return Response
     */
    public function mycourses()
    {   
	   
		return Theme::view('user::mycourses');
    }
	
	
	 /**
     * Display a listing of the resource.
     * @return Response
     */
    public function list()
    {   
	
	  dd('7777777');
	
	   /* $users =  Modules\User\Entities\State::find(1)->users();
		
		dd($users); die;
	
		*/
		 
	
	   // Datatable::setFields(array('id','name','email','created_at'))->setModule('user')->setSubject('user')->showFilters(1);
		//Datatable::displayFields(array('id'=>'User ID','name'=>'User Name'))->setListurl('user/ajax_list')->showActions();
			
     	//return Theme::uses('admin')->view('user::list');
	}
	
	/**
     * Display a listing of the resource.
     * @return Response
     */
    public function ajax_list(Request $request)
    {   
	    $flfields = array('name','email'); // filter like fields
		
		Datatable::showActions(array('view','edit','delete'));
		
		
			
	    $totalData = User::count();
		
        $totalFiltered = $totalData; 
		
		$columns= $request->input('columns');
		foreach($columns as $c){ $sortcolumns[]=$c['data']; }
		
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $sortcolumns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        
		if($request->input('filters')){
			$query  =  User::select();
			$queryc =  User::select();
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
			
               /* foreach($columns as $column){
					$c=$column['data'];
					if(isset($row->$c))
					$nestedData[$c] = $row->$c;
				    else
					$nestedData[$c] = "";	
				} 
				
				$nestedData['id'] = sprintf("%08d", $nestedData['id']);
				$nestedData['created_at'] = date('j M Y h:i a',strtotime($nestedData['created_at']));
				
				$nestedData['options'] = Datatable::getActions($row->id,array('view','edit'));
				
			    $data[] = $nestedData; */
				$row['options']= "";
				$data[]= $row;
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
				'name'  => 'required|max:20',
				'email' => 'required',
				'avatar' => 'image'
			]);
				
			if($request->input('id')!=""){
				 
		        $id=$request->input('id');
				$uplodfile= Datatable::fileUpload($request,'avatar','avatars');
				if($uplodfile){ $validatedData['avatar']=$uplodfile; }
				User::whereId($id)->update($validatedData);
				$message= "User info updated sucessfully!";
				
			}else{
				User::create($validatedData);
				$message= "User info added sucessfully!";
			}
		    
			$json_data = array("status"  => true, "message"  => $message );
			
            echo json_encode($json_data);
		
		}else{
			   $id = $request->input('id');	
			   $formdata =  ($id!="")?User::findOrFail($id):"";
			   Datatable::viewFiles($option,$formdata);
		}
		
	}
	
    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('user::create');
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
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('user::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('user::edit');
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
