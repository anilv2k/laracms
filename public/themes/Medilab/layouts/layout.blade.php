<?php

/*
theme NamE: Default Template
Theme URI: http://stackoverflow.com
Author: Anil Kumar
Author URI: http://stackoverflow.com
Description: Sample of Stack Overflow.
Version: 2.1
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Tags: Default Template
Text Domain: This theme, like SS, is licensed under the GPL.
Use it to make something cool, have fun, and share what you've learned with others.
*/

?>




        @partial('header')

		
		 
    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Inner Page</h2>
          <ol>
            <li><a href="index.html">Home</a></li>
            <li>Inner Page</li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs Section -->

    <section class="inner-page">
      <div class="container">
        <p>
            @content()
        </p>
      </div>
    </section>
	
     

        @partial('footer')

        @scripts()
  