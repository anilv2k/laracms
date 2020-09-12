<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>@get('seo_title') </title>
		
		<link href="@asset("img/favicon.png")" rel="icon">
		
		@styles()



	</head>

	<body class="hold-transition sidebar-mini layout-fixed">
		<div class="wrapper">
			@partial('navbar')
			@partial('aside')


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
			@content()
	
  <!-- /.content -->
  </div>
	  
			@partial('footer')
			@partial('control-sidebar')
		</div>
		<!-- ./wrapper -->

        @scripts()
    </body>

</html>
