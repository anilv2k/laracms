<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

	{!! meta_init() !!}
	<meta name="keywords" content="@get('keywords')">
	<meta name="description" content="@get('description')">
	<meta name="author" content="@get('author')">

	<title>rCampus LMS Application</title>

	@styles()
		
		
  <!-- Favicons -->
  <link href="@asset("img/favicon.png")" rel="icon">
  <link href="@asset("img/apple-touch-icon.png")" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">


  
  <!-- Vendor CSS Files -->
  <link href="@asset("vendor/bootstrap/css/bootstrap.min.css")" rel="stylesheet">
  <link href="@asset("vendor/icofont/icofont.min.css")" rel="stylesheet">
  <link href="@asset("vendor/boxicons/css/boxicons.min.css")" rel="stylesheet">
  <link href="@asset("vendor/aos/aos.css")" rel="stylesheet">
  <link href="@asset("vendor/animate.css/animate.min.css")" rel="stylesheet">
  <link href="@asset("vendor/remixicon/remixicon.css")" rel="stylesheet">
  <link href="@asset("vendor/owl.carousel/assets/owl.carousel.min.css")" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="@asset("css/style.css")" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Medilab - v2.0.0
  * Template URL: https://bootstrapmade.com/medilab-free-medical-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>


<body>

 
  
  



  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      
	  
	 
	 <?php /* <h1 class="logo mr-auto"><a href="{{ url('/') }}"><img src="@asset("img/logo.png")" alt="" class="img-fluid"></a></h1> */ ?>
	
	  
	 
		<h1 class="logo mr-auto"><a href="{{ url('/') }}">
		
		<?php if(site_data('name')==""){ ?>
		<img src="{{ site_data('logo') }}"  class="img-fluid"> 
		<?php }else{ ?> 
		
		<div class="row">
		<div class="col-md-3" >
		<img src="{{ site_data('logo') }}" style="width:100%" class="img-fluid"> 
		</div>
		<div class="col-md-9" >
		{{ site_data('name') }} 
		</div>
		</div>
		
		<?php } ?>
		
		</a></h1> 
		
	
	  
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo mr-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav class="nav-menu d-none d-lg-block">
        <ul>
		
		
		<?php 
		$subsiteid=config("app.subsiteid");
		if($subsiteid==""){ ?>
		
          <li class="{{ (request()->path()=='') ? 'active':''}}" ><a href="{{ url('/') }}">Home</a></li>
          <li class="{{ (request()->path()=='about') ? 'active':''}}" ><a href="{{ url('/about') }}">About</a></li>
          <li class="{{ (request()->path()=='courses') ? 'active':''}}" ><a href="{{ url('/courses') }}">Courses</a></li>
          <li class="{{ (request()->path()=='universites') ? 'active':''}}" ><a href="{{ url('/universites') }}">Universites</a></li>
          <li class="{{ (request()->path()=='blogs') ? 'active':''}}" ><a href="#">Blog</a></li>
          <li class="{{ (request()->path()=='contact') ? 'active':''}}" ><a href="{{ url('/contact') }}">Contact</a></li>

        <?php }else{ ?>
		
		  <li class="{{ (request()->path()=='') ? 'active':''}}" ><a href="{{ url('/') }}">Home</a></li>
          <li class="{{ (request()->path()=='aboutus') ? 'active':''}}" ><a href="{{ url('/aboutus') }}">About</a></li>
          <li class="{{ (request()->path()=='courses') ? 'active':''}}" ><a href="{{ url('/courses') }}">Courses</a></li>
          <li class="{{ (request()->path()=='colleges') ? 'active':''}}" ><a href="{{ url('/colleges') }}">Colleges</a></li>
          <li class="{{ (request()->path()=='gallery') ? 'active':''}}" ><a href="{{url('blogs')}}">Gallery</a></li>
          <li class="{{ (request()->path()=='contactus') ? 'active':''}}" ><a href="{{ url('/contactus') }}">Contact</a></li>
		  
		  
		<?php } ?>
		




        </ul>
      </nav><!-- .nav-menu -->

<?php $user = auth('web')->user(); //dd($user); ?>

<?php if(!$user){ ?>
	
	<a href="{{ url('/login') }}" class="get-started-btn" style="background:#eaf1ec;color:#4a534c">Log In</a>
	
	<a href="{{ url('/registration') }}" class="get-started-btn">Sign Up</a>
	
<?php }else{ ?>
	
	<a href="{{ url('/mycourses') }}" class="get-started-btn" style="background:#eaf1ec;color:#4a534c" >My Courses</a>
	
	<a href="{{ url('/user/dashboard') }}" class="get-started-btn">My Acount</a>
	
<?php } ?>
      

    </div>
  </header><!-- End Header -->

 <?php  if (Route::getCurrentRoute()->uri() == '/') { ?>
 
    <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex justify-content-center align-items-center" style="background:url('<?php echo site_data('banner'); ?>') top center; background-size:cover;">
    <div class="container position-relative" data-aos="zoom-in" data-aos-delay="100">
 
 <?php $banner_caption= site_data('banner_caption'); 
 
 if(1==1){ 
 ?>
 
      <h1>Learning Today,<br>Leading Tomorrow</h1>
      <h2>Try to learn something about everything and everything about something.</h2>
 <?php }else{  
      echo $banner_caption;
 }?>
 
 
 
	  
      <a href="{{ url('/user/dashboard') }}" class="btn-get-started">Get Started</a>
    </div>
  </section><!-- End Hero -->
  
 <?php } ?>

 
  <main id="main">


 {{ site_data() }}
   