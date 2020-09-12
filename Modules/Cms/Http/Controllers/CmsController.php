<?php

namespace Modules\Cms\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;
use Modules\Cms\Entities\Pages;
use Theme;

class CmsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    { 
	     
	   Theme::layout('homepage');
	   
	   return Theme::view('cms::index');
      
    }

	
	  /**
     * Display a listing of the resource.
     * @return Response
     */
    public function page($page)
    {
        $data = [];
        $page_types = Pages::wherePageType($page)->count();
        
        if(!empty($page_types)){
            $page_types = Pages::wherePageType($page)->paginate(2);
            $data['pages'] = $page_types;
            if(request()->ajax()){
                $res['data'] = (string)view('cms::page_type_content', $data);
                $res['links'] = (string)$page_types->links();
                return $res;
            }
            $data['page_type'] = $page;
            return Theme::view('cms::page_type',$data);
        }

        $page = Pages::whereSlug($page)->firstOrFail();

		$data['page']=$page;
		
		Theme::setPagetitle($page->title);
		Theme::layout($page->layout);
		
		return Theme::view('cms::pagedetail',$data);
 
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
