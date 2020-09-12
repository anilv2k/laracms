   
  <!-- fullCalendar -->
  <link rel="stylesheet" href="@asset("fullcalendar-5.3.0/lib/main.css")">

  <link rel="stylesheet" href="@asset("plugins/fontawesome-free/css/all.min.css")">


<!-- fullCalendar 2.2.5 -->
<script src="@asset("fullcalendar-5.3.0/lib/main.js")"></script>




   <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Calendar</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Calendar</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>




    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
		
		
	
		  
		  <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-body p-0">
                <!-- THE CALENDAR -->
                <div id="calendar"></div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
	
	
	
	
<script>

  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      themeSystem: 'bootstrap',
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
      },
     
      editable: true,
      navLinks: true, // can click day/week names to navigate views
      dayMaxEvents: true, 
      events: {
        url: '{{ url('calendar/getevents') }}',
        failure: function() {
          /* document.getElementById('script-warning').style.display = 'block' */
        }
      },
      loading: function(bool) {
        /* document.getElementById('loading').style.display =
          bool ? 'block' : 'none'; */
      }
    });

    calendar.render();
  });

</script>

