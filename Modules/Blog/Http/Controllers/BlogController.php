<?php

namespace Modules\Blog\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

//use App\User;
//user App\Auth;

use Illuminate\Support\Facades\Auth;


class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
		/* $manager = new User();
		$manager->name = 'Kumar Vinnakota';
		$manager->email = 'kumar@gmail.com';
		$manager->password = bcrypt('kumar');
		$manager->save(); */
		
		//Auth::loginUsingId(1, true);
		$email = "anil@gmail.com";
		$password = "anil";

	/*
if (Auth::guard('web')->attempt(['email' => $email, 'password' => $password])) {
	
	// return redirect()->intended('/cms');
	//dd("User Authanticated!");
    // The user is active, not suspended, and exists.
	
	return true;
} */

/*
if(Auth::loginUsingId(2, true)){
	
	return true;
}
*/

$user = Auth::user();
return $user;
/*
//Auth::loginUsingId(2, true);


		
		//echo $id = Auth::id(); 
		
		//echo $user->name;
		//die;
		
		/*$data = request()->session()->all();
		//dd($data);
		//dd($user);
		return $user;
		//die;
		
		\LogActivity::addToLog('My Testing Add To Log.');
        dd('log insert successfully.');
		
		*/
		
	    \LogActivity::addToLog('My Testing Add To Log.');
        dd('My log insert successfully.1111111111111');
		
        return view('blog::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('blog::create');
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
        return view('blog::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('blog::edit');
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
