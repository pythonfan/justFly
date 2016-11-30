<?php
session_start();
$con= mysqli_connect("localhost","root","root","AirlineReservation");
	
	if(!$con){
		die("Connection failed : ".mysqli_connect_error());
	}

	$email = $_POST['email'];
	$password = $_POST['password'];
	$_SESSION['admin_email'] = $email;
	//$_SESSION['password'] = $password;
	
	
	if(empty($email) || empty ($password)){
		header('Location: AdminErrorPage.php');	
		}
		
		else
		{
		$sql = "SELECT * FROM admin where UserName='$email' and Password='$password' ";
		$result	= $con->query($sql);
		
		if(!$row = $result->fetch_assoc()){
			header('Location: AdminErrorPage.php');
		}
		else
		{
			header('Location: UpdateFlightsPage.php');
		}
		}
?>