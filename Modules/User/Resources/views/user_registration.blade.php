@extends('user::layouts.master')

<!-- jQuery -->
<script src="@asset("plugins/jquery/jquery.min.js")"></script>


  
	  
	  
	  <div class="container maincontainer py-4">
                <div class="row">
				


<div class="col-md-12 login-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Registration Form</div>
                    <div class="card-body">
					
                        <form id="registrationform" action="" method="post">
						
						     <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Full Name</label>
                                <div class="col-md-6">
                                    <input type="text" id="name" class="form-control" name="name" required autofocus>
									<span class="error"></span>
                                </div>
                            </div>
						
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                                <div class="col-md-6">
                                    <input type="text" id="email" class="form-control" name="email" required autofocus>
									<span class="error"></span>
                                </div>
                            </div>

							<div class="form-group row">
                                <label for="gender" class="col-md-4 col-form-label text-md-right">Gender</label>
                                <div class="col-md-6">
										<div class="row">		
										<div class="col-md-6">
										<label class='radiolabel'>
										<input type="radio" name="gender"  value="male" />&nbsp; Male</label>
										</div>
										<div class="col-md-6">
										<label class='radiolabel'>
										<input type="radio" name="gender" value="female" />&nbsp; Female</label>
										</div>
										</div>
									<span class="error"></span>
                                </div>
                            </div>
							
							
						
							
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                <div class="col-md-6">
                                    <input type="password" id="password" class="form-control" name="password" required>
									<span class="error"></span>
                                </div>
                            </div>

							 <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
                                <div class="col-md-6">
                                    <input type="password" id="password" class="form-control" name="password_confirm" required>
									<span class="error"></span>
                                </div>
                            </div>
							
							
					<div class="form-group row">
                                <label for="college_id" class="col-md-4 col-form-label text-md-right">College</label>
                                <div class="col-md-6">
								
								
								
								 <select class="mdb-select md-form form-control" id="college_id"  name="college_id" searchable="Search here.." required>
								  <option value="" disabled selected>Choose your College</option>
								  
								   <?php  foreach($colleges as $c){ ?>
								   <option value="{{ $c->id }}" >{{ $c->name }}</option>
								  
								   <?php } ?>
								 
								</select>

									<span class="error"></span>
                                </div>
                            </div>
							
							<div class="form-group row">
                                <label for="user_type" class="col-md-4 col-form-label text-md-right">User Type</label>
                                <div class="col-md-6">
								
								       	<div class="row">		
										<div class="col-md-6">
										<label class='radiolabel'>
										<input type="radio" name="user_type"  value="student" />&nbsp; Student</label>
										</div>
										<div class="col-md-6">
										<label class='radiolabel'>
										<input type="radio" name="user_type" value="faculty" />&nbsp; Faculty</label>
										</div>
										</div>

									<span class="error"></span>
                                </div>
                            </div>
							
							<div class="form-group row">
                                <label for="phone" class="col-md-4 col-form-label text-md-right">Phone No</label>
                                <div class="col-md-6">
                                    <input type="text"  id="phone" class="form-control" name="phone" required>
									<span class="error"></span>
                                </div>
                            </div>
							
							
							
							<div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <span class="error-message"></span>
                                </div>
                            </div>
							
							
                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember"> Subscribe Newsletter
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 offset-md-4">
                                <button1 type="submit" id="submitform" class="btn btn-primary">
                                  User Registration
                                </button1>
                                
                            </div>
						  </form>	
                    </div>
                  
                </div>
            </div>
        </div>
    </div>
    </div>

</div>


</div>

</div>

  <script src="@asset("plugins/jquery/jquery.js")" ></script>

	
	<script>
	
  $(function () {
    
  $("#submitform").click(function() {
	
   var formData = new FormData($('#registrationform')[0]);
 
   formData.append( "_token", "{{csrf_token()}}" ); 
   
   $('.error').html('');
   $('.error-message').html('');
   
   $.ajax({
        url: '{{ url('user/doregistration') }}',
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
				
				
				window.location.replace(APP_URL+"/user/dashboard");
				
				
				
            }else{
				
				$('.error-message').html(data.message);
			}
			
	
			
		},
        error: function (jqXHR, textStatus, errorThrown)
        {
			
             $.each(jqXHR.responseJSON.errors, function (key, value) {
                    
				
                   $('#registrationform [name="' + key + '"]').next().html(value);
				   
				   //.parent().addClass('has-error');;
						
             });
			 
			 $('.error-message').html(jqXHR.responseJSON.message);
        }
		
   });
		
		
		});
		
  });
</script>

<style>
.error{
	
	font-size:12px;
}
</style>
