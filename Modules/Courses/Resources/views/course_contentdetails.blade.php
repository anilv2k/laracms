@extends('courses::layouts.master')

 <link href="https://vjs.zencdn.net/7.8.4/video-js.css" rel="stylesheet" />

 <script src="https://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>

<style>

.breadcrumbs {
	height:65px !important ;
	padding: 10px 0 !important;
}
</style>
	
	<?php /*
	
	{{ url(Storage::url($content->file_name)) }}
	
	*/ ?>
	
    <!-- ======= Cource Details Section ======= -->
    <section id="course-details" class="course-details">
      <div class="container" data-aos="fade-up">

        <div class="row">
		
		
		
		
		
		      <div class="col-lg-8">
	
	<h4>{{ $content->title }}</h4>
		  
  
  
  <div class="row">
  
 <?php if($content->file_type=="video"){ ?>
	  
    <video
    id="my-video"
    class="video-js"
    controls
	autoplay=true
    preload="auto"
    width="720"
    height="364"
    poster="MY_VIDEO_POSTER.jpg"
    data-setup="{ 'controls': true, 'autoplay': true, 'preload': 'auto' }"
  >
    <source src="{{ url(Storage::url($content->file_name)) }}" type="video/mp4" />
   
    <p class="vjs-no-js">
      To view this video please enable JavaScript, and consider upgrading to a
      web browser that
      <a href="https://videojs.com/html5-video-support/" target="_blank" >supports HTML5 video</a
      >
    </p>
  </video>
  
  <?php } ?>
  
   <?php if($content->file_type=="pdf"){ ?>

   <iframe src="{{ url(Storage::url($content->file_name)) }}"  style="height:700px;width:100%" ></iframe>
   
   
    <?php } ?>
  
  </div>
  
            <div class="row" style="padding:10px;">
             
			 <?php echo $course->description;  ?> 
            </div>

            

          </div>
		  
		  
		
		
		
		
		
		
		
          <div class="col-lg-4">
          
          
			       <div class="card-body" style="padding:0px;">
                 
                    <div class="tab-pane fade show active" id="lessons-tab-content" role="tabpanel" aria-labelledby="lessons-tab">
                    
                        <div class="row">
                       
                            <div class="mt-2 col-md-12" id="curriculum-sections-container">
                              <?php $sec_count = 1;     $documents=0; $videos=0; ?>
                                @forelse ($curr as $k=>$item)
                                    

                                <div class="card card-info curriculum-card" id="curriculum-{{$item['id']}}">
                                    <div class="card-header">
                                        <strong class="card-title"> {{ $item['title'] }}</strong>
                                       
                                    </div>
                                    <div class="card-body" style="padding:0.25rem">
                                      <div class="list-group">
                                      @if (isset($item['lessons']))
                                          
                                      
                                        @foreach ($item['lessons'] as $lesson)
                                          <p class="" style="padding:2px;" id="curriculum-lesson-{{$lesson['id']}}">
										  
										  @if($lesson['file_type']=='video')
										  <?php $videos+=1; ?>
										  <i class="icofont-ui-video-play"></i>
									      @endif
										  
										   @if($lesson['file_type']=='pdf')
										   <?php $documents+=1; ?>
										   <i class="icofont-file-pdf"></i>
										   @endif
										   
										  <span><a href="{{ url('courses/contentdetails/'.$course->id.'/'.$lesson['id'])}}"> {{ $lesson['title'] }} </a></span>
                                          
                                            
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
		  
		  
		  
    
		  
		  
        </div>

      </div>
    </section><!-- End Cource Details Section -->

   <script src="https://vjs.zencdn.net/7.8.4/video.js"></script>