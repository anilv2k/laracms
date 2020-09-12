 
 		 
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css" rel="stylesheet"/>

<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


  <div class="col-12" id="crud_list_table">
 
 <?php //if($this->hasFilter){ ?>
 
  <div class="card card-outline card-primary">
              <div class="card-header" data-toggle="collapse" data-target="#collapseExample" >
                <h3 class="card-title">Filter</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" >
				  <i class="fas fa-filter"></i>
                  </button>
                </div> 
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body collapse" id="collapseExample">
                
				
				
				
				<div class="col-md-12">
				
					 <form id="filterform" action="" method="post">                       
											
					<!--- filter fields start  -->
					<?php $this->filterFileds(); ?>
					<!--- filter fields end  -->
				
					<button type="button" id="btn-filter" class="btn btn-primary">Filter</button>
					<button type="button" id="btn-filter-reset" class="btn btn-default">Reset</button>

					</form>
				
                </div>
                 
				
              </div>
              <!-- /.card-body -->
 </div>
			
		
 
 
 
 <?php //} ?>
 
 
    <div class="card">
             
			 <?php //print_r($this->fields); echo "<br>"; print_r($this->dfields); ?>
			 
              <!-- /.card-header -->
              <div class="card-body">
			  
			  <a href='javascript:void(0)' onclick='crud_add()'  ><span class='btn btn-sm btn-primary float-right'>Add</span></a>
 
 <meta name="curd-csrf-token" content="<?php echo csrf_token(); ?>" >
 
 <table  class="datatable table table-bordered table-striped">
                  <thead>
                  <tr>
				  <?php $columns=""; foreach($this->fields as $key => $value){ ?>
                    <th>
					
					<?php echo (isset($this->dfields[$value]))?$this->dfields[$value]:ucwords(str_replace("_"," ",$value)); 
					
					if($value!="options")
					$columns .= '{ "data": "'.$value.'" },';
                    else
					$columns .= '{ "data": "'.$value.'" ,"orderable": false },';
					
					?></th>
				  <?php } ?>	
                    
                  </tr>
                  </thead>
                  <tbody>
                  </tbody>
                  
 </table>
 
 <?php //echo $columns;
 
 
 ?>
 
 </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
 
 
 
 
 </div>
 
 
       <div class="col-12" id="crud_add_edit_form">
                <!-- Horizontal Form -->
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><span class="crud_card_header_label">Add</span> 
						<?php echo ucwords($this->subject); ?> Details</h3>
                        <button class="btn btn-sm btn-primary float-right" onclick="crud_back()">
						<i class="fa fa-arrow-left"></i> Back</button>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" id="add_edit_form" data-type="add" data-submit-url="/admin/cms">
                            
                       
                            <input id="add_edit_field_id" type="hidden" name="id" value="">
                            <div class="card-body" id="curd-option-update" >
                            
							   

                             </div>
                        <!-- /.card-body -->
                        <div class="card-footer" >
                            <div class="float-right">
                                <button type="button" onclick="crud_save()" class="btn btn-primary">
								<i class="fa fa-floppy"></i>Save</button>
                                <button type="reset" onclick="crud_back()" class="btn btn-default">Cancel</button>
                            </div>
                        </div>
						
                        <!-- /.card-footer -->
                    </form>
                </div>

        </div>





     <div class="col-md-12" id="crud_view_data">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><?php echo ucwords($this->subject); ?> Details</h3> 
                        <button class="btn btn-sm btn-primary float-right" onclick="crud_back()"><i
                                class="fa fa-arrow-left"></i> Back</button>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body" id="curd-option-view" >
                        
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>		
 
<script>



var table;

  $(function () {
	  
	var csrf
	  
	table =$('.datatable').DataTable({
		"dom": '<"top"i>rt<"bottom"lp><"clear">',
		paging: true,
        ordering: true,
		info: true,
		"processing": true,
		"serverSide": true,
		"lengthChange": true,
        "searching": false,
		"ajax":{
				 "url": "<?php echo URL::to($this->listurl); ?>",
				 "dataType": "json",
				 "type": "POST",
				 "data": function (data) {
	  				data._token = "<?php echo csrf_token(); ?>";
					data.filters = $('#filterform').serializeArray();
					
					
					if($('#ffilterform').length > 0) {
					data.ffilter = $('#ffilterform').serializeArray();
					}

			
					
                 }
			   },
		"columns": [<?php echo $columns; ?>]	 
	});	
		
  });
  
$('#btn-filter').click(function () { 
    table.ajax.reload();  
});


$('#btn-filter-reset').click(function () { 
	$('#filterform')[0].reset();
    table.ajax.reload();  
});

function reload_table()
{   
    table.ajax.reload(null, false); 
}

show_view_container("crud_list_table");

function crud_view(id) {
    show_view_container("crud_view_data");
	$('#add_edit_field_id').val(id);
	ajax_options('view');
}	

function crud_add() {
    show_view_container("crud_add_edit_form");
	$('.crud_card_header_label').html('Add');
	$('#add_edit_field_id').val("");
	ajax_options('add');
}

function crud_edit(id) {
    show_view_container("crud_add_edit_form");
	$('.crud_card_header_label').html('Edit');
	$('#add_edit_field_id').val(id);
	ajax_options('edit');
}

function crud_save() {

	ajax_options('addeditSave');
}


function crud_back() {
    show_view_container("crud_list_table");

}
	
// toggle view - show / hide
function show_view_container(view_container_id) {
    $("#crud_add_edit_form").hide();
    $("#crud_list_table").hide();
    $("#crud_view_data").hide();
    $("#" + view_container_id).show();
}


function ajax_options(option){
	
	var formData = new FormData();
    var vdatatype= "json";
	 
	if(option=='addeditSave'){
	formData = new FormData($('#add_edit_form')[0]);
	}
	
	if(option=='add'){
	 $('#add_edit_field_id').val('');	
	 vdatatype= "html";
	}else if(option=='edit'){
	 var fieldid =	$('#add_edit_field_id').val();	
	 formData.append( "id", fieldid );
	 vdatatype= "html";
	}else if(option=='view'){
	 var fieldid =	$('#add_edit_field_id').val();	
	 vdatatype= "html";
	 formData.append( "id", fieldid );
	}
    
	
	if($('#ffilterform').length > 0) {
	 var ffilter = $('#ffilterform').serializeArray();
	
	  formData.append("ffilter",JSON.stringify(ffilter));
	 
	}
	
	var ajaxcsrf=$('meta[name="curd-csrf-token"]').attr('content');
	formData.append( "option", option ); 
    formData.append( "_token", ajaxcsrf ); 
   
    //alert(option);
  
    $.ajax({
        url: "<?php echo URL::to($this->optionurl); ?>",
        type: "POST",
        data: formData,
		dataType: vdatatype,
		contentType: false,
        processData: false,
        success: function (data) {
			
		    if(option=='add'){
			   $('#curd-option-update').html(data);
				
			}else if(option=='edit'){
			   $('#curd-option-update').html(data);
				
			}else if((option=='view')){
			   $('#curd-option-view').html(data);
			}
		
				
            if (data.status) {
				
				toastr.success(data.message)
				reload_table();
				show_view_container("crud_list_table");
				
            }
        },
        error: function (xhr, status, error) {
            
			   $.each(xhr.responseJSON.errors, function (key, value) {
                    
                   $('#add_edit_form [name="' + key + '"]').next()
                   .html(value).parent().addClass('has-error');;
						
               });
				
        },
    });
}	
	
</script>



			