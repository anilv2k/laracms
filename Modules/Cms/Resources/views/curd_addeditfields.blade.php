
  <!-- summernote -->
  <link rel="stylesheet" href="@asset("plugins/summernote/summernote-bs4.css")">

<div class="row">
<?php
$title=(isset($formdata->title))?$formdata->title:"";
$slug=(isset($formdata->slug))?$formdata->slug:"";
$description=(isset($formdata->description))?$formdata->description:"";
$layout=(isset($formdata->layout))?$formdata->layout:"layout";

$layouts=(isset($formdata->layouts))?$formdata->layouts:array();
/*
echo "<pre>";
print_r($layouts);
echo "</pre>"; */

?>


 {{ Datatable::FormInput(array("name"=>"title","label"=>"Title","type"=>"text","display"=>"full","value"=>$title))}}
 
 {{ Datatable::FormInput(array("name"=>"slug","label"=>"Slug","type"=>"text","slugfield"=>"title","display"=>"full","value"=>$slug))}}
 
 {{ Datatable::FormInput(array("name"=>"description","label"=>"Description","type"=>"textarea","display"=>"full","value"=>$description))}}
 
 {{Datatable::FormInput(array("name"=>"layout","label"=>"Layout","type"=>"select","display"=>"full","values"=>$layouts,"value"=>$layout))}}
 
 
 
<?php 
   $ffilter = request()->input('ffilter');
   if(isset($ffilter)){
	   $ffilter=json_decode($ffilter);
	   foreach($ffilter as $k =>$f){  	   ?>
   <input type="hidden"  name="{{$f->name}}" value="{{$f->value}}" />
		   <?php
	   }
   }
?>
			  
</div>

<script src="@asset("plugins/summernote/summernote-bs4.min.js")"></script>

<script>
  $(function () {
    // Summernote
    $('.textarea').summernote()
  })
</script>