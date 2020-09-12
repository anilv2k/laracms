@foreach ($pages as $page)

 <div class="col-lg-4 col-md-6 d-flex align-items-stretch" style="margin-top:10px;">
            <div class="course-item" style="width:100%;">
			
			
              <img src="{{ url(Storage::url($page->image)) }}" class="img-fluid" style="height:150px; width:100%;" >
              <div class="course-content">
             
			<?php
				$user=$page->user;
				?>

                <h5><a href="{{ url('courses/details/'.$page->id) }}">{{ $page->name }}</a></h5>
				
				
				
                <div>
				<div class="topic_rating" data-score="3" ></div>  
				<span style="background:#0sffss;"> {{ $page->level }} </span> 
				</div>
				
				
                <div class="trainer d-flex justify-content-between align-items-center">
                  <div class="trainer-profile d-flex align-items-center">
                    <img src="assets/img/trainers/trainer-1.jpg" class="img-fluid" alt="">
                    <span> <i class="bx bx-user"></i> &nbsp; &nbsp; <?php if(isset( $user->name)){  echo $user->name;  } ?> </span>
                  </div>
				  
						  
				  
                </div>
              </div>
            </div>
          </div> <!-- End Course Item-->
@endforeach