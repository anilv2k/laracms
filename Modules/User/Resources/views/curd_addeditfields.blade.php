<div class="row">
<?php
$namev=(isset($formdata->name))?$formdata->name:"";
$emailv=(isset($formdata->email))?$formdata->email:"";

$phonev=(isset($formdata->phone))?$formdata->phone:"";

if(isset($formdata->avatar)){
	$avatar=url(Storage::url($formdata->avatar));
}else{
    $avatar="";	 
}

?>


 {{ Datatable::FormInput(array("name"=>"name","label"=>"Name","type"=>"text","display"=>"full","value"=>$namev))}}
 
 {{ Datatable::FormInput(array("name"=>"email",'label'=>'E-Mail','type'=>'text',"display"=>"full","value"=>$emailv))}}
 
 {{ Datatable::FormInput(array("name"=>"avatar",'label'=>'Avatar','type'=>'file',"display"=>"full","value"=>$avatar))}}
 

 {{ Datatable::FormInput(array("name"=>"phone",'label'=>'Phone','type'=>'text',"display"=>"full","value"=>$phonev))}}


 
</div>