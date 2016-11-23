<?php

$con= mysqli_connect("localhost","root","root","AirlineReservation");
	
	if(!$con){
		die("Connection failed : ".mysqli_connect_error());
	}

session_start();
	$email = $_POST['email'];
	$password = $_POST['password'];

	$_SESSION['email'] = $email;
	$_SESSION['password'] = $password;
	
	
	if(empty($email) || empty ($password)){
		header('Location: errorPage.php');	
		}
		
		else
		{
		$sql = "SELECT * FROM admin where UserName='$email' and Password='$password' ";
		$result	= $con->query($sql);
		
		if(!$row = $result->fetch_assoc()){
			header('Location: errorPage.php');
		}
		else
		{
			header('Location: UpdateFlights.html');
		}
		}
?>
