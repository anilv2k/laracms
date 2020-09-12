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