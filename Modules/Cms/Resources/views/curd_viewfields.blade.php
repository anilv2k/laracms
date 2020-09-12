
<div class="row">
<?php 
$title=(isset($formdata->title))?$formdata->title:"";

?>

 {{ Datatable::FormView(array('label'=>'Title',"value"=>$title,"display"=>"full1"))}}

				
</div>