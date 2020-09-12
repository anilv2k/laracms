<?php

namespace Modules\Cms\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Theme,Datatable;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
		 
		$settings= \Modules\Cms\Entities\Setting::all();
		
		$optns= array();
		foreach ($settings as $setting) {
		
		$optns[$setting->name]=$setting->value;
		
		}
		 
		$options['options'] =$optns;
        return Theme::uses('admin')->view('cms::settings',$options);
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
         $request = $request->post();
		 
		foreach ($request as $key => $value) {
           
           \Modules\Cms\Entities\Setting::where('name', $key)->update(['value' => $value]);
			
        }

        return ['status'=>true];
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
