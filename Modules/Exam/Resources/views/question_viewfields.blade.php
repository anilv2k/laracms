
<div class="row">
<?php 
$name=(isset($formdata->name))?$formdata->name:"";
$email=(isset($formdata->email))?$formdata->email:"";
?>

 {{ Datatable::FormView(array('label'=>'Name',"value"=>$name,"display"=>"full1"))}}

 {{ Datatable::FormView(array('label'=>'E-Mail Address',"value"=>$email))}}
				
</div>