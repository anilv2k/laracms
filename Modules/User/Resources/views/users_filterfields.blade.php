<div class="row">


 {{ Datatable::FormInput(array("name"=>"name","label"=>"Name","type"=>"text"))}}
 
 
 	<div class="form-group col-md-6">
			<label class="col-md-3 col-form-label text-md-right float-left">
			College:&nbsp</label>
			<div class="col-md-9 float-left border-danger" >
			<select name="college_id" class="form-control select2" style="width: 100%;">
			
            <option value=""  >	Select College 	</option>
			<?php foreach($colleges as $v){ ?>
			<option value="{{ $v['id'] }}"  >
			{{ $v['name'] }}
			</option>
			<?php }  ?>

			</select>
			</div>
			</div> 
			
			
			
</div>