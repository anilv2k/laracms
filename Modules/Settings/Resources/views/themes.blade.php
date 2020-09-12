

<!-- jQuery -->
<script src="@asset("plugins/jquery/jquery.min.js")"></script>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Themes</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
                    <li class="breadcrumb-item active">Themes</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            @forelse ($themes as $key=>$item)
            <?php 
			
			$current_theme = $active_theme==$key;


			
			?>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-paint-brush"></i>
                            {{$item}}
                        </h3>
                        <button
                            class="btn btn-sm float-right theme-btn {{ $current_theme ? 'btn-success': 'btn-primary activate-theme-btn'}}"
                            {{ $current_theme ? 'disabled': ''}}
                            data-theme-id="{{$key}}">{{ $current_theme ? 'Active Theme': 'Activate'}}</button>
                    </div>
                    <!-- /.card-header -->

                    <div class="card-body">
                        <img class="img-thumbnail"
                            src="{{File::exists(public_path('themes/'.$key.'/theme.png')) ? asset('themes/'.$key.'/theme.png'): asset('img/no-image.jpg')}}"
                            alt="" srcset="">
                    </div>
                    <!-- /.card-body -->
                    {{-- <div class="card-footer">
                      <button class="btn btn-sm float-right theme-btn {{ $current_theme ? 'btn-success': 'btn-primary activate-theme-btn'}}"
                    {{ $current_theme ? 'disabled': ''}}
                    data-theme-id="{{$key}}">{{ $current_theme ? 'Active Theme': 'Activate'}}</button>
                </div> --}}
            </div>
            <!-- /.card -->
        </div>
        <!-- ./col -->

        @empty

        @endforelse
    </div>
    </div>
</section>
@csrf


<script>

$(document).ready(function() {
    $('.activate-theme-btn').click(function() {
        var formData = new FormData();
        var btn = $(this);
        formData.append('key[site_theme]',btn.data('theme-id'));
        formData.append('type','options');
        formData.append('_token',$('[name="_token"]').val());

        btn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Activating');
        btn.attr('disabled',true);

		var APP_URL = {!! json_encode(url('/')) !!};
		
		
		   $.ajax({
        url: '{{ url('app/settings') }}',
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        async: false,
        success: function (data)
        {
			
			    console.log(data);
                if (data.status) {
                  //  toastr.success(btn.data('theme-id')+' has been activated successfully')
                    $('.theme-btn').attr('disabled',false).text('Activate').removeClass('btn-success btn-primary').addClass('btn-primary');
                    btn.attr('disabled',true).text('Active Theme').removeClass('btn-success').addClass('btn-success');
                }
			
		},
        error: function (jqXHR, textStatus, errorThrown)
        {
			
            // $('.error-message').html(jqXHR.responseJSON.message);
        }
		
   });
   
   
   
   
		
		/*
        $.ajax({
            url: APP_URL+'/app/settings/',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function (data) {
                console.log(data);
                if (data.status) {
                    toastr.success(btn.data('theme-id')+' has been activated successfully')
                    $('.theme-btn').attr('disabled',false).text('Activate').removeClass('btn-success btn-primary').addClass('btn-primary');
                    btn.attr('disabled',true).text('Active Theme').removeClass('btn-success').addClass('btn-success');
                }
            },
            error: function (xhr, status, error) {
                btn.attr('disabled',false);
                btn.text('Activate');
                console.log(xhr);
                console.log(status);
                if (xhr.status == 422) {
                    //validation error
                    $.each(xhr.responseJSON.errors, function (key, value) {
                        console.log(key);

                    });
                    toastr.error(xhr.responseJSON.message);
                }
                else{
                   // toastr.error("Please try again after sometime!!","Oops!! Error occurred");
                }
            },
        });
		
		*/
		
    });
});
</script>