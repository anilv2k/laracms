<div class="row">
<?php
$namev=(isset($formdata->name))?$formdata->name:"";
$emailv=(isset($formdata->email))?$formdata->email:"";

if(isset($formdata->image)){
	$image=url(Storage::url($formdata->image));
}else{
    $image="";	 
}


$excerptv=(isset($formdata->excerpt))?$formdata->excerpt:"";

$descriptionv=(isset($formdata->description))?$formdata->description:"";


?>


 {{ Datatable::FormInput(array("name"=>"name","label"=>"Name","type"=>"text", "display"=>"full","value"=>$namev))}}
 
  {{ Datatable::FormInput(array("name"=>"image",'label'=>'Image','type'=>'file',"display"=>"full","value"=>$image))}}
  
   {{ Datatable::FormInput(array("name"=>"excerpt","label"=>"Excerpt","type"=>"text", "display"=>"full","value"=>$excerptv))}}

  
  
   {{ Datatable::FormInput(array("name"=>"description","label"=>"Description","type"=>"textarea","display"=>"full","value"=>$descriptionv))}}
  
 
 
       <div class="form-group col-md-12 selections university"   >
                  <label class="col-md-3 col-form-label text-md-right float-left">
				  Level:&nbsp </label>
				  <div class="col-md-9 float-left border-danger" >
                  <select name="level" class="form-control select2" style="width: 100%;">
				  
				    
				    <option value="beginner" 
					<?php 
                    if(isset($formdata->level)){
					if("beginner"==$formdata->level){ echo "selected='selected'"; }
					}
					?> > Beginner 		</option>
				 
	                <option value="intermediate" 
					<?php 
                    if(isset($formdata->level)){
					if("intermediate"==$formdata->level){ echo "selected='selected'"; }
					}
					?> >Intermediate	</option>
					
					
					  <option value="advanced" 
					<?php 
                    if(isset($formdata->level)){
					if("advanced"==$formdata->level){ echo "selected='selected'"; }
					}
					?> >Advanced 		</option>
					
					
					
					


                  </select>
				  </div>
      </div>
 

      <div class="form-group col-md-12 selections university"   >
                  <label class="col-md-3 col-form-label text-md-right float-left">
				  User:&nbsp </label>
				  <div class="col-md-9 float-left border-danger" >
                  <select name="user_id" class="form-control select2" style="width: 100%;">
				  
				    <?php  foreach($formdata->users as $u){ ?>
				    <option value="<?php echo $u['id']; ?>" 
					<?php 
                    if(isset($formdata->user_id)){
					if($u['id']==$formdata->user_id){ echo "selected='selected'"; }
					}
					?> >
					
					<?php echo $u['name']; ?>
					
					</option>
				  <?php }  ?>
	              
                  </select>
				  </div>
      </div>
		
		
		

  
<script src="@asset("plugins/summernote/summernote-bs4.min.js")"></script>

<script>
  $(function () {
    // Summernote
    $('.textarea').summernote()
  })
</script>
 

