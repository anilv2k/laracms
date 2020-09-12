<?php 

namespace Anilv2k\Datatable;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Modules\Settings\Entities\Setting;

use URL;
use Theme;

class Datatable 
{
    
    public $fields = array();
	
	public $dfields = array();
	
	public $showActions =array();
	
	public $hiddenFilters = array(); 
	
	public $listurl="";
	
	public $optionurl="";
	
	public $subject="Record";
	
	public $hasFilter=true;
	
	public $modelname;
	
	public $module="cms";
	
	public $slug="customtable";
	
	public $unique_value="";
	
	public $formdata = array();

    public function __construct()
    {
        Theme::asset()->serve('datatables');
    }
  
    public function setListurl($listurl){
		
		$this->listurl=$listurl;
        return $this;
    }
	
	public function setOptionurl($optionurl){
		
		$this->optionurl=$optionurl;
        return $this;
    }
	
	public function setSubject($subject){
		
		$this->subject=$subject;
		return $this;
    }
	
	public function setFields($fields){
		
		$this->fields=$fields;
		return $this;
    }
	
	public function setModule($module){
		
		$this->module=$module;
		return $this;
    }
	
	
	public function displayFields($fields){
		
		$this->dfields=$fields;
		return $this;
    }
	
	public function showFilters($flag=true){
		
		if($flag==0)
		$this->hasFilter=false; 
        else
		$this->hasFilter=1; 
	
	
		 
		$this->unique_value= $flag;
		 
		return $this;
    }
	
	public function usersCount($model){
		
		$this->modelname=$model;
		
		$c="3";
		$c = $model::count();
		
		return $c;
	}
    public function display($data=array()){
      
	  //if($slug!="") $this->slug=$slug;
	  
	 
	  $this->formdata=$data;
	  
 	  require(__DIR__ . '/views/datatable.php');
      
    }
	
	
	public function filterFileds($type=""){
      
	  /*
	   // echo  Module::getPath().'\User\Resources\views'.$this->slug.'_filterfields';
	 // echo view($this->module.'::'.$this->slug.'_filterfields');
	   //parent::showfilter;
	    
	  //  $viewfile=	$this->slug.'_filterfields';
		
	   if(\Illuminate\Support\Facades\View::exist($this->module.'::'.$this->slug.'_filterfields')){
		  echo view($this->module.'::'.$this->slug.'_filterfields'); 
	   }else{
		   
		   echo "-------";
	   }
      */
	  
	  
	  
	  $this->hasFilter=1; 	
	  
	// dd($this->unique_value);
	 
	 if(!is_array($this->formdata)){
	    $this->formdata =array();
	 }
	  
	  if(($this->unique_value=="") or ($this->unique_value==1) ){
	    echo view($this->module.'::curd_filterfields',$this->formdata); 
      }else{
		  
		 //$this->unique_value.'_filterfields',$this->formdata;
		  // die;
		echo view($this->module.'::'.$this->unique_value.'_filterfields',$this->formdata); 	  
	  }
	  
	  
    }
	
	public function showActions(){
		//$this->showActions=$actions;
		
		
		array_push($this->fields,'options');
		return $this;
	}
	
	public function getFields(){
		
		//print_r($this->fields);
		
		return $this->fields;
	}
	
	public function FormInput($attr){
		
		//echo "0000000000000";
		require(__DIR__ . '/views/forminputfields.php');
		
	}
	
	public function FormView($attr){
		
		
		require(__DIR__ . '/views/formviewfields.php');
		
	}
	
	
	public function fileUpload(Request $request,$file,$path="files"){
		
		$fileurl="";
		
		if($request->hasFile($file)){
			
					$filenameWithExt = $request->file($file)->getClientOriginalName();
					$filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
					$extension = $request->file($file)->getClientOriginalExtension();
					$fileNameToStore = $filename.'_'.time().'.'.$extension;
					$fileurl = $request->file($file)->storeAs('public/'.$path,$fileNameToStore);
			
			
		}
		return $fileurl;
	}
	
	public function setActions($actions){
	    $this->showActions=$actions;
		array_push($this->fields,'options');
		return $this;
	}
	
	public function getActions($id,$actions){
		
        array_push($this->fields,'options');		
		$options="";
		
		if(in_array('view',$actions)){
		$options .= "&emsp;<a  href='javascript:void(0)' onclick='crud_view({$id})' ><span class='btn btn-sm btn-info'>View</span></a>"; 	}
		
		if(in_array('edit',$actions)){
		$options .= "&emsp;<a href='javascript:void(0)' onclick='crud_edit($id)'  ><span class='btn btn-sm btn-primary'>Edit</span></a>"; }
		
		if(in_array('delete',$actions)){
	    $options .= "&emsp;<a href='javascript:void(0)' onclick='crud_delete($id)'  ><span class='btn btn-sm btn-danger'>Delete</span></a>"; }
		
		return $options;
	}
	
	public function viewFiles($option,$formdata="",$view=""){

    	if($option=='filter'){
			
				if($view=="")
				echo view($this->module.'::curd_filterfields'); 
			    else
				echo view($this->module.'::'.$view.'_filterfields'); 
				
				exit;
				
		}elseif($option=='view'){
			    if($view=="")
				echo view($this->module.'::curd_viewfields',compact('formdata')); 
                else
				echo view($this->module.'::'.$view.'_viewfields',compact('formdata')); 
			
     			exit;
		}elseif(in_array($option,array('add','edit'))){
			
			    if($view=="")
				echo view($this->module.'::curd_addeditfields',compact('formdata')); 
				else
				echo view($this->module.'::'.$view.'_addeditfields',compact('formdata')); 	
				
				exit;
		}
	}
	
	public function getLayouts(){
		
		//$app_theme=env('APP_THEME', false);
		
		
		$sett = new Setting();
        $app_theme= $sett->where('name','site_theme')->first()->value; 
		
	    
		$path= public_path().DIRECTORY_SEPARATOR.'themes'.DIRECTORY_SEPARATOR.$app_theme.DIRECTORY_SEPARATOR.'layouts/';
		$files = scandir($path); 
		
		$template=array();
			foreach($files as $file){

			if(is_file($path.$file) and strstr($path.$file,'.php')){
				
			$temp= @$this->get_file_data( $path.$file);
			$template[] =array('id'=>str_replace(".blade.php","",$file),'name'=>$temp['Name']);

			}
		}
		
		return $template;
	}
	
	public  function get_file_data($file) {
    
	 
	
	 
    $default_headers = array(
        'Name'        => 'Theme Name',
        'ThemeURI'    => 'Theme URI',
        'Description' => 'Description',
        'Author'      => 'Author',
        'AuthorURI'   => 'Author URI',
        'Version'     => 'Version'
        
     );


    $fp = fopen( $file, 'r' );
    $file_data = fread( $fp, 8192 );
    fclose( $fp );
    $file_data = str_replace( "\r", "\n", $file_data );
    $all_headers = $default_headers;

    foreach ( $all_headers as $field => $regex ) {
        if (preg_match( '/^[ \t\/*#@]*' . preg_quote( $regex, '/' ) . ':(.*)$/mi', $file_data, $match ) 
            && $match[1])
            $all_headers[ $field ] = trim(preg_replace("/\s*(?:\*\/|\?>).*/", '', $match[1]));
        else
            $all_headers[ $field ] = '';
    }
	
    $all_headers['Path'] = $file;
	
    return $all_headers;
	
	
    }

	public function ajaxList(){
		
		echo "0000000000000000000";
	}

}
