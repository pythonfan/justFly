<?php
session_start();
//Retrieve form parameters
$fname = $_POST['firstname'];
$lname = $_POST['lastname'];
$email = $_POST['email'];
$password = $_POST['password'];
$bdate = $_POST['birthdate'];
echo $fname. " ". $lname. " ". $email. " ". $password. " ". $bdate[2];
// connect to the mysql database
$link = mysqli_connect('localhost', 'root', 'root', 'airlinereservation');
//check if user with same username exists in db
$sql = "SELECT * FROM user WHERE username = '".$email."';";
$result = mysqli_query($link,$sql);

if(mysqli_fetch_row($result)!=null)
{
	$_SESSION['error_msg'] =  "User with this username already exists. Please sign up with a different username";
	header("Location: errorPage.php");
	session_write_close();
}
else
{
$sql = "INSERT INTO user (username, firstname, lastname, password, Dob) VALUES ('".$email."', '". $fname. "', '" . $lname . "', '" .$password . "', '". $bdate. "');";
echo $sql;

// excecute SQL statement
$result = mysqli_query($link,$sql);
 
// die if SQL statement failed
if (!$result){ 
	//echo("SQL Error");
	$_SESSION['error_msg'] = "There was a problem while signing up. Please try again.";
	header("Location: errorPage");
  die(mysqli_error());
}
else
{
	$_SESSION['user_fname'] = $fname;
$_SESSION['user_lastname'] = $lname;
$_SESSION['username'] = $email;
header("Location: viewReservations.php");
}
}

?>