@extends('user::layouts.master')

<!-- jQuery -->
<script src="@asset("plugins/jquery/jquery.min.js")"></script>


    <!-- Content Header (Page header) -->
    <section class="content-header" >
      <div class="container-fluid" >
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1> Themes</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Themes</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
	
	
	
	    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <div class="row">
          <div class="col-12 col-sm-12">
            <div class="card card-primary card-outline card-tabs">
             
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-three-tabContent">
                  <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
	<form id="settingsform" class="row">			  
				  <div class="row">
<?php

foreach($themes as $theme){
	
	//if(strtolower($theme)=='admin') continue;
	
	//print_r($theme);
?>


         <div class="col-md-3">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">{{$theme['info']['name']}}</h3>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body" style="padding:0px;">
                
				<div class="col-md-12" style="padding:0px;" ><img src={{$theme['thumbnail']}} class="img-thumbnail" /></div>
				<div class="col-md-12" style="padding:0px;">
				
				                          <div class="input-group ">
                      <div class="input-group-prepend"> 
<span class="input-group-text"><input type="radio" name="site_theme" value="{{$theme['theme']}}"

<?php echo ($existtheme==$theme['theme'])?"checked":""; ?>

 ></span>
                      </div>
                      <input type="text" readonly  value="Set as Portal Theme" class="form-control">
                    </div>
                    <!-- /input-group -->
                 
				
				
				</div>
				
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
		  
 
  <?php /*
        <div class="col-md-6 offset-md-4">
                                
                                
         </div> */ ?>
 
 
<?php } ?>
						 	
				  
</div>
				  
<div class="row">	
<div class="col-md-12">		  
			       
                                <button1 type="submit" id="submitform" class="btn btn-primary">
                                    Save Theme Settings
                                </button1>
                                
                            
 </div>
 </div>
</form>
				  
                 
                  </div>
            
           
               
                </div>
              </div>
              <!-- /.card -->
            </div>
          </div>
		  
		  
		  
		  

        
		
		
		</div>
        
		
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>

	 
	
	 <script>
  $(function () {
    

$("#submitform").click(function() {
		
	
	
   var formData = new FormData($('#settingsform')[0]);
 
   formData.append( "_token", "{{csrf_token()}}" ); 
   
   $('.error').html('');
   $('.error-message').html('');
   
   $.ajax({
        url: '{{ url('admin/save_settings') }}',
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        async: false,
        success: function (data)
        {
			
			//toastr.success('Theme updated Sucessfully!');
			
		   /*
			var APP_URL = {!! json_encode(url('/')) !!};
			
			if (data.status) {
				
				//window.location.replace(APP_URL+"/user/dashboard");
				
            }else{
				
				$('.error-message').html(data.message);
			}
			
	         */
			 
			 alert('Theme updated Sucessfully!');
			
		},
        error: function (jqXHR, textStatus, errorThrown)
        {
			
            // $('.error-message').html(jqXHR.responseJSON.message);
        }
		
   });
		
		
		});
		
		
		
  });
</script>

