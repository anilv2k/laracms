@extends('user::layouts.master')


<!-- jQuery -->
<script src="@asset("plugins/jquery/jquery.min.js")"></script>









<link rel="stylesheet" href="@asset("plugins/fontawesome-free/css/all.min.css")">





  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" href="#home">Profile</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#menu1">Password</a>
    </li>
	
	<?php /*
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#menu2">Activity</a>
    </li> */ ?>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div id="home" class="container tab-pane active"><br>
      <h3></h3>
      
	  <?php $user = auth('web')->user(); //dd($user->name); ?>
	  
	  
	  
	  
	    <!-- start  -->
	  
	    
	  <div class="container maincontainer py-4">
                <div class="row">
				


<div class="col-md-12 login-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">User Profile</div>
                    <div class="card-body">
					
                        <form id="profileform" action="" method="post">
						
						     <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Full Name</label>
                                <div class="col-md-6">
                                    <input type="text" id="name" class="form-control" name="name" value="{{ $user->name }}" required autofocus>
									<span class="error"></span>
                                </div>
                            </div>
						
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                                <div class="col-md-6">
                                    <input type="text" id="email" class="form-control" name="email" value="{{ $user->email }}" required autofocus>
									<span class="error"></span>
                                </div>
                            </div>

							<div class="form-group row">
                                <label for="gender" class="col-md-4 col-form-label text-md-right">Gender</label>
                                <div class="col-md-6">
										<div class="row">		
										<div class="col-md-6">
										<label class='radiolabel'> 
										<input type="radio" name="gender" {{ ($user->gender=='male') ? 'checked ':''}}  value="male" />&nbsp; Male</label>
										</div>
										<div class="col-md-6">
										<label class='radiolabel'>
										<input type="radio" name="gender" {{ ($user->gender=='female') ? 'checked ':''}} value="female" />&nbsp; Female</label>
										</div>
										</div>
									<span class="error"></span>
                                </div>
                            </div>
							
							
			
							
							<div class="form-group row">
                                <label for="user_type" class="col-md-4 col-form-label text-md-right">User Type</label>
                                <div class="col-md-6">
								
								       	<div class="row">		
										<div class="col-md-6">
										<label class='radiolabel'>
										<input type="radio" name="user_type" {{ ($user->user_type=='student') ? 'checked ':''}}  value="student" />&nbsp; Student</label>
										</div>
										<div class="col-md-6">
										<label class='radiolabel'>
										<input type="radio" name="user_type" {{ ($user->user_type=='faculty') ? 'checked ':''}}  value="faculty" />&nbsp; Faculty</label>
										</div>
										</div>

									<span class="error"></span>
                                </div>
                            </div>
							
							<div class="form-group row">
                                <label for="phone" class="col-md-4 col-form-label text-md-right">Phone No</label>
                                <div class="col-md-6">
                                    <input type="text"  id="phone" value="{{ $user->phone }}" class="form-control" name="phone" required>
									<span class="error"></span>
                                </div>
                            </div>
							
							
							
							<div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <span class="error-message"></span>
                                </div>
                            </div>
							
							
                            <?php /* <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember"> Subscribe Newsletter
                                        </label>
                                    </div>
                                </div>
                            </div> */ ?>

                            <div class="col-md-6 offset-md-4">
                                <button1 type="submit" id="profilesubmitform" class="btn btn-primary">
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



   <!-- end  -->
	  

	  
	  
    </div>
    <div id="menu1" class="container tab-pane fade"><br>
       
	   
	
	
	
	
		  
	    <!-- start  -->
	  
	    
	  <div class="container maincontainer py-4">
                <div class="row">
				


<div class="col-md-12 login-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">User Password</div>
                    <div class="card-body">
					
                        <form id="passwordform" action="" method="post">
						
						  
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
							
							
							
						

                            <div class="col-md-6 offset-md-4">
                                <button1 type="submit" id="passwordsubmitform" class="btn btn-primary">
                                 Change password                               </button1>
                                
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



   <!-- end  -->
	
	
	
	
	
	
	
	
	
	
    </div>
   
<?php /*   <div id="menu2" class="container tab-pane fade"><br>
      <h3>Menu 2</h3>
      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
    </div>
	
	*/ ?>
	
	
  </div>

	



<script>
	
  $(function () {
    
  $("#profilesubmitform").click(function() {
	
   var formData = new FormData($('#profileform')[0]);
 
   formData.append( "_token", "{{csrf_token()}}" ); 
   
   $('.error').html('');
   $('.error-message').html('');
   
   $.ajax({
        url: '{{ url('user/profile') }}',
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
                    
				
                   $('#profileform [name="' + key + '"]').next().html(value);
				   
				   //.parent().addClass('has-error');;
						
             });
			 
			 $('.error-message').html(jqXHR.responseJSON.message);
        }
		
   });
		
		
		});
		
		
		
		
		
	



 $("#passwordsubmitform").click(function() {
	
   var formData = new FormData($('#passwordform')[0]);
 
   formData.append( "_token", "{{csrf_token()}}" ); 
   
   $('.error').html('');
   $('.error-message').html('');
   
   $.ajax({
        url: '{{ url('user/password') }}',
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
				
				
				
            }else{
				
				$('.error-message').html(data.message);
			}
			
	
			
		},
        error: function (jqXHR, textStatus, errorThrown)
        {
			
             $.each(jqXHR.responseJSON.errors, function (key, value) {
                    
				
                   $('#profileform [name="' + key + '"]').next().html(value);
				   
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
