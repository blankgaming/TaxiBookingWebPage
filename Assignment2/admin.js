function searchBooking(){
	var xmlhttp;
	if(window.XMLHttpRequest){ //Code to support IEv7+, Firefox, Chrome.
		xmlhttp = new XMLHttpRequest();
	} 
	else{ 
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	var url = "adminSearch.php"; //initialize the url object with adminSearch.php file.
	xmlhttp.open("GET", url, true);
	//Setting the content type header information for sending url encoded variables in the request.
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.onreadystatechange = function(){
		if(xmlhttp.readyState==4 && xmlhttp.status==200){
			document.getElementById("table").innerHTML = xmlhttp.responseText;
		}
	}
	xmlhttp.send();
    document.getElementById("table").innerHTML = "processing the request...";
}
function assignTaxi(){
	var xmlhttp;
	if(window.XMLHttpRequest){ //Code to support IEv7+, Firefox, Chrome.
		xmlhttp = new XMLHttpRequest();
	} 
	else{
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	var url = "adminAssign.php";
	var BookingNumber = document.getElementById("BookingNumber").value;
	var bn = "BookingNumber="+BookingNumber;
	xmlhttp.open("POST", url, true);
	//Setting the content type header information for sending url encoded variables in the request.
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.onreadystatechange = function(){
		if(xmlhttp.readyState==4 && xmlhttp.status==200){
			document.getElementById("result").innerHTML = xmlhttp.responseText;
		}
	}
	xmlhttp.send(bn);
    document.getElementById("result").innerHTML = "processing the request...";
}



































