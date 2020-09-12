@extends('courses::layouts.master')



	
	
    <!-- ======= Courses Section ======= -->
    <section id="courses" class="courses">
      <div class="" data-aos="fade-up">
	  
	  		
	 <div class="col-md-12" style="float:left" >
	 
        <div class="row" data-aos="zoom-in" data-aos-delay="100">

		@foreach ($colleges as $college)

	    <div class="col-lg-4 col-md-6 d-flex align-items-stretch" style="margin-top:10px;">
            <div class="course-item" style="width:100%;">
			
                <div class="course-content">
             
                <h5>{{ $college->name }}</h5>
				
                </div>
            </div>
        </div> <!-- End Course Item-->
	
       @endforeach

     </div>



        </div>

      </div>
    </section><!-- End Courses Section -->
	
	
<?php /*	
	
    <!-- ======= Courses Section ======= -->
    <section id="events" class="events">
      <div class="container" data-aos="fade-up">

        <div class="row" >

		
		@foreach ($colleges as $college)

		
		
		    <div class="col-md-4 d-flex align-items-stretch">
            <div class="card">
           
              <div class="card-body">
                <h5 class="card-title">{{ $college->name }}</h5>
                <p class="font-italic text-center"> 1111111</p>
                <p class="card-text"></p>
              </div>
            </div>
          </div>
		
	
	
       @endforeach





        </div>

      </div>
    </section><!-- End Courses Section -->
	
	*/ ?>