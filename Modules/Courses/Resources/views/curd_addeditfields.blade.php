<div class="row">
<?php
$namev=(isset($formdata->name))?$formdata->name:"";
$emailv=(isset($formdata->email))?$formdata->email:"";

if(isset($formdata->avatar)){
	$avatar=url(Storage::url($formdata->avatar));
}else{
    $avatar="";	 
}

?>


 {{ Datatable::FormInput(array("name"=>"name","label"=>"Name","type"=>"text","value"=>$namev))}}
 
 {{ Datatable::FormInput(array("name"=>"email",'label'=>'E-Mail','type'=>'text',"value"=>$emailv))}}
 

 

				  
</div>