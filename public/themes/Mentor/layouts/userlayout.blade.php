<?php

/*
theme NamE: User Template
Theme URI: http://stackoverflow.com
Author: Anil Kumar
Author URI: http://stackoverflow.com
Description: Sample of Stack Overflow.
Version: 2.1
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Tags: Default Template
Text Domain: This theme, like SS, is licensed under the GPL.
Use it to make something cool, have fun, and share what you've learned with others.
*/

?>




        @partial('header')

		<?php $user = auth('web')->user();

        $college = Modules\Courses\Entities\College::where('id', $user->college_id)->first();
	  
		?>
		 
    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs" data-aos="fade-in">
      <div class="container">
        <h2> {{ $college->name }}</h2>
       <p>{{ $college->university->name }}, {{ $college->university->address }} </p> 
      </div>
    </div><!-- End Breadcrumbs -->
	
	
	
    <section class="inner-page">
      <div class="container">
	  
	  

<?php $user = auth('web')->user(); ?>


<style>

.user-menu ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
}

.user-menu li {
  float: left;
}

.user-menu li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

.user-menu li a:hover:not(.active) {
  background-color: #111;
}

.user-menu .active {
  background-color: #4CAF50;
}

.user-pages{ 
 min-height:300px;
}


.user-menu ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
}

.user-menu li {
  float: left;
}

.user-menu li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 8px;
  text-decoration: none;
}

.user-menu li a:hover:not(.active) {
  background-color: #111;
}

.user-menu .active {
  background-color: #4CAF50;
}

.user-pages{ 
 min-height:300px;
 padding-top:20px;
}



img{ max-width:100%;}
.inbox_people {
  background: #f8f8f8 none repeat scroll 0 0;
  float: left;
  overflow: hidden;
  width: 40%; border-right:1px solid #c4c4c4;
}
.inbox_msg {
  border: 1px solid #c4c4c4;
  clear: both;
  overflow: hidden;
}
.top_spac{ margin: 20px 0 0;}


.recent_heading {float: left; width:40%;}
.srch_bar {
  display: inline-block;
  text-align: right;
  width: 60%; padding:
}
.headind_srch{ padding:10px 29px 10px 20px; overflow:hidden; border-bottom:1px solid #c4c4c4;}

.recent_heading h4 {
  color: #05728f;
  font-size: 21px;
  margin: auto;
}
.srch_bar input{ border:1px solid #cdcdcd; border-width:0 0 1px 0; width:80%; padding:2px 0 4px 6px; background:none;}
.srch_bar .input-group-addon button {
  background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
  border: medium none;
  padding: 0;
  color: #707070;
  font-size: 18px;
}
.srch_bar .input-group-addon { margin: 0 0 0 -27px;}

.chat_ib h5{ font-size:15px; color:#464646; margin:0 0 8px 0;}
.chat_ib h5 span{ font-size:13px; float:right;}
.chat_ib p{ font-size:14px; color:#989898; margin:auto}
.chat_img {
  float: left;
  width: 11%;
}
.chat_ib {
  float: left;
  padding: 0 0 0 15px;
  width: 88%;
}

.chat_people{ overflow:hidden; clear:both;}
.chat_list {
  border-bottom: 1px solid #c4c4c4;
  margin: 0;
  padding: 18px 16px 10px;
}
.inbox_chat { height: 550px; overflow-y: scroll;}

.active_chat{ background:#ebebeb;}

.incoming_msg_img {
  display: inline-block;
  width: 6%;
}
.received_msg {
  display: inline-block;
  padding: 0 0 0 10px;
  vertical-align: top;
  width: 92%;
 }
 .received_withd_msg p {
  background: #ebebeb none repeat scroll 0 0;
  border-radius: 3px;
  color: #646464;
  font-size: 14px;
  margin: 0;
  padding: 5px 10px 5px 12px;
  width: 100%;
}
.time_date {
  color: #747474;
  display: block;
  font-size: 12px;
  margin: 8px 0 0;
}
.received_withd_msg { width: 57%;}
.mesgs {
  float: left;
  padding: 30px 15px 0 25px;
  width: 60%;
}

 .sent_msg p {
  background: #05728f none repeat scroll 0 0;
  border-radius: 3px;
  font-size: 14px;
  margin: 0; color:#fff;
  padding: 5px 10px 5px 12px;
  width:100%;
}
.outgoing_msg{ overflow:hidden; margin:26px 0 26px;}
.sent_msg {
  float: right;
  width: 46%;
}
.input_msg_write input {
  background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
  border: medium none;
  color: #4c4c4c;
  font-size: 15px;
  min-height: 48px;
  width: 100%;
}

.type_msg {border-top: 1px solid #c4c4c4;position: relative;}
.msg_send_btn {
  background: #05728f none repeat scroll 0 0;
  border: medium none;
  border-radius: 50%;
  color: #fff;
  cursor: pointer;
  font-size: 17px;
  height: 33px;
  position: absolute;
  right: 0;
  top: 11px;
  width: 33px;
}
.messaging { padding: 0 0 50px 0;}
.msg_history {
  height: 516px;
  overflow-y: auto;
}


</style>

<div class="row">
<div class="col-md-6" > Last Visited: {{ date('d M Y H:i A' ,strtotime($user->last_visited)) }}</div>
<div class="col-md-6" style="text-align:right"> {{ $user->name }}</div>
</div>

<div class="user-menu"  style="padding-top:5px;">
<ul>
  <li><a class="{{ (request()->path()=='user/dashboard') ? 'active':''}}"  href="{{ url('/user/dashboard') }}">Dashboard</a></li>
  <li><a class="{{ (request()->path()=='mycourses') ? 'active':''}}"  href="{{ url('/mycourses') }}">My Courses</a></li>
  <li><a class="{{ (request()->path()=='user/reports') ? 'active':''}}"  href="{{ url('/user/reports') }}">Reports</a></li>
  <li><a class="{{ (request()->path()=='user/messages') ? 'active':''}}"  href="{{ url('/user/messages') }}">Message</a></li> 
  <li><a class=""  href="#">Conference</a></li> 
  <li><a class=""  href="#">Online Exam</a></li> 
  <li><a class=""  href="#">Assignments</a></li> 
  <li><a class="{{ (request()->path()=='user/library') ? 'active':''}}"  href="{{ url('/user/library') }}">Library</a></li>
  <li><a class="{{ (request()->path()=='user/calendar') ? 'active':''}}"  href="{{ url('/user/calendar') }}">Calendar</a></li>
  <li><a class="{{ (request()->path()=='user/profile') ? 'active':''}}"  href="{{ url('/user/profile') }}"> Profile</a></li>
	
  <li style="float:right" ><a href="{{ url('/user/logout') }}">Logout</a></li>
</ul>
</div>



<div class=" user-pages">
<p>
 @content()

 </p>
</div>
	  
      </div>
    </section>
	
     

        @partial('footer')

        @scripts()
  