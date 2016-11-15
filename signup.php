<?php
session_start();
echo "Successful login";
//Retrieve form parameters
$fname = $_POST['firstname'];
$lname = $_POST['lastname'];
$email = $_POST['email'];
$password = $_POST['password'];
$bdate = explode("-", $_POST['birthdate']);
echo $fname. " ". $lname. " ". $email. " ". $password. " ". $bdate[2]."/".$bdate[1]."/".$bdate[0];
// connect to the mysql database
$link = mysqli_connect('localhost', 'root', 'root', 'airlinereservation');
//check if user with same username exists in db
$sql = "SELECT * FROM user WHERE username = '".$email."';";
$result = mysqli_query($link,$sql);

if($result)
{
	$_SESSION['error_msg'] =  "User with this username already exists. Please sign up with a different username";
	header("Location: errorPage.php");
	session_write_close();
}
else
{
$sql = "INSERT INTO user (username, firstname, lastname, password, dob_day, dob_month, dob_year) VALUES ('".$email."', '". $fname. "', '" . $lname . "', '" .$password . "', '". $bdate[2] . "', '" . $bdate[1] . "', '" . $bdate[0] . "');";
echo $sql;

// excecute SQL statement
$result = mysqli_query($link,$sql);
 
// die if SQL statement failed
if (!$result){ 
	echo("SQL Error");
  die(mysqli_error());
}
}
?>