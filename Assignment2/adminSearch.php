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
		//Unassign taxi when pickuptime is less than 2 hours and greater than 0 and status is unassigned.
		$query = "SELECT * FROM $sql_table 
							WHERE (TIMESTAMPDIFF(MINUTE, CURTIME(), PickupTime) <= 120)
										AND (TIMESTAMPDIFF(MINUTE, CURTIME(), PickupTime) > 0)
										AND (`Status` = 'unassigned');";
		$result = mysqli_query($connection, $query);
		
		//Create a layout to display data.
		echo "<table border='2'>
		<tr>
		<th>Booking Number</th>
		<th>Name</th>
		<th>Phone Number</th>
		<th>Pickup Address</th>
		<th>Destination</th>
		<th>Pickup Time</th>
		<th>Pickup Date</th>
		<th>Booking Time</th>
		<th>Status</th>
		</tr>";
		
		while($row = mysqli_fetch_array($result)){
			echo "<tr>";
			echo "<td>" . $row['BookingNumber'] . "</td>";
			echo "<td>" . $row['Name'] . "</td>";
			echo "<td>" . $row['Phone'] . "</td>";
			echo "<td>" . $row['PickUp'] . "</td>";
			echo "<td>" . $row['Destination'] . "</td>";
			echo "<td>" . $row['PickupTime'] . "</td>";
			echo "<td>" . $row['PickupDate'] . "</td>";
			echo "<td>" . $row['BookingTime'] . "</td>";
			echo "<td>" . $row['Status'] . "</td>";
			echo "</tr>";
	}
	echo "</table>";
	}
	mysqli_close($connection);
?>