//Global variables to trak month,year,day
var showmonth;
var showyear;
var showday;

window.onload = function() {
	  initialCalendar();
};


function initialCalendar(){
    // Create our XMLHttpRequest object
    var hr = new XMLHttpRequest();
    // Create some variables we need to send to our PHP file
    var url = "calendar_start.php";
    var currentTime = new Date();
    showmonth = currentTime.getMonth() + 1;
    showyear = currentTime.getFullYear();
    showday = currentTime.getDate();
    var vars = "showmonth="+showmonth+"&showyear="+showyear+"&showday="+showday;
    hr.open("POST", url, true);
    // Set content type header information for sending url encoded variables in the request
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // Access the onreadystatechange event for the XMLHttpRequest object
    hr.onreadystatechange = function() {
	    if(hr.readyState == 4 && hr.status == 200) {
		    var return_data = hr.responseText;
			document.getElementById("showCalendar").innerHTML = return_data;
	    }
    };
    // Send the data to PHP now... and wait for response to update the status div
    hr.send(vars); // Actually execute the request
    document.getElementById("showCalendar").innerHTML = "processing...";
}

function next_month(){
	var nextmonth = showmonth + 1;
	if (nextmonth > 12) {
		nextmonth = 1;
		showyear++;
	}
	showmonth = nextmonth;
	// Create our XMLHttpRequest object
    var hr = new XMLHttpRequest();
    // Create some variables we need to send to our PHP file
    var url = "calendar_start.php";
    var vars = "showmonth="+showmonth+"&showyear="+showyear;
    hr.open("POST", url, true);
    // Set content type header information for sending url encoded variables in the request
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // Access the onreadystatechange event for the XMLHttpRequest object
    hr.onreadystatechange = function() {
	    if(hr.readyState == 4 && hr.status == 200) {
		    var return_data = hr.responseText;
			document.getElementById("showCalendar").innerHTML = return_data;
	    }
    };
    // Send the data to PHP now... and wait for response to update the status div
    hr.send(vars); // Actually execute the request
    document.getElementById("showCalendar").innerHTML = "processing...";
}

function last_month(){
	var lastmonth = showmonth - 1;
	if (lastmonth < 1) {
		lastmonth = 12;
		showyear--;
	}
	showmonth = lastmonth;
	// Create our XMLHttpRequest object
    var hr = new XMLHttpRequest();
    // Create some variables we need to send to our PHP file
    var url = "calendar_start.php";
    var vars = "showmonth="+showmonth+"&showyear="+showyear;
    hr.open("POST", url, true);
    // Set content type header information for sending url encoded variables in the request
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // Access the onreadystatechange event for the XMLHttpRequest object
    hr.onreadystatechange = function() {
	    if(hr.readyState == 4 && hr.status == 200) {
		    var return_data = hr.responseText;
			document.getElementById("showCalendar").innerHTML = return_data;
	    }
    };
    // Send the data to PHP now... and wait for response to update the status div
    hr.send(vars); // Actually execute the request
    document.getElementById("showCalendar").innerHTML = "processing...";
}

function overlay(){
	var e1 = document.getElementById("overlay");
	e1.style.display = (e1.style.display == "block") ? "none" : "block";
	var e2 = document.getElementById("events");
	e2.style.display = (e2.style.display == "block") ? "none" : "block";
	var e3 = document.getElementById("eventsBody");
	e3.style.display = (e3.style.display == "block") ? "none" : "block";
}

function show_details(thisId){
	var deets = (thisId.id);
	var e1 = document.getElementById("overlay");
	e1.style.display = (e1.style.display == "block") ? "none" : "block";
	var e2 = document.getElementById("events");
	e2.style.display = (e2.style.display == "block") ? "none" : "block";

	var hr = new XMLHttpRequest();
    // Create some variables we need to send to our PHP file
    var url = "events.php";
    var vars = "deets="+deets;
    hr.open("POST", url, true);
    // Set content type header information for sending url encoded variables in the request
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // Access the onreadystatechange event for the XMLHttpRequest object
    hr.onreadystatechange = function() {
	    if(hr.readyState == 4 && hr.status == 200) {
		    var return_data = hr.responseText;
			document.getElementById("events").innerHTML = return_data;
	    }
    };
    // Send the data to PHP now... and wait for response to update the status div
    hr.send(vars); // Actually execute the request
    document.getElementById("events").innerHTML = "processing...";
	
}