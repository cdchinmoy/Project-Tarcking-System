           
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
    		
	<script>		
	$( function() 
	{	
		$( "#s_date" ).datepicker();
		$( "#e_date" ).datepicker();
		$( "#datepicker1" ).datepicker();
		$( "#datepicker2" ).datepicker();
		$( "#task_deadline" ).datepicker();	
	    //$(".start_time").timepicki();
		//$(".end_time").timepicki();
		//$("#bootstrapModalFullCalendar").fullCalendar();
		//CKEDITOR.replace( 'pro_description' );
	});	
    </script>
   
   
<script>

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
			//alert(difference);
			// format time differnece
			var result = [
				Math.floor(difference / 3600), // an hour has 3600 seconds
				//alert(difference);
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
    
    
    
</body>

</html>
