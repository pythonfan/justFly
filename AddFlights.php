<?php

$con= mysqli_connect("localhost","root","root","AirlineReservation");
	
	if(!$con){
		die("Connection failed : ".mysqli_connect_error());
	}

session_start();

	$flight_no = $_POST['flight_no'];
	$depart_time  = $_POST['depart_time'];
	$arrive_time = $_POST['arrive_time'];
	$from = $_POST['from'];
	$to = $_POST['to'];
	$flight_Instance = $_POST['flight_Instance'];
	$UserName = $_SESSION['email'];
	$seats = $_POST['seats'];
	$arrive_date = $_POST['arrive_date'];
	$depart_date = $_POST['depart_date'];
	$fromCity = $_POST['fromCity'];
	$toCity = $_POST['toCity'];
	$fromState = $_POST['fromState'];
	$toState = $_POST['toState'];
	$category = $_POST['category'];
	$availability = $seats - 1;
	
	
	$_SESSION['flight_no'] = $flight_no;
	$_SESSION['depart_time'] = $depart_time;
	$_SESSION['arrive_time'] = $arrive_time;
	$_SESSION['from'] = $from;
	$_SESSION['to'] = $to;
	$_SESSION['flight_Instance'] = $flight_Instance;
	$_SESSION['arrive_date'] = $arrive_date;
	$_SESSION['depart_dat	e'] = $depart_date;
	$_SESSION['fromCity'] = $fromCity;
	$_SESSION['toCity'] = $toCity;
	$_SESSION['fromState'] = $fromState;
	$_SESSION['toState'] = $toState;
	$_SESSION['category'] = $category;
	$_SESSION['seats'] = $seats;
	$_SESSION['availability'] = $seats - 1;  // Has to come from user table
	


	if(empty($flight_no) || empty($depart_time) || empty($arrive_time) || empty($from)|| empty($to) 
	|| empty($flight_Instance) || empty($seats) || empty($depart_date) || empty($arrive_date) || empty($fromCity) 
	|| empty($toCity) || empty($fromState) || empty($toState) || empty($category))
	{
		header('Location: errorPage.php');	
			
	}
	
	else
	{
		$query = mysqli_query($con, "SELECT * FROM airport WHERE AirportId='".$from."'");

		if(mysqli_num_rows($query) > 0)
		{
    		$sql3 = "INSERT INTO flight(flight_no, SheduledDeparture, ScheduledArrival, From_Airport_id, To_Airport_id) values ('$flight_no', '$depart_time', '$arrive_time', '$from', '$to');";
			$sql4 = "INSERT INTO flight_instance(InstanceId, ArriveTime, DepartTime, ArrivalDate, DepartureDate, Flight_no) values ('$flight_Instance', '$arrive_time', '$depart_time', '$arrive_date', '$depart_date', '$flight_no');";
			$sql5 = "INSERT INTO available_seats(CategoryId, InstanceId, Availability, Total_Seats) values ('$category', '$flight_Instance',$availability, $seats);"; 
			
			if (mysqli_query($con, $sql3) && mysqli_query($con, $sql4) && mysqli_query($con, $sql5)) 
				{
					header('Location: Success.html');
				}
			else
				{
					header('Location: errorpagephp');
				}
		
		}	

		else
		{
		$sql1 = "INSERT INTO airport(AirportId, CityName, State) values ('$from', '$fromCity', '$fromState');";
		$sql2 = "INSERT INTO airport(AirportId, CityName, State) values ('$to', '$toCity', '$toState');";
		$sql3 = "INSERT INTO flight(flight_no, SheduledDeparture, ScheduledArrival, From_Airport_id, To_Airport_id) values ('$flight_no', '$depart_time', '$arrive_time', '$from', '$to');";
		$sql4 = "INSERT INTO flight_instance(InstanceId, ArriveTime, DepartTime, ArrivalDate, DepartureDate, Flight_no) values ('$flight_Instance', '$arrive_time', '$depart_time', '$arrive_date', '$depart_date', '$flight_no');";
		$sql5 = "INSERT INTO available_seats(CategoryId, InstanceId, Availability, Total_Seats) values ('$category', '$flight_Instance',$availability, $seats);"; 
		if (mysqli_query($con, $sql1) && mysqli_query($con, $sql2) && mysqli_query($con, $sql3) && mysqli_query($con, $sql4) && mysqli_query($con, $sql5)) 
		{
			header('Location: Success.html');
		}
		else
		{
			header('Location: errorpage1.html');
		}
		
		}
	}	
	mysqli_close($con);	
?>
