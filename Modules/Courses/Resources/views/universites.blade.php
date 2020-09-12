@extends('courses::layouts.master')


       <?php 
	   
	 // dd($courses);   
	?>
    <!-- ======= Courses Section ======= -->
    <section id="events" class="events">
      <div class="container" data-aos="fade-up">

        <div class="row" >

		
		@foreach ($universities as $university)

		
		
		    <div class="col-md-4 d-flex align-items-stretch">
            <div class="card">
              <div class="card-img">
                <img src="{{ url(Storage::url($university->image)) }}"  style="height:200px;width:100%" >
              </div>
              <div class="card-body">
                <h5 class="card-title"><a href="{{ $university->weburl }}" target="_blank" >{{ $university->name }}</a></h5>
                <p class="font-italic text-center">{{  $university->address }}</p>
                <p class="card-text"></p>
              </div>
            </div>
          </div>
		
	
	
       @endforeach





        </div>

      </div>
    </section><!-- End Courses Section -->
	
	