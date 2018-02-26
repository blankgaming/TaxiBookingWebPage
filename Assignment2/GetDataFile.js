// file GetDataFile.js
var 
xhr = createRequest();
function getData(dataSource, divID, aName, aPhone, aPickUp, aDestination, aPickupTime, aPickupDate)  {
    if(xhr) {
 	var obj = document.getElementById(divID);
 	var requestbody ="Name="+encodeURIComponent(aName)+"&Phone="+encodeURIComponent(aPhone)+"&PickUp="+encodeURIComponent(aPickUp)+"&Destination="+encodeURIComponent(aDestination)+"&PickupTime="+encodeURIComponent(aPickupTime)+"&PickupDate="+encodeURIComponent(aPickupDate);
 	xhr.open("POST", dataSource, true); // end function getData()
	
	//Sets the content type header information for sending url encoded variables in the request.
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

	xhr.onreadystatechange = function() {
			
	if(xhr.readyState == 4 && xhr.status == 200){
				
		obj.innerHTML = xhr.responseText;
			
	}
	
	}
		
		xhr.send(requestbody);

	}
} // end function getData() 
