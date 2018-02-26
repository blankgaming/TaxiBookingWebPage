<!--file RequestInput.php -->
<?php
	

	// get Name, Phone, Pickup, Destination, Pickup time and date passed from customer
	$Name = $_POST["Name"];
	$Phone = $_POST["Phone"];
	$PickUp = $_POST["PickUp"];
	$Destination = $_POST["Destination"];
	$PickupTime = $_POST["PickupTime"];
	$PickupDate = $_POST["PickupDate"];

	// write back the password concatenated to end of the name
	ECHO ($Name." : ".$Phone." : ".$PickUp." : ".$Destination." : ".$PickupTime." : ".$PickupDate);


	require_once('/home/dyd2298/public_html/Assignment2/sqlinfo.inc.php');

	//connect to the database.
	$connection = @mysqli_connect($sql_host, $sql_user, $sql_pass, $sql_db);
	
	//checks if the connection is connected successful 
	if(!$connection){
	//Displays an error message if connection fails, would avoid using die() or exit() as it terminates the execution of the script
		die('Failed connection to the Database: '. mysqli_error($connection));
	}


	else{

		//Creates a table if it does not exits
		$checktable = "SELECT * FROM `dyd2298`. `TaxiBooking`";
		
		$createtable = "CREATE TABLE TaxiBooking (
				BookingNumber INT(255) NOT NULL AUTO_INCREMENT PRIMARY KEY,
				Name VARCHAR(50) NOT NULL,
				Phone INT(12) NOT NULL,
				PickUp VARCHAR(50) NOT NULL,
				Destination VARCHAR(50) NOT NULL,
				PickupTime TIME NOT NULL,
				PickupDate DATE NOT NULL,
				BookingTime TIME NOT NULL,
				BookingDate DATE NOT NULL,
				Status ENUM('unassigned', 'assigned') NOT NULL
				)";
		if ($connection->query($createtable) === TRUE) {
    			echo "\nTable TaxiBooking created successfully";
		} else {
    			//echo "<br>Error creating table: " . $connection->error;
		}

		//A successful connection
		$input = 1;
		date_default_timezone_set('Pacific/Auckland');
		
		//Get the booking number from table.
		$BookingNumber = getBookingNumber($connection);

		//checking if name, phone, pickup, destination and pickuptime empty or incomplete.
		if ($Name=="" || $Phone=="" || $PickUp=="" || $Destination=="" || $PickupTime=="" || $PickupDate==""){
			echo "<br>Error: All Fields must be filled and completed.";
			$input = 0;
		}

		//Format for date and time
		echo date_format($PickupTime, 'G:i A');
		#output: 05:45 PM
		
		echo date_format($PickupDate, 'd/m/Y');
		#output: 24/03/2012

		//Checking if the pick up date and time not in the past.
		if($PickupTime < date(DATE_ATOM, mktime(00,00)) && $PickupDate < date(DATE_ATOM, mktime(mm,dd,yyyy))){
			echo "<br>Error: Pick Up Date and Time must not be in the past.";
			$input = 0; 
		}
		//Checking if the phone number is numberic only
		if(!is_numeric($Phone)){
			echo "<br>Error: Phone number must only use numeric symbols.";
			$input = 0;
		}
		
		//Checking if phone number is less than 12 digits.
		if($Phone == "000000000000"){
			echo "<br>Error: Phone number must contain 12 digits.";
			$input = 0;
		}

		//Setting up the sql query/commands to add data into the table.(database)
		if($input == 1){
			$query = "INSERT INTO `TaxiBooking`"
					."(`BookingNumber`, `Name`, `Phone`, `PickUp`, `Destination`, `PickupTime`, `PickupDate`, `BookingTime`, `BookingDate`, `Status`)"
				. " VALUES "
					."($BookingNumber, '$Name', $Phone, '$PickUp', '$Destination', '$PickupTime', '$PickupDate', '$BookingTime', '$BookingDate', 'unassigned')";

			mysqli_query($connection, $query);
			echo "<br>Thank you! Your booking reference number is $BookingNumber.  You will be picked up in front of your provided address at $PickupTime on $PickupDate";
		}
		//Close the database connection
		$connection->close();
	}

		//Checking the status code if it exits already in the database.
		function checkStatus($connection, $status){
			$query = "SELECT * FROM Status
					WHERE statusCode = '$status'";
			$result = mysqli_query($connection, $query);
		
			$row = mysqli_fetch_row($result);
		
			if($status === $row[0]){
				return 0;
			}
		
			return 1;
		}

		//Checking if the last entered booking number exist in the daatabase and increaments by 1.
		function getBookingNumber($connection){
			$query = "SELECT BookingNumber FROM TaxiBooking ORDER BY BookingNumber DESC LIMIT 1;";
			$result = mysqli_query($connection, $query);

			if($row = mysqli_fetch_array($result)){
				return $row['BookingNumber'] + 1;
			}
			
			return 1;
		}
	
		
			
?>
