<?php
session_start();
$ReservationId = substr(md5(microtime()),rand(0,26),5);
$onInstance = $_POST['onInstance'];
$returnInstance = $_POST['returnInstance'];
$fname = $_POST['firstname'];
$lname = $_POST['lastname'];
$dob = $_POST['dob'];
$guests = $_POST['guests'];
$username = $_SESSION['username'];

echo("On instance: $onInstance");
//Add reservation to reservation table
$link = mysqli_connect('localhost', 'root', 'root', 'airlinereservation');
$sql1 = "INSERT INTO reservation(ReservationId, Username,InstanceId, ReturnInstanceId) values ('$ReservationId', '$username', '$onInstance', '$returnInstance');";
$result = mysqli_query($link,$sql1);
if($result)  
{
	echo("Insertion was succesful into Reservation");	
}
else
{
	echo "$sql1";
	echo("Sorry we are unable to make a reservation at this time");
}
//Add passenger to passenger table
for($i=1; $i<=$guests; $i++)
{
	$passengerId = substr(md5(microtime()),rand(0,26),5);
	$fieldname = "firstname".$i;
	echo("fieldname: $fieldname");
	$pass_firstname = $_POST["$fieldname"];
	$fieldname = "age".$i;
	$pass_age = $_POST["$fieldname"];
	$fieldname = "mealpref".$i;
	$pass_mealpref = $_POST["$fieldname"];
	$sql2 = "INSERT INTO passenger(passengerId, Passenger_Name, Passenger_Age, Meal_Preference) values ('$passengerId', '$pass_firstname', '$pass_age', '$pass_mealpref');";
	echo(" Seatsql: $sql2 ");
	$result = mysqli_query($link,$sql2);
	if($result)  
	{
		echo("Insertion was succesful into Passenger");
       // echo "passenger : $i";		
	}
	else
	{
		echo "$sql2";
		echo("Sorry we are unable to make a reservation at this time");
	}
	
	// Adding reservations to the passenger_reservation table
	$sql3 = "INSERT INTO passenger_reservation(PassengerId, ReservationId) values ('$passengerId', '$ReservationId');";
	$result4 = mysqli_query($link,$sql3);
	if($result4)  
	{
		
		echo("Insertion was succesful into Passenger_reservation");	
	}
	else
	{
		echo "$sql4";
		echo("Sorry we are unable to make a reservation at this time");
	}
	
	
}
// Add seat to seats table
for($i=1; $i<=$guests ; $i++)
{
	
	$Seat_no = substr(md5(microtime()),rand(0,26),5);
	$Seat_Category = $_POST["category"];
	$sql4 = "INSERT INTO seats(Seat_no, Seat_Category) values ('$Seat_no', 'Economy');";
	$result = mysqli_query($link,$sql4);
	if($result)  
	{
		
		echo("Insertion was succesful into Seats");	
	}
	else
	{
		//echo "$sql2";
		echo("Sorry we are unable to make a reservation at this time");
	}
// Add seats_reservation to the table
$sql5 = "INSERT INTO seats_reservation(Seat_no, ReservationId) values ('$Seat_no', '$ReservationId');";	
$result2 = mysqli_query($link,$sql5);
	if($result2)  
	{
		echo "$i";
		//echo "$sql3";
		echo("Insertion was succesful into Seats_Reservation");	
	}
	else
	{
		echo "$sql5";
		echo("Sorry we are unable to make a reservation at this time");
	}
}	
// Update the available seats in Availability table

$sql6 = "SELECT Total_Seats FROM available_seats WHERE InstanceId = $onInstance;";	
$result6 = mysqli_query($link,$sql6);
if (mysqli_num_rows($result6)>0)
			{
				while(($row = mysqli_fetch_row($result6))!=null)
				{    
					echo "Total_seats are : " ;
					echo("$row[0] <br />");
				}
				
			}
			else
			{
				echo("Sorry, we are unable to fetch  total_seat information for this flight");
			} 



?>