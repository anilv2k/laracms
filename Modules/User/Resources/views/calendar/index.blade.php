@extends('user::layouts.master')


  <!-- fullCalendar -->
  <link rel="stylesheet" href="@asset("fullcalendar-5.3.0/lib/main.css")">

  <link rel="stylesheet" href="@asset("plugins/fontawesome-free/css/all.min.css")">





    <div class="">
         
                <!-- THE CALENDAR -->
                      <div id="calendar"></div>
    
           
    </div>



   
	
	

<!-- jQuery -->
<script src="@asset("plugins/jquery/jquery.min.js")"></script>




<!-- fullCalendar 2.2.5 -->
<script src="@asset("fullcalendar-5.3.0/lib/main.js")"></script>





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




<script>
  $(function () {
       

 //  $('#calendar').fullCalendar();

/*
    $('#calendar').fullCalendar({
			defaultDate: '2014-11-12',
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			events: [
				{
					title: 'All Day Event',
					start: '2014-11-01'
				},
				{
					title: 'Long Event',
					start: '2014-11-07',
					end: '2014-11-10'
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: '2014-11-09T16:00:00'
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: '2014-11-16T16:00:00'
				},
				{
					title: 'Conference',
					start: '2014-11-11',
					end: '2014-11-13'
				},
				{
					title: 'Meeting',
					start: '2014-11-12T10:30:00',
					end: '2014-11-12T12:30:00'
				},
				{
					title: 'Lunch',
					start: '2014-11-12T12:00:00'
				},
				{
					title: 'Meeting',
					start: '2014-11-12T14:30:00'
				},
				{
					title: 'Happy Hour',
					start: '2014-11-12T17:30:00'
				},
				{
					title: 'Dinner',
					start: '2014-11-12T20:00:00'
				},
				{
					title: 'Birthday Party',
					start: '2014-11-13T07:00:00'
				},
				{
					title: 'Click for Google',
					url: 'http://google.com/',
					start: '2014-11-28'
				}
			]
		});


    */
		
	});

   
</script>