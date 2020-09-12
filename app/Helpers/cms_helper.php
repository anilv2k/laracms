<?php






   function site_data($field=""){
	   
	  // echo config('app.subsiteid'); die;
	   
	   $subsiteid=config("app.subsiteid");
	   
       $university = Modules\Courses\Entities\University::where('id',$subsiteid)->first();
	    
		if(!isset( $university)){
			$university = new Modules\Courses\Entities\University;
		}	
			
				if(isset($university->image)){
				$university->image=url(Storage::url($university->image));
				}else{
				$university->image=@asset("assets/img/aboutus.png");	  
				}

				if(isset($university->logo)){
				$university->logo=url(Storage::url($university->logo));
				}else{
				$university->logo=@asset("assets/img/logo.png");	 
				}

				if(isset($university->banner)){
				$university->banner=url(Storage::url($university->banner));
				}else{
				$university->banner=@asset("assets/img/banner.jpg");	 
				}
			  
			  
			  if($field)
			  return $university->$field;
			  else
			  return "";

  
   }
