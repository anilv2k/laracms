<style>
  .float-right.section-btn{
    display: none;
  }
  .curriculum-card>.card-header:hover .float-right.section-btn{
    display: block;
  }
</style>
  <!-- Content Header (Page header) -->
    <section class="content-header" >
        <div class="container-fluid" >
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Curriculum </h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Curriculum</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      

      <section class="content">
        <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-12">
			
		
						
              <div class="card card-primary card-outline card-tabs">
			  
			  
			  	<div class="card-header">
                        <h3 class="card-title"><span class="crud_card_header_label">Edit</span> 
						Curriculum Details</h3>
						
						<a href="{{ url("admin/courseslist") }}">
                        <button class="btn btn-sm btn-primary float-right" >
						
						
						<i class="fa fa-arrow-left"></i> Back to Courses</button>
						</a>
                        </div>
			  
			  
                <div class="card-header p-0 pt-1 border-bottom-0">
				
			
				<?php /*
				
                  <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="lessons-tab" data-toggle="pill" 
                      href="#lessons-tab-content" role="tab" aria-controls="lessons-tab-content" aria-selected="true">Lessons</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="media-tab" data-toggle="pill" href="#media-tab-content"
                       role="tab" aria-controls="media-tab-content" aria-selected="false">Media</a>
                    </li>
					
					
					

						

                  </ul>
				  */ ?>
				  
						
                </div>
                <div class="card-body">
                  <div class="tab-content" id="custom-tabs-three-tabContent">
                    <div class="tab-pane fade show active" id="lessons-tab-content" role="tabpanel" aria-labelledby="lessons-tab">
                    
                        <div class="row">
						
						<strong>{{$course->name}} </strong>
						
						
                            <div class="col-md-12">
                              <div class="float-right">
                                  <button id="show-section-modal" type="button" class="btn btn-primary btn-sm show-section-modal" data-mode="add"><i class="fas fa-plus"></i> Add Section</button>
                                  <button id="show-lesson-modal" type="button" class="btn btn-primary btn-sm show-lesson-modal" data-mode="add"><i class="fas fa-plus"></i> Add Lesson</button>
                                  <button type="button" class="btn btn-primary btn-sm"><i class="fas fa-sort"></i> Sort Sections</button> 
                              </div>
                            </div>
                            <div class="mt-2 col-md-12" id="curriculum-sections-container">
                              <?php $sec_count = 1; ?>
                                @forelse ($curr as $k=>$item)
                                    

                                <div class="card card-info curriculum-card" id="curriculum-{{$item['id']}}">
                                    <div class="card-header">
                                        <h1 class="card-title">Section {{($sec_count++).' : '.$item['title']}}</h1>
                                        <div class="float-right section-btn">
                                            <button class="btn btn-default btn-xs show-section-modal" data-id="{{$item['id']}}" data-mode="edit"><i class="fas fa-pen"></i> Edit Section</button>
                                            <button class="btn btn-default btn-xs delete-section" data-id="{{$item['id']}}" data-mode="delete"><i class="fas fa-trash"></i> Delete Section</button>
                                            <button class="btn btn-default btn-xs"><i class="fas fa-sort"></i> Sort Lessons</button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                      <div class="list-group">
                                      @if (isset($item['lessons']))
                                          
                                      
                                        @foreach ($item['lessons'] as $lesson)
                                          <p class="list-group-item list-group-item-info" id="curriculum-lesson-{{$lesson['id']}}"><span>{{ $lesson['title'] }}</span>
                                            <button class="btn btn-xs delete-lesson float-right" data-id="{{$lesson['id']}}" data-mode="delete" title="Delete Lesson">
                                              <i class="fas fa-trash"></i>
                                            </button>
                                            
                                            <button class="btn btn-xs show-lesson-modal float-right" data-id="{{$lesson['id']}}" data-mode="edit"  title="Edit Lesson">
                                              <i class="fas fa-pen"></i>
                                            </button> 
                                            
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
					
					<?php /*
                    <div class="tab-pane fade show" id="media-tab-content" role="tabpanel" aria-labelledby="media-tab">
                    
                        <div class="row">
                            media
                        </div>
                    </div>  */ ?>

                  </div>
                </div>
              </div>
            </div>
        </div>
        </div>
      </section>

      <!-- section modal -->
      <div class="modal fade" id="add-section-modal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"><span class="mode-label">Add</span> Section</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                  <input type="hidden" id="section-id">
                  <input type="text" name="title" id="frm-curriculum-name" class="form-control" placeholder="Enter Section Title Here">
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" id="add-section-btn">Save</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

      <!-- lesson modal -->
      <div class="modal fade" id="add-lesson-modal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"><span class="mode-label">Add</span> Lesson</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

                <form id="frm-lesson" data-id="">

                    <div class="form-group">
                        <label for="">Title</label>
                        <input type="text" name="title" class="form-control" placeholder="Enter Title Here">
                    </div>

                    <div class="form-group">
                      <label for="">Section</label>
                      <select name="parent_id" class="form-control">
                          <option value="">Select Section</option>
                          @foreach ($curr as $item)
                            <option value="{{$item['id']}}">{{$item['title']}}</option>
                              
                          @endforeach
                      </select>
                  </div>

                    <div class="form-group">
                      <label for="">File Type</label>
                      <select name="file_type" class="form-control">
                          <option value="">Select File Type</option>
                          <option value="video">Video (mp4)</option>
                          <option value="pdf">PDF Document</option>
                      </select>
                  </div>


                    <div class="form-group">
                        <label for="">Upload File</label>
                        <input type="file" name="lesson_file" class="form-control">
                    </div>

                    

                    <div class="form-group">
                        <label for="">Pages / Duration</label>
                        <input type="text" name="file_length" class="form-control" placeholder="Enter Section Pages / Duration Here">
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" id="add-lesson-btn">Save</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <input type="hidden" id="frm-save-mode" value="add">
      
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <!-- /.modal -->
      <script>
          const base_url = '{{url('')}}';
          var course_id = {{$course->id}};
      </script>