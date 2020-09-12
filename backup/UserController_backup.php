<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\user;
use Theme;
Use Datatable;

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
	    Datatable::setModule('user');
		Datatable::setFields(array('id','name','email','created_at'));
		Datatable::displayFields(array('id'=>'userid','name'=>'User Name'));
		Datatable::showfilters();
		Datatable::showActions(array('view','edit','delete'));
		Datatable::setListurl('user/allusers');
		
		return Theme::uses('admin')->view('user::list');
	}
	
	/**
     * Display a listing of the resource.
     * @return Response
     */
    public function allusers(Request $request)
    {   
	    $flfields = array('name'); // filter like fields
		
		
		$columns= $request->input('columns');
		foreach($columns as $c){ $sortcolumns[]=$c['data'];   }
			
	    $totalData = User::count();
        $totalFiltered = $totalData; 
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $sortcolumns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
            
        if(empty($request->input('search.value')))
        {            
            $rows = User::offset($start)->limit($limit)->orderBy($order,$dir)->get();
        }
        elseif($request->input('search.value')) {
			
			$search = $request->input('search.value'); 
     		$query =   User::select();
			$queryc  = User::select();
			
			foreach($columns as $column){
					$c=$column['data'];
					if($c!="options"){
						$query->orwhere($c,'LIKE',"%{$search}%");
						$queryc->orwhere($c,'LIKE',"%{$search}%");					
					}
			}
			
			$rows =  $query->offset($start)->limit($limit)->orderBy($order,$dir)->get();
	        $totalFiltered = $queryc->count();
        }
		
		
		
		if($request->input('filters')){
			$query = $queryc =  User::select();
			foreach($request->input('filters') as $f){
				 if($f['value']!=""){
						$k= $f['name'];	$v= $f['value'];
						if(in_array($k,$flfields)){
							$query->where($f['name'],'LIKE',"%{$v}%");
							$queryc->where($f['name'],'LIKE',"%{$v}%");
						}else{
							$query->where($f['name'],$v);
							$queryc->where($f['name'],$v);
						}					
				 }
			}
			$rows = $query->offset($start)->limit($limit)->orderBy($order,$dir)->get(); 				
			$totalFiltered = $queryc->count();
		}
		
        $data = array();
        if(!empty($rows))
        {
            foreach ($rows as $row)
            {   
			    $show =  route('user.show',$row->id);
                $edit =  route('user.edit',$row->id);
				
                foreach($columns as $column){
					$c=$column['data'];
					if(isset($row->$c))
					$nestedData[$c] = $row->$c;
				    else
					$nestedData[$c] = "";	
				}
				$nestedData['created_at'] = date('j M Y h:i a',strtotime($nestedData['created_at']));
				
				$nestedData['options'] = "000000000";
				/*
				$nestedData['options'] = "&emsp;<a href='{$show}' title='SHOW' ><span class='glyphicon glyphicon-list'></span></a>
                                          &emsp;<a href='{$edit}' title='EDIT' ><span class='glyphicon glyphicon-edit'></span></a>"; */
										  
			    $data[] = $nestedData;
            }
        }
		
		dd($data);
        $json_data = array(
                    "draw"            => intval($request->input('draw')),  
                    "recordsTotal"    => intval($totalData),  
                    "recordsFiltered" => intval($totalFiltered), 
                    "data"            => $data   
                    );
        echo json_encode($json_data); 
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
