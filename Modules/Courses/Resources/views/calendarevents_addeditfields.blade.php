<div class="row">
<?php
$namev=(isset($formdata->name))?$formdata->name:"";
$start_datev=(isset($formdata->start_date))?$formdata->start_date:"";
$end_datev=(isset($formdata->end_datev))?$formdata->end_datev:"";
?>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">

 {{ Datatable::FormInput(array("name"=>"name","label"=>"Name","type"=>"text","display"=>"full","value"=>$namev))}}

 
  {{ Datatable::FormInput(array("name"=>"start_date","label"=>"Start date","type"=>"text","display"=>"full","value"=>$start_datev))}}
 
 
  {{ Datatable::FormInput(array("name"=>"end_date","label"=>"End date","type"=>"text","display"=>"full","value"=>$end_datev))}}
 
 

 <script type="text/javascript">
    $("input[name='start_date']").datepicker({  
       format: 'dd-mm-yyyy'
     }); 

  $("input[name='end_date']").datepicker({  
       format: 'dd-mm-yyyy'
     });
	 
</script> 

				  
</div>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>