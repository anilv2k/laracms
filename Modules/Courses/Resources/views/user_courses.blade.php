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
				
				<form id="coursefilter"   >
				
				
				<div class="card-body" style="padding:0.25rem">
							
			    <div class="list-group" style="padding:5px;" >

				<strong>Level </strong>
				<p class="" style="padding:2px;" >
										  
										
										   
				<span><input type="radio" name="level" value="" checked> &nbsp;All</span> <br/>
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
                                    <input class="form-check-input" type="radio" name="rating"  value="" checked>
                                    <label class="form-check-label">
                                        ALL
                                    </label>
                                </li>
                                <li class="form-check py-2">
                                    <input class="form-check-input" type="radio" name="rating"  value="0" >
                                    <div class="topic_rating" data-score1="1" ></div>
                                </li>
                                <li class="form-check py-2">
                                    <input class="form-check-input" type="radio" name="rating" value="1" >
                                    <div class="topic_rating" data-score1="2" ></div>
                                </li>
                                <li class="form-check py-2">
                                    <input class="form-check-input" type="radio" name="rating" value="2" >
                                    <div class="topic_rating" data-score1="3" ></div>
                                </li>
                                <li class="form-check py-2">
                                    <input class="form-check-input" type="radio" name="rating" value="3" >
									
									<div class="topic_rating" data-score="4" ></div>
                                    
                                </li>
                                <li class="form-check py-2">
                                    <input class="form-check-input" type="radio" name="rating"  value="4" >
                                    <div class="topic_rating" data-score="5" ></div>
                                </li>
                            </ul>



				
				
                        
                </p>

				</div>
				
				

				</div> 
				
				
				
				</form>
									  
		 </div>							  
									  
      </div>
      </div>	  
	  		
	 <div class="col-md-9" style="float:left" >
	 
        <div data-aos="zoom-in" data-aos-delay="100">

		
			<div class="row" id="course_pages_content">

			 @include('courses::courses_content_box')
			 

			</div>


     </div>


    <div class="row mt-4">
        <div id="course_paginate_box"  style="padding:20px;">
            {{$pages->links()}}
        </div>
    </div>


        </div>

      </div>
    </section><!-- End Courses Section -->
	
	 <script>


         
        $(document).ready(function(){
			
			
			
            $('.topic_rating').raty({readOnly: true,score: function() {
                return $(this).attr('data-score');
             }});
             
	 
	 
	 
	 
	 		  $('#course_paginate_box').on('click','a.page-link',function(e){
			  
			  
                      var url=$(this).attr('href');

                      load_the_content(e,url);

	
	
	
	
                });
  
  
  
        });
		
		
		function load_the_content(e,url){
			
						  
					var  formData = $("#coursefilter").serialize();

					e.preventDefault();
					$.ajax({
					url: url+'&'+formData,
					type: 'GET',
					dataType: "JSON",
					success: function (res) {
					console.log(res);
					$('#course_pages_content').html(res.data);
					$('#course_paginate_box').html(res.links);

					$('.topic_rating').raty({readOnly: true,score: function() {
					return $(this).attr('data-score');
					}});

					},
					error: function (xhr, status, error) {
					console.log(xhr);
					console.log(status);
					},
					});

		}
		


		
     </script>		