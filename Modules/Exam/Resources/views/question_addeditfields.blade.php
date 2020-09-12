<div class="row">
<?php

$explanationv=(isset($formdata->explanation))?$formdata->explanation:"";

$questionv=(isset($formdata->question))?$formdata->question:"";


//dd($formdata->questions_option);



?>



    <div class="form-group col-md-12">
                  <label class="col-md-3 col-form-label text-md-right float-left">
				  Courses:&nbsp</label>
				  <div class="col-md-9 float-left border-danger" >
                  <select name="course_id" class="form-control select2" style="width: 100%;">
				  
				  <option value=""  > 	Select Course </option>
				  
				  
				  <?php  foreach($formdata->courses as $v){ ?>
				    <option value="<?php echo $v['id']; ?>" 
					<?php 
                    if(isset($formdata->course_id)){
					if($v['id']==$formdata->course_id){ echo "selected='selected'"; }
					}
					?> >
					<?php echo $v['name']; ?>
					
					</option>
				  <?php }  ?>
				   
                  </select>
				  </div>
    </div>
	
  
  {{ Datatable::FormInput(array("name"=>"question","label"=>"Question","type"=>"textarea","display"=>"full","value"=>$questionv))}}
  
  {{ Datatable::FormInput(array("name"=>"explanation","label"=>"Explanation","type"=>"text", "display"=>"full","value"=>$explanationv))}}
  
  <?php $i=0;  if(isset($formdata->questions_option)){   ?>
     @foreach ($formdata->questions_option as $opn)
		  <?php $i += 1; ?>
		  {{ Datatable::FormInput(array("name"=>"qoption[]","label"=>"Option $i","type"=>"text", "display"=>"full","value"=>$opn->option))}}
	  @endforeach
  <?php }else{ ?>
     @for ($i = 1; $i < 5; $i++)
		 {{ Datatable::FormInput(array("name"=>"qoption[]","label"=>"Option $i","type"=>"text", "display"=>"full","value"=>""))}}
	 @endfor
  <?php } ?>
  
  
     <div class="form-group col-md-12">
                  <label class="col-md-3 col-form-label text-md-right float-left">
				  Correct:&nbsp</label>
				  <div class="col-md-9 float-left border-danger" >
                  		<div class="row">	
                             <?php $i = 1;
                             if(isset($formdata->questions_option)){
                             ?>
								@foreach ($formdata->questions_option as $opn)
                                <div class="col-md-3"><label class='radiolabel'>
								<input type="radio" name="correct"  value="{{ $opn->id }}"    
								<?php echo ($opn->correct==1)?"checked":""; ?>
								/> &nbsp; {{ "Option $i" }}
								</label></div>
								<?php $i += 1; ?>
								@endforeach		
							 <?php }else{  ?>
								@for ($i = 1; $i < 5; $i++)
								<div class="col-md-3"><label class='radiolabel'>	
							    <input type="radio" name="correct"  value="{{ $i }}" /> &nbsp; {{ "Option $i" }}</label>
							    </label></div>
								@endfor
							 <?php } ?>
							 
					    </div>
						<span class="error"></span>
				  
				  
				  
				  </div>
                </div>
				  
     </div>
 
 
 

				  
</div>