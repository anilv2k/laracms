<?php

/*
Theme Name: Sidebar Template
Theme URI: http://stackoverflow.com
Author: Anil Kumar
Author URI: http://stackoverflow.com
Description: Sample of Stack Overflow.
Version: 2.1

*/

?>
	   

   @partial('header')

		
		 
    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2> {{ Theme::getPagetitle() }}</h2>
          <ol>
            <li><a href="{{ url('/') }}">Home</a></li>
            <li>{{ Theme::getPagetitle() }}</li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs Section -->

    <section class="inner-page">
      <div class="container">
        <p>

		<?php
		
		//print_r($metadata);
		//print_r($metadata);
		?>
            @content()
        </p>
      </div>
    </section>
	
     

        @partial('footer')

        @scripts()
  