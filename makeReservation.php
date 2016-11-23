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
	echo("Insertion was succesful");	
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
	$sql1 = "INSERT INTO passenger(passengerId, Passenger_Name, Passenger_Age, Meal_Preference) values ('$passengerId', '$pass_firstname', '$pass_age', '$pass_mealpref');";
	echo(" Seatsql: $sql1 ");
	$result = mysqli_query($link,$sql1);
	if($result)  
	{
		echo("Insertion was succesful");	
	}
	else
	{
		echo "$sql1";
		echo("Sorry we are unable to make a reservation at this time");
	}
}
?>