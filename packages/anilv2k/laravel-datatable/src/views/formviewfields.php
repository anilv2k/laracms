
<?php $display= (isset($attr['display']) and ($attr['display']=='full'))?"col-md-12":"col-md-6"; ?>

<div class="form-group <?php echo $display; ?>">

				<label  class="col-md-4 col-form-label text-md-right float-left">
				<?php echo (isset($attr['label']))?$attr['label']:"Label"; ?>:&nbsp;</label>
				<div class="col-md-6 float-left col-form-label">
<?php echo (isset($attr['value']))?$attr['value']:""; ?>  
				</div>
</div>

