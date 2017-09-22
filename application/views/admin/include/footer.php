
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    	
	<script type="text/javascript">		
	$( function() {	
	
		if( $('#s_date').length ) 
		{
			$( "#s_date" ).datepicker();
		}
		if( $('#e_date').length ) 
		{
			$( "#e_date" ).datepicker();
		}	
		if( $('#datepicker').length ) 
		{
			$( "#datepicker" ).datepicker();
		}	
		
		if( $('#joining_date').length ) 
		{
			$( "#joining_date" ).datepicker();
		}	

		if( $('#start_time').length ) 
		{
			$( "#start_time" ).timepicki();
		}	

		if( $('#end_time').length ) 
		{
			$( "#end_time" ).timepicki();
		}			
	
		//$( "#s_date" ).datepicker();
		//$( "#e_date" ).datepicker();
		//$( "#datepicker" ).datepicker();
		//$( "#joining_date" ).datepicker();
		//$(".start_time").timepicki();
		//$(".end_time").timepicki();
		//CKEDITOR.replace( 'pro_description' );	
	} );	
    </script>
    
<script>
	/*var timer2 = "1:01";
	var interval = setInterval(function() {
	
	
	  var timer = timer2.split(':');
	  //by parsing integer, I avoid all extra string processing
	  var minutes = parseInt(timer[0], 10);
	  var seconds = parseInt(timer[1], 10);
	  --seconds;
	  minutes = (seconds < 0) ? --minutes : minutes;
	  if (minutes < 0) {
		  alert('time shesh hoye gelo re pagla!');
		  $("#update").hide();
		  clearInterval(interval);
	  }
	  seconds = (seconds < 0) ? 59 : seconds;
	  seconds = (seconds < 10) ? '0' + seconds : seconds;
	  //minutes = (minutes < 10) ?  minutes : minutes;
	  $('.countdown').html(minutes + ':' + seconds);
	  timer2 = minutes + ':' + seconds;
	}, 1000);*/
	
function Compare() {
		
	var strStartTime = document.getElementById("start_time").value;
	var strEndTime = document.getElementById("end_time").value;
	
	if(strStartTime && strEndTime)
	{ 
			
		var startTime = new Date().setHours(GetHours(strStartTime), GetMinutes(strStartTime), 0);
		var endTime = new Date(startTime);
		endTime = endTime.setHours(GetHours(strEndTime), GetMinutes(strEndTime), 0);
		if (startTime > endTime) {
			alert("Start Time is greater than end time!");
		}
		if (startTime == endTime) {
			alert("Start Time equals end time!");
		}
		if (startTime < endTime) {

			var hours = Number(strStartTime.match(/^(\d+)/)[1]);
			var minutes = Number(strStartTime.match(/:(\d+)/)[1]);
			var AMPM = strStartTime.match(/\s(.*)$/)[1];
			if(AMPM == "PM" && hours<12) hours = hours+12;
			if(AMPM == "AM" && hours==12) hours = hours-12;
			var sHours = hours.toString();
			var sMinutes = minutes.toString();
			if(hours<10) sHours = "0" + sHours;
			if(minutes<10) sMinutes = "0" + sMinutes;
			var starthour = sHours + ":" + sMinutes;
		
			var hours = Number(strEndTime.match(/^(\d+)/)[1]);
			var minutes = Number(strEndTime.match(/:(\d+)/)[1]);
			var AMPM = strEndTime.match(/\s(.*)$/)[1];
			if(AMPM == "PM" && hours<12) hours = hours+12;
			if(AMPM == "AM" && hours==12) hours = hours-12;
			var sHours = hours.toString();
			var sMinutes = minutes.toString();
			if(hours<10) sHours = "0" + sHours;
			if(minutes<10) sMinutes = "0" + sMinutes;
			var endhour = sHours + ":" + sMinutes;

			var a = starthour + ":" + "00";
			var b = endhour + ":" + "00";

			var difference = Math.abs(toSeconds(a) - toSeconds(b));

			// format time differnece
			var result = [
				Math.floor(difference / 3600), // an hour has 3600 seconds
				Math.floor((difference % 3600) / 60), // a minute has 60 seconds
				difference % 60
			];
			if(result[1] < 10){
				result[1] = "0" + result[1];
			}
			var result = result[0] + "." + result[1] + " Hour";
			
			document.getElementById("calculate_time").value = result;

		}		
		

		
	}
	
	
	
}
	
function GetHours(d) {
	
	var h = parseInt(d.split(':')[0]);
	if (d.split(':')[1].split(' ')[1] == "PM") {
	h = h + 12;
	}
	return h;
}
	
function GetMinutes(d) {
	return parseInt(d.split(':')[1].split(' ')[0]);
}	
	

function toSeconds(time_str) {
    // Extract hours, minutes and seconds
    var parts = time_str.split(':');

    // compute  and return total seconds
    return parts[0] * 3600 + // an hour has 3600 seconds
    parts[1] * 60 + // a minute has 60 seconds
    +
    parts[2]; // seconds
}



	
</script>
    
    <script>
		var inStart = document.getElementById('start_time');
		var inEnd = document.getElementById('end_time');
		
		function calc_time(){
			
			var st_time =calc_stime(inStart);
			var et_time = calc_etime(inEnd);
		
			if(et_time < st_time){
				alert('Start Time is greater than end time!');
			}else if(et_time == st_time){
				alert('Start Time equals end time!');
			}else {
				var th_difference = parseInt(et_time - st_time);
				var t_hour = Math.floor(th_difference/60);
				var t_minute= th_difference % 60;

 				document.getElementById("calculate_time").value= t_hour+'.'+t_minute + ' Hour';
			}
		}
		
		function calc_stime(insStart){
			
			var timeSplit = insStart.value.split(':'),
				hours,
				minutes;
	
			hours = parseInt(timeSplit[0]);
			minutes = parseInt(timeSplit[1]);
			
			
			var timeSplit2 = insStart.value.split(' '),
				time,
				meridian;
	
			time = parseInt(timeSplit2[0]);
			meridian = timeSplit2[1];
			
			
			if(meridian == 'AM')
			{
				if( hours < 12){
					hours = parseInt(hours - 12);
					
				}
				else {
					hours = parseInt(-12);
					
				}
			} 
			
			hours = parseInt(hours * 60);
			var sst_time = parseInt(hours + minutes) ;
			
			return sst_time; 
		}
		
		function calc_etime(insEnd){
			var timeSplits = insEnd.value.split(':'),
				hourss,
				minutess;
			hourss = parseInt(timeSplits[0]);
			minutess = parseInt(timeSplits[1]);
			
			
			var timeSplits2 = insEnd.value.split(' '),
				times,
				meridians;
	
			times = parseInt(timeSplits2[0]);
			meridians = timeSplits2[1];
			
			
			if (meridians == 'AM')
			{ 
			   // alert('hi');
				if( hourss < 12){
					hourss = parseInt(hourss - 12);
					
				}
				else {
					hourss = parseInt(-12);
					
				}
			} 
			
			hourss = parseInt(hourss * 60);
			var est_time = parseInt(hourss + minutess) ; 
			
			return est_time;
		}
			
		</script>
</body>

</html>
