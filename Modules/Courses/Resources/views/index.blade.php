@extends('courses::layouts.master')


<!-- jQuery -->
<script src="@asset("plugins/jquery/jquery.min.js")"></script>


       <?php 
	   
	 // dd($courses);   
	?>
    <!-- ======= Courses Section ======= -->
    <section id="courses" class="courses">
      <div class="" data-aos="fade-up">

	  <div class="col-md-3" style="float:left" >
       <div class="row">
	   
	  	   
	     <div class="card card-info curriculum-card" style="width:100%;margin-top:10px;" >
				<div class="card-header">
				<strong class="card-title">Filter</strong>

				</div> 
				
				
				<div class="card-body" style="padding:0.25rem">
				<div class="list-group" style="padding:5px;" >

				<strong> Stream </strong>
				<p class="" style="padding:2px;" >
										  
										
				<?php foreach($coursetype as $ct){ ?>						   
				<span> <input type="radio" name="level" value=""> &nbsp;<?php echo ucfirst(strtolower($ct->name)) ?> </span>
				<br/>
				
				<?php } ?>
				                                          
                                            
                </p>

				</div>
				
				
			    <div class="list-group" style="padding:5px;" >

				<strong>Level </strong>
				<p class="" style="padding:2px;" >
										  
										
										   
				<span><input type="radio" name="level" value=""> &nbsp;All</span> <br/>
				<span><input type="radio" name="level" value="beginner"> &nbsp;Beginner </span><br/>
				<span><input type="radio" name="level" value="intermediate"> &nbsp;Intermediate </span><br/>
				<span><input type="radio" name="level" value="advanced"> &nbsp;Advanced </span>
				
                        
                </p>

				</div>
				
				
				
							    <div class="list-group" style="padding:5px;" >

				<strong>Rating </strong>
				<p class="" style="padding:2px;" >
										
				

 <ul style="padding-left:5px; ">
                                <li class="form-check py-2">
                                    <input class="form-check-input" type="radio" name="rating" id="exampleRadios1" value="all" checked>
                                    <label class="form-check-label">
                                        ALL
                                    </label>
                                </li>
                                <li class="form-check py-2">
                                    <input class="form-check-input" type="radio" name="rating" id="exampleRadios1" value="0" >
                                    <div class="topic_rating" data-score="1" ></div>
                                </li>
                                <li class="form-check py-2">
                                    <input class="form-check-input" type="radio" name="rating" id="exampleRadios1" value="1" >
                                    <div class="topic_rating" data-score="2" ></div>
                                </li>
                                <li class="form-check py-2">
                                    <input class="form-check-input" type="radio" name="rating" id="exampleRadios1" value="2" >
                                    <div class="topic_rating" data-score="3" ></div>
                                </li>
                                <li class="form-check py-2">
                                    <input class="form-check-input" type="radio" name="rating" id="exampleRadios1" value="3" >
									
									<div class="topic_rating" data-score="4" ></div>
                                    
                                </li>
                                <li class="form-check py-2">
                                    <input class="form-check-input" type="radio" name="rating" id="exampleRadios1" value="4" >
                                    <div class="topic_rating" data-score="5" ></div>
                                </li>
                            </ul>



				
				
                        
                </p>

				</div>
				
				

				</div> 
									  
		 </div>							  
									  
      </div>
      </div>	  
	  		
	 <div class="col-md-9" style="float:left" >
	 
        <div class="row" data-aos="zoom-in" data-aos-delay="100">

		
	
		
		@foreach ($courses as $course)

	
	 <div class="col-lg-4 col-md-6 d-flex align-items-stretch" style="margin-top:10px;">
            <div class="course-item" style="width:100%;">
			
			
              <img src="{{ url(Storage::url($course->image)) }}" class="img-fluid" style="height:150px; width:100%;" >
              <div class="course-content">
             
				<?php /*	
				<div class="d-flex justify-content-between align-items-center mb-3">
				<h4>Web Development</h4>
				<p class="price">$169</p>
				</div> */
				$user=$course->user;
				?>

                <h5><a href="{{ url('courses/details/'.$course->id) }}">{{ $course->name }}</a></h5>
				
				
				
                <div>
				<div class="topic_rating" data-score="5" ></div>  
				<span style="background:#0sffss;"> {{ $course->level }} </span> 
				</div>
				
				
                <div class="trainer d-flex justify-content-between align-items-center">
                  <div class="trainer-profile d-flex align-items-center">
                    <img src="assets/img/trainers/trainer-1.jpg" class="img-fluid" alt="">
                    <span> <i class="bx bx-user"></i> &nbsp; &nbsp;{{ $user['name'] }}</span>
                  </div>
				  
				  <?php /*
                  <div class="trainer-rank d-flex align-items-center">
                    <i class="bx bx-user"></i>&nbsp;50
                    &nbsp;&nbsp;
                    <i class="bx bx-heart"></i>&nbsp;65
                  </div>  */  ?>
				  
				  
                </div>
              </div>
            </div>
          </div> <!-- End Course Item-->
	
       @endforeach

     </div>



        </div>

      </div>
    </section><!-- End Courses Section -->
	
	 <script>

         
        $(document).ready(function(){
            $('.topic_rating').raty({readOnly: true,score: function() {
                return $(this).attr('data-score');
             }});
             $('.lect_rating').raty({readOnly: true,score: function() {
                return $(this).attr('data-score');
             }});
	 
        });
		
     </script>		