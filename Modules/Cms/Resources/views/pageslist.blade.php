@extends('user::layouts.master')

<!-- jQuery -->
<script src="@asset("plugins/jquery/jquery.min.js")"></script>


    <!-- Content Header (Page header) -->
    <section class="content-header" >
      <div class="container-fluid" >
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Pages</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Pages</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
	
	
	
	    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
		 
		 
		 <form name="" id="ffilterform" >
	<input type='hidden' class="fixedfilter"  name='page_type' value="{{$page_type}}" />  
	

	
         </form>

	
			  {{ Datatable::display('pageslist')}}
 			
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>

	<?php /*
	
	 <script>
  $(function () {
    

	$('#users').DataTable({
		"processing": true,
		"serverSide": true,
		"ajax":{
				 "url": "{{ url('user/allusers') }}",
				 "dataType": "json",
				 "type": "POST",
				 "data":{ _token: "{{csrf_token()}}"}
			   },
		"columns": [
			{ "data": "id" },
			{ "data": "name" },
			{ "data": "email" },
			{ "data": "created_at" }

		]	 

	});
		
		
		
  });
</script>

*/ ?>