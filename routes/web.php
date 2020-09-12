<?php

use Nwidart\Modules\Facades\Module;

/*
class Fish{
	
	public function swim(){
		return 'swimming';
	}
	
	public function eat(){
		return 'swimming';
	}
	  
}

app()->bind('fish',function(){

	return new Fish;
});

class FishFacade {

	public static function __callStatic($name,$args){

		//dd($name);
		return app()->make('fish')->$name();

	}
}

dd(FishFacade::eat());

*/

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



/*
Route::get('/', function () {
    return view('welcome');
});
*/

//Route::get('/', '\Modules\Cms\Http\Controllers\CmsController@index');