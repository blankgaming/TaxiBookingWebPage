<?php
	require_once('/home/dyd2298/public_html/Assignment2/sqlinfo.inc.php');
	//Connect to the database.
	$connection = @mysqli_connect($sql_host, $sql_user, $sql_pass, $sql_db);
	  
	//Checks if the connection is connected successful.
	if(!$connection){
		// Displays an error message, avoid using die() or exit() as this terminates the execution of the PHP script
		die('Failed connection to the Database: ' . mysqli_error($connection));
	} 
	else{
		$BookingNumber = $_POST["BookingNumber"];

		mysqli_select_db($connection,"TaxiBooking");
		$query = "UPDATE `TaxiBooking` SET `Status` = 'assigned' WHERE `BookingNumber` = $BookingNumber;";
		$result = mysqli_query($connection,$query);
		echo "<br>The booking request " . $BookingNumber . " has been properly assigned.";
	}
	mysqli_close($connection);
?>