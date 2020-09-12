@extends('courses::layouts.master')



	
	
    <!-- ======= Cource Details Section ======= -->
    <section id="course-details" class="course-details">
      <div class="container" data-aos="fade-up">

        <div class="row">
		
          <div class="col-lg-12">
          
            <h3>{{ $university->name }}</h3>
            <div>
			 <img align="right" src="{{ url(Storage::url($university->image)) }}" class="img-fluid" alt="" width="300" style="padding:10px;">
			<?php echo  $university->description; ?>
			 
			  
            </div>
          </div>
		  
		    <?php /*
          <div class="col-lg-4">
	
	
		  
  <img src="{{ url(Storage::url($university->image)) }}" class="img-fluid" alt="" style="padding:10px;">
  
         
  
            <div class="course-info d-flex justify-content-between align-items-center">
              <h5>Trainer</h5>
              <p><a href="#">Walter White</a></p>
            </div>

            <div class="course-info d-flex justify-content-between align-items-center">
              <h5>Ondemand Videos</h5>
              <p>15</p>
            </div>

            <div class="course-info d-flex justify-content-between align-items-center">
              <h5>Documnents </h5>
              <p>30</p>
            </div>

            <div class="course-info d-flex justify-content-between align-items-center">
              <h5>Self Learnig</h5>
              <p> Get Started</p>
            </div>

			
			
          </div>
		  */ ?>
		  
        </div>

      </div>
    </section><!-- End Cource Details Section -->

   