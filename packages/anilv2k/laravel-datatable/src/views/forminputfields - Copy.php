

<?php 
if(($attr['type']=='text')  ) {
	
	$display= (isset($attr['display']) and ($attr['display']=='full'))?"col-md-12":"col-md-6"; 
	
	$readonly="";
	if(isset($attr['slugfield'])){
		
		$readonly="readonly";
	}?>
	
	<div class="form-group <?php echo $display; ?>">
	
				<label  class="<?php echo ($attr['display']=='full')?"col-md-3":"col-md-4"; ?> col-form-label text-md-right float-left">
				<?php echo (isset($attr['label']))?$attr['label']:"Label"; ?>:&nbsp </label>
				
				<div class="<?php echo ($attr['display']=='full')?"col-md-9":"col-md-6"; ?> float-left border-danger">
				<input type="text" class="form-control" name="<?php echo (isset($attr['name']))?$attr['name']:"fieldname"; ?>" 
				value='<?php echo (isset($attr['value']))?$attr['value']:""; ?>'  <?php echo $readonly; ?>  >
				<span class="error"></span>
	
				</div>
    </div>
	
	<?php if(isset($attr['slugfield'])){ ?>
		<script>
		
		$('input[name=<?php echo $attr['slugfield']; ?>]').keyup(function(){
    var Text = $(this).val();
    Text = Text.toLowerCase();
    Text = Text.replace('/\s/g','-');
	Text = Text.replace(/ /g, "_"); 
    $('input[name=<?php echo $attr['name']; ?>]').val(Text);    
});
		</script>
		
	<?php } ?>
	
<?php }else if(($attr['type']=='textarea') )  {
	
	$display= (isset($attr['display']) and ($attr['display']=='full'))?"col-md-12":"col-md-6"; 
	
	?>
	
	<div class="form-group <?php echo $display; ?>">
				<label  class="col-md-3 col-form-label text-md-right float-left">
				<?php echo (isset($attr['label']))?$attr['label']:"Label"; ?>:&nbsp </label>
				<div class="col-md-9 float-left border-danger">
	
	<textarea class="form-control textarea" name="<?php echo (isset($attr['name']))?$attr['name']:"fieldname"; ?>" >
<?php echo (isset($attr['value']))?$attr['value']:""; ?>
  </textarea>
  
	
	<span class="error"></span>
	
				</div>
</div>
	
<?php } else if(($attr['type']=='file')  ) {
	
	$display= (isset($attr['display']) and ($attr['display']=='full'))?"col-md-12":"col-md-6"; 
	
	?>
	
	<div class="form-group <?php echo $display; ?>">
				
				
				
				<label  class="col-md-4 col-form-label text-md-right float-left">
				<?php echo (isset($attr['label']))?$attr['label']:"Label"; ?>:&nbsp </label>
				<div class="col-md-6 float-left border-danger">
	
	  <img src="<?php echo (isset($attr['value']))?$attr['value']:""; ?>" width="200px;" class="img-responsive img-thumbnail" style="margin:5px;" />
	   <div class="custom-file">
                      <input type="file" name="avatar" class="custom-file-input" id="customFile">
					  <span class="error"></span>
                      <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
					
					
					
	
				</div>
				
				
				
</div>
	
<?php }else if(($attr['type']=='select')  ) { 

$display= (isset($attr['display']) and ($attr['display']=='full'))?"col-md-12":"col-md-6"; 


 ?>

    <div class="form-group <?php echo $display; ?>">
                  <label class="<?php echo ($attr['display']=='full')?"col-md-3":"col-md-4"; ?> col-form-label text-md-right float-left"><?php echo (isset($attr['label']))?$attr['label']:"Label"; ?>:&nbsp</label>
				  <div class="<?php echo ($attr['display']=='full')?"col-md-9":"col-md-6"; ?> float-left border-danger" >
                  <select name="<?php echo (isset($attr['name']))?$attr['name']:"fieldname"; ?>" class="form-control select2" style="width: 100%;">
				  
				  <?php  foreach($attr['values'] as $v){ ?>
				    <option value="<?php echo $v['id']; ?>" 
					<?php if($v['id']==$attr['value']){ echo "selected='selected'"; }?> >
					<?php echo $v['name']; ?>
					
					</option>
				  <?php }  ?>
				  
                  
                    
                  </select>
				  </div>
                </div>

<?php } ?>