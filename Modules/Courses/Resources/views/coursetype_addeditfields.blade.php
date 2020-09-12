<div class="row">
<?php
$namev=(isset($formdata->name))?$formdata->name:"";


?>


 {{ Datatable::FormInput(array("name"=>"name","label"=>"Name","type"=>"text", "display"=>"full","value"=>$namev))}}
 
		
