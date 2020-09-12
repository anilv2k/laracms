<div class="login-box">
    <div class="login-logo">
      <a href="{{url('/')}}">
	  
	  <img src="@asset("img/adminlogo.png")" alt="" class="img-fluid">
	  	  
	  </a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Sign in to start your session</p>
        @error('pass')
            <p class="help-block">{{$message}}</p>
        @enderror
        <form  id="loginform" action="#" method="post">
            @csrf
          <div class="input-group mb-3">
            <input type="email" class="form-control" placeholder="Email" required maxlength="100" name="email">
			<span class="error"></span>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password" required maxlength="100" name="password">
			<span class="error"></span>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
		  <div class="form-group row">
                                <div class="col-md-12">
                                    <span class="error-message"></span>
                                </div>
          </div>
							
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="remember">
                <label for="remember">
                  Remember Me
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button1 type="submit" id="submitform" class="btn btn-primary btn-block">Sign In</button1>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <p class="mb-1">
          <a href="forgot-password.html">I forgot my password</a>
        </p>
 
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

  
  <script src="@asset("plugins/jquery/jquery.js")" ></script>
	
	
  <script>
	
  $(function () {
    
	
	
	$("#submitform").click(function() {
		
	
   var formData = new FormData($('#loginform')[0]);
 
   formData.append( "_token", "{{csrf_token()}}" ); 
   
   $('.error').html('');
   $('.error-message').html('');
   
   $.ajax({
        url: '{{ url('admin/dologin') }}',
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
				
				window.location.replace(APP_URL+"/admin/dashboard");
				
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
