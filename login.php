<?php
//header("Location: signUp.html");
session_start();
$email = $_POST['username'];
$password = $_POST['password'];
// connect to the mysql database
$link = mysqli_connect('localhost', 'root', 'root', 'airlinereservation');
//check if user with same username exists in db
$sql = "SELECT password, firstname, lastname FROM user WHERE username = '".$email."';";
echo $sql;
$result = mysqli_query($link,$sql);
if($result)
{
	$row = mysqli_fetch_row($result);
	//echo $row[0]. " ".$row[1]. " ". $row[2];
	if($row!=null && strcasecmp($row[0], $password) == 0)
	{
		$_SESSION['user_fname'] = $row[1];
		$_SESSION['user_lastname'] = $row[2];
		$_SESSION['username'] = $email;
		session_write_close();
		echo "Authenticated";
		header("Location: viewReservations.php");
	}
	else
	{
		$_SESSION['error_msg'] = "Login Failed.";
		session_write_close();
		header("Location: errorPage.php");
	}
}
else
	{
		$_SESSION['error_msg'] = "Login Failed.";
		session_write_close();
		header("Location: errorPage.php");
	}
?>