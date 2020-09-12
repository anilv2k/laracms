@extends('user::layouts.master')

<!-- jQuery -->
<script src="@asset("plugins/jquery/jquery.min.js")"></script>


    <!-- Content Header (Page header) -->
    <section class="content-header" >
      <div class="container-fluid" >
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1> Settings</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Settings</li>
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
              <div class="card-header p-0 pt-1 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">Portal</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">SEO</a>
                  </li>
             
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-three-settings-tab" data-toggle="pill" href="#custom-tabs-three-settings" role="tab" aria-controls="custom-tabs-three-settings" aria-selected="false">Settings</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-three-tabContent">
                  <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
				  
				  <div class="row">
<?php

//print_r($options);
?>

<form id="settingsform" class="row">

 {{ Datatable::FormInput(array("name"=>"site_admin_email","label"=>"Site Admin Email","type"=>"text","display"=>"full","value"=>$options['site_admin_email']))}}
 
 {{ Datatable::FormInput(array("name"=>"site_admin_title","label"=>"Site Admin Title","type"=>"text","display"=>"full","value"=>$options['site_admin_title']))}}
 
 {{ Datatable::FormInput(array("name"=>"site_footer_title",'label'=>'Site Footer Title','type'=>'text',"display"=>"full","value"=>$options['site_footer_title']))}}
 

        <div class="col-md-6 offset-md-4">
                                <button1 type="submit" id="submitform" class="btn btn-primary">
                                    Save Settings
                                </button1>
                                
                            </div>
 
 
</form>
						 	
				  
</div>
				  
				  
				  
                 
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
				  
				  
				  				  <div class="row">
<?php

//print_r($options);
?>

<form id="SEO_Settings_Form" class="row">

 {{ Datatable::FormInput(array("name"=>"seo_title","label"=>"SEO Title","type"=>"text","display"=>"full","value"=>$options['seo_title']))}}
 
 {{ Datatable::FormInput(array("name"=>"seo_keywords","label"=>"SEO Keywords","type"=>"text","display"=>"full","value"=>$options['seo_keywords']))}}
 
 {{ Datatable::FormInput(array("name"=>"seo_description",'label'=>'SEO Description','type'=>'text',"display"=>"full","value"=>$options['seo_description']))}}
 

        <div class="col-md-6 offset-md-4">
                                <button1 type="submit" id="seosubmitform" class="btn btn-primary">
                                    Save Settings
                                </button1>
                                
                            </div>
 
 
</form>
						 	
				  
</div>

                   
				  
				  </div>
           
                  <div class="tab-pane fade" id="custom-tabs-three-settings" role="tabpanel" aria-labelledby="custom-tabs-three-settings-tab">
                     Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis vulputate. Morbi euismod molestie tristique. Vestibulum consectetur dolor a vestibulum pharetra. Donec interdum placerat urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at consequat diam. Nunc et felis ut nisl commodo dignissim. In hac habitasse platea dictumst. Praesent imperdiet accumsan ex sit amet facilisis. 
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
				
					var APP_URL = {!! json_encode(url('/')) !!};
					
					if (data.status) {
						
						//window.location.replace(APP_URL+"/user/dashboard");
						
					}else{
						
						$('.error-message').html(data.message);
					}
					
			
					
				},
				error: function (jqXHR, textStatus, errorThrown)
				{
					
					 $('.error-message').html(jqXHR.responseJSON.message);
				}
				
		   });
				
		
});
		
		
		

  

  
$("#seosubmitform").click(function() {
		
	
	
			var formData = new FormData($('#SEO_Settings_Form')[0]);

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

				var APP_URL = {!! json_encode(url('/')) !!};
				
				if (data.status) {
					
					//window.location.replace(APP_URL+"/user/dashboard");
					
				}else{
					
					$('.error-message').html(data.message);
				}
				

				
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				
				 $('.error-message').html(jqXHR.responseJSON.message);
			}

			});


		});
		
		
		

   });
   
  
</script>

