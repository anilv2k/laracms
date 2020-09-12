<div class="row">
<?php
$namev=(isset($formdata->name))?$formdata->name:"";
$emailv=(isset($formdata->email))?$formdata->email:"";
$phonev=(isset($formdata->phone))?$formdata->phone:"";
$rolev=(isset($formdata->role))?$formdata->role:"";

if(isset($formdata->avatar)){
	$avatar=url(Storage::url($formdata->avatar));
}else{
    $avatar="";	 
}

?>


 {{ Datatable::FormInput(array("name"=>"name","label"=>"Name","type"=>"text","display"=>"full","value"=>$namev))}}
 
 {{ Datatable::FormInput(array("name"=>"email",'label'=>'E-Mail','type'=>'text',"display"=>"full","value"=>$emailv))}}
 
 {{ Datatable::FormInput(array("name"=>"password",'label'=>'Password','type'=>'text',"display"=>"full","value"=>''))}}
  
 {{ Datatable::FormInput(array("name"=>"password_confirm",'label'=>'Confirm Password','type'=>'text',"display"=>"full","value"=>''))}}
   
 
 {{ Datatable::FormInput(array("name"=>"avatar",'label'=>'Avatar','type'=>'file',"display"=>"full","value"=>$avatar))}}
 
 {{ Datatable::FormInput(array("name"=>"phone",'label'=>'Phone','type'=>'text',"display"=>"full","value"=>$phonev))}}
 
 
  
 
 <?php
 
 
//print_r($formdata->roles);

//echo $formdata->role;
?>

    <div class="form-group col-md-12" >
                  <label class="col-md-3 col-form-label text-md-right float-left">
				  Role:&nbsp </label>
				  <div class="col-md-9 float-left border-danger" >
                  <select id="roleselect" name="role" class="form-control select2" style="width: 100%;">
				  
				  <?php  foreach($formdata->roles as $r){ ?>
				    <option value="<?php echo $r['slug']; ?>" 
					<?php 
                    if(isset($formdata->role)){
					if($r['slug']==$formdata->role){ echo "selected='selected'"; }
					}
					?> >
					<?php echo $r['name']; ?>
					
					</option>
				  <?php }  ?>
	              
                  </select>
				  </div>
     </div>
				  


    <div class="form-group col-md-12 selections university"  style="display:{{ ($rolev=='university')?'blnak':'none' }}"  >
                  <label class="col-md-3 col-form-label text-md-right float-left">
				  University:&nbsp </label>
				  <div class="col-md-9 float-left border-danger" >
                  <select name="university" class="form-control select2" style="width: 100%;">
				  
				  <?php  foreach($formdata->universities as $un){ ?>
				    <option value="<?php echo $un['id']; ?>" 
					<?php 
                    if(isset($formdata->university)){
					if($un['id']==$formdata->university){ echo "selected='selected'"; }
					}
					?> >
					<?php echo $un['name']; ?>
					
					</option>
				  <?php }  ?>
	              
                  </select>
				  </div>
     </div>
				  


    <div class="form-group col-md-12 selections college" style="display:{{ ($rolev=='college')?'blnak':'none' }}"  >
                  <label class="col-md-3 col-form-label text-md-right float-left">
				  College:&nbsp </label>
				  <div class="col-md-9 float-left border-danger" >
                  <select name="college" class="form-control select2" style="width: 100%;">
				  
				  <?php  foreach($formdata->colleges as $c){ ?>
				    <option value="<?php echo $c['id']; ?>" 
					<?php 
                    if(isset($formdata->college)){
					if($c['id']==$formdata->college){ echo "selected='selected'"; }
					}
					?> >
					<?php echo $c['name']; ?>
					
					</option>
				  <?php }  ?>
	              
                  </select>
				  </div>
     </div>
			




			
</div>



<script>
$( "#roleselect" ).change(function() {
	
	$(".selections").hide();
	
	var role=$( "#roleselect" ).val();
	
	if(role=='university') { $(".university").show();  }
	if(role=='college') { $(".college").show();  }
	
	
});
</script>