@extends('courses::layouts.master')



	
	
    <!-- ======= Cource Details Section ======= -->
    <section id="course-details" class="course-details">
      <div class="container" data-aos="fade-up">

        <div class="row">
		
          <div class="col-lg-8">
          
            <h3>{{ $course->name }}</h3>
            <div>
			<?php echo  $course->description; ?>
            </div>
			
			
			
			
			
			       <div class="card-body">
                 
                    <div class="tab-pane fade show active" id="lessons-tab-content" role="tabpanel" aria-labelledby="lessons-tab">
                    
                        <div class="row">
                       
                            <div class="mt-2 col-md-12" id="curriculum-sections-container">
                              <?php $sec_count = 1;     $documents=0; $videos=0; ?>
                                @forelse ($curr as $k=>$item)
                                    

                                <div class="card card-info curriculum-card" id="curriculum-{{$item['id']}}">
                                    <div class="card-header">
                                        <strong class="card-title">Section {{($sec_count++).' : '.$item['title']}}</strong>
                                       
                                    </div>
                                    <div class="card-body">
                                      <div class="list-group">
                                      @if (isset($item['lessons']))
                                          
                                      
                                        @foreach ($item['lessons'] as $lesson)
                                          <p class="list-group-item list-group-item-info" id="curriculum-lesson-{{$lesson['id']}}">
										  
										  @if($lesson['file_type']=='video')
										  <?php $videos+=1; ?>
										  <i class="icofont-ui-video-play"></i>
									      @endif
										  
										   @if($lesson['file_type']=='pdf')
										   <?php $documents+=1; ?>
										   <i class="icofont-file-pdf"></i>
										   @endif
										   
										  <span>
										  <a  href="{{ url('courses/contentdetails/'.$course->id.'/'.$lesson['id'])}}">
										  {{ $lesson['title'] }} </a>
										  </span>
                                            
                                          </p>
                                        @endforeach
                                        @else
                                        {{-- <div class="alert alert-default">No Lessons Available</div> --}}
                                        @endif
                                      </div>
                                            
                                    </div>
                                </div>
                                @empty
                                  <div class="alert alert-default">No Sections Available</div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                 

                
                </div>
              
			  
			  
			  
			  
			  
			  
			  
			
			
			
			
			
			
			
			
          </div>
          <div class="col-lg-4">
	
	
		  
  <img src="{{ url(Storage::url($course->image)) }}" class="img-fluid" alt="" style="padding:10px;">
  

  
            <div class="course-info d-flex justify-content-between align-items-center">
              <h5>Trainer</h5>
              <p><a href="#">{{ $course->user->name }}</a></p>
            </div>

            <div class="course-info d-flex justify-content-between align-items-center">
              <h5>Ondemand Videos</h5>
              <p>{{ $videos }}</p>
            </div>

            <div class="course-info d-flex justify-content-between align-items-center">
              <h5>Documnents </h5>
              <p>{{ $documents }}</p>
            </div>

            <div class="course-info d-flex justify-content-between align-items-center">
              <h5>Self Learnig(Exam)</h5>
              <p> Get Started</p>
            </div>

          </div>
        </div>

      </div>
    </section><!-- End Cource Details Section -->

   