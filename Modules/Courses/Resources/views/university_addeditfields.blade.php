<div class="row">
<?php
$namev=(isset($formdata->name))?$formdata->name:"";
$emailv=(isset($formdata->email))?$formdata->email:"";

if(isset($formdata->image)){
	$image=url(Storage::url($formdata->image));
}else{
    $image="";	 
}

if(isset($formdata->logo)){
	$logo=url(Storage::url($formdata->logo));
}else{
    $logo="";	 
}

if(isset($formdata->banner)){
	$banner=url(Storage::url($formdata->banner));
}else{
    $banner="";	 
}

$addressv=(isset($formdata->address))?$formdata->address:"";
$phonev=(isset($formdata->phone))?$formdata->phone:"";
$weburlv=(isset($formdata->weburl))?$formdata->weburl:"";
$shortcodev=(isset($formdata->shortcode))?$formdata->shortcode:"";

$descriptionv=(isset($formdata->description))?$formdata->description:"";
$banner_captionv=(isset($formdata->banner_caption))?$formdata->banner_caption:"";

$shortdescv=(isset($formdata->shortdesc))?$formdata->shortdesc:"";


?>


{{ Datatable::FormInput(array("name"=>"name","label"=>"Name","type"=>"text","display"=>"full","value"=>$namev))}}

{{ Datatable::FormInput(array("name"=>"email",'label'=>'E-Mail','type'=>'text',"display"=>"full","value"=>$emailv))}}

{{ Datatable::FormInput(array("name"=>"phone",'label'=>'Phone','type'=>'text',"display"=>"full","value"=>$phonev))}}

{{ Datatable::FormInput(array("name"=>"weburl",'label'=>'Web URL','type'=>'text',"display"=>"full","value"=>$weburlv))}}

{{ Datatable::FormInput(array("name"=>"image",'label'=>'Image','type'=>'file',"display"=>"full","value"=>$image))}}

{{ Datatable::FormInput(array("name"=>"address","label"=>"Address","type"=>"text", "display"=>"full","value"=>$addressv))}}


{{ Datatable::FormInput(array("name"=>"shortdesc","label"=>"Short Description","type"=>"textarea","display"=>"full","value"=>$shortdescv)) }}

{{ Datatable::FormInput(array("name"=>"description","label"=>"Description","type"=>"textarea","display"=>"full","value"=>$descriptionv)) }}

{{ Datatable::FormInput(array("name"=>"banner_caption","label"=>"Banner Caption","type"=>"textarea","display"=>"full","value"=>$banner_captionv))}}


{{ Datatable::FormInput(array("name"=>"shortcode",'label'=>'Shortcode','type'=>'text',"display"=>"full","value"=>$shortcodev))}}
  
  {{ Datatable::FormInput(array("name"=>"logo",'label'=>'Logo','type'=>'file',"display"=>"full","value"=>$logo))}}
    
  {{ Datatable::FormInput(array("name"=>"banner",'label'=>'Banner','type'=>'file',"display"=>"full","value"=>$banner))}}
  
  
  
<script src="@asset("plugins/summernote/summernote-bs4.min.js")"></script>

<script>
  $(function () {
    // Summernote
    $('.textarea').summernote()
  })
</script>
 
 

				  
</div>