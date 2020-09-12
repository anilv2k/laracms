@extends('user::layouts.master')

<!-- jQuery -->
<script src="@asset("plugins/jquery/jquery.min.js")"></script>


  
	  
	  
	  <div class="container maincontainer py-4">
                <div class="row">
				


<div class="col-md-12 login-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Login</div>
                    <div class="card-body">
                        <form id="loginform" action="" method="post">
                            <div class="form-group row">
                                <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                                <div class="col-md-6">
                                    <input type="text" id="email" class="form-control" name="email" required autofocus>
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
                                <div class="col-md-6 offset-md-4">
                                    <span class="error-message"></span>
                                </div>
                            </div>
							
							
                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember"> Remember Me
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 offset-md-4">
                                <button1 type="submit" id="submitform" class="btn btn-primary">
                                    Login
                                </button1>
                                <a href="#" class="btn btn-link">
                                    Forgot Your Password?
                                </a>
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
	
   var formData = new FormData($('#loginform')[0]);
 
   formData.append( "_token", "{{csrf_token()}}" ); 
   
   $('.error').html('');
   $('.error-message').html('');
   
   $.ajax({
        url: '{{ url('user/dologin') }}',
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
				
				window.location.replace(data.weburl+"/user/dashboard");
				
            }else{
				
				$('.error-message').html(data.message);
			}
			
	
			
		},
        error: function (jqXHR, textStatus, errorThrown)
        {
			
             $.each(jqXHR.responseJSON.errors, function (key, value) {
                    
				
                   $('#loginform [name="' + key + '"]').next().html(value);
				   
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
