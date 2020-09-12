<div class="row">
<?php
$namev=(isset($formdata->name))?$formdata->name:"";
$emailv=(isset($formdata->email))?$formdata->email:"";

if(isset($formdata->avatar)){
	$avatar=url(Storage::url($formdata->avatar));
}else{
    $avatar="";	 
}

$universites=(isset($formdata->universites))?$formdata->universites:array();

//print_r($formdata->universities);
$university="";
?>


 {{ Datatable::FormInput(array("name"=>"name","label"=>"Name","type"=>"text", "display"=>"full","value"=>$namev))}}
 
 {{ Datatable::FormInput(array("name"=>"email",'label'=>'E-Mail','type'=>'text', "display"=>"full","value"=>$emailv))}}
 
<?php /*
 {{Datatable::FormInput(array("name"=>"university_id","label"=>"University","type"=>"select","display"=>"full","values"=>$universites,"value"=>$university))}} */ ?>
 
 <?php

	$universities=Modules\Courses\Entities\University::all();

		foreach($universities as $university){
		$u[]= array('id'=>$university->id, 'name'=>$university->name);
		}

		$universities=$u;
		


 //dd($universities); 
 
 ?>
    <div class="form-group col-md-12">
                  <label class="col-md-3 col-form-label text-md-right float-left">
				  University:&nbsp</label>
				  <div class="col-md-9 float-left border-danger" >
                  <select name="university_id" class="form-control select2" style="width: 100%;">
				  
				  <?php  foreach($universities as $v){ ?>
				    <option value="<?php echo $v['id']; ?>" 
					<?php 
                    if(isset($formdata->university_id)){
					if($v['id']==$formdata->university_id){ echo "selected='selected'"; }
					}
					?> >
					<?php echo $v['name']; ?>
					
					</option>
				  <?php }  ?>
				   
                  </select>
				  </div>
    </div>
				  
</div>