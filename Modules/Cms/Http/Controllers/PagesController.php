<?php

namespace Modules\Cms\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Cms\Entities\Pages;
use Illuminate\Support\Facades\Storage;
//use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

use Theme,Datatable,File;



class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
		return view('cms::index');
    }

	
	public function list($type='page')
    {   
	    
		
		
		$data['page_type']= $type;
	
	    Datatable::setFields(array('id','title','created_at'))->setModule('cms')->setSubject('Pages')->showFilters(1);
		Datatable::displayFields(array('id'=>'ID','title'=>'Title'))->setListurl('cms/ajax_list')->setOptionurl('cms/ajax_options')->showActions();
	
	
     	return Theme::uses('admin')->view('cms::pageslist',$data);

	}
	
	
	
	/**
     * Display a listing of the resource.
     * @return Response
     */
    public function ajax_list(Request $request)
    {   
	    $flfields = array('title'); 
		
		$where = "page_type";
		$page_type="news"; 
		
		
		$ffilter=$request->input('ffilter');
		
		//echo "<br/>";
		//print_r($ffilter);
		
		$wlist =array();
		
		foreach($ffilter as $k => $fltr){
			
			$wlist[]=array($fltr['name'],$fltr['value']);
		}
		
	//	print_r($wlist);
		
		
		//		$wherelist =array(array('page_type','page'));
				
		//	print_r($wherelist);		
				
//		die;
		
$wherelist=$wlist;

		//Datatable::showActions(array('view','edit','delete'));
		
		$columns= $request->input('columns');
		foreach($columns as $c){ $sortcolumns[]=$c['data']; }
		
	    $totalData = Pages::where($wherelist)->count(); 
		
        $totalFiltered = $totalData; 
		
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $sortcolumns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        
		if($request->input('filters')){
			$query  =  Pages::where($wherelist)->select();
			$queryc =  Pages::where($wherelist)->select();
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
			$qry= $query->offset($start)->limit($limit)->orderBy($order,$dir); 
			
			
			//DB::enableQueryLog();
			$rows = $qry->get(); 				
			
			//$query = DB::getQueryLog();

            //dd($query);
			//print_r($qry->sql); die;
			
			$totalFiltered = $queryc->count();

		}else{
			 $rows = Pages::offset($start)->limit($limit)->orderBy($order,$dir)->get();
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
				'title'  => 'required|max:200',
				'slug'  => 'required',
				'layout'  => 'required',
				'description'  => 'required',
				'page_type'  => 'required',
			]);
				
			if($request->input('id')!=""){
				 
		        $id=$request->input('id');
				Pages::whereId($id)->update($validatedData);
				$message= "Page info updated sucessfully!";
				
			}else{
				Pages::create($validatedData);
				$message= "Page info added sucessfully!";
			}
		    
			$json_data = array("status"  => true, "message"  => $message );
			
            echo json_encode($json_data);
		
		}else{
			   $id = $request->input('id');	
			   $formdata =  ($id!="")?Pages::findOrFail($id):"";
			   
			   if($id==""){  $formdata =(object)array(); } 
			   $formdata->layouts=Datatable::getLayouts();
				 
			   Datatable::setModule('cms')->viewFiles($option,$formdata);
		}
		
	}
	
	
    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('cms::create');
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
        return view('cms::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('cms::edit');
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
