<!DOCTYPE html>
<html lang="en">
<head> 
  <title>Update Flights</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel = "stylesheet" href="css/home.css">
<!--   <script src = "js/updateFlights.js"></script> -->
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <img src="logo.png" alt="LOGO" height="100" width="130"/>
     
    </div>  
  </div>
</nav>

<div class="jumbotron text-center">

<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "AirlineReservation";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
} 
session_start();
$sql = "SELECT InstanceId, Flight_no FROM flight_instance";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
     
     while($row = $result->fetch_assoc()){
     $_SESSION['flight_instance'] = $row["InstanceId"];
     $_SESSION['flight_no'] = $row["Flight_no"];
       $DisplayForm = True;
       if(isset($_POST['submit']))
       {
       	$DisplayForm = False;
       }
       $var1 = $_SESSION['flight_instance'];
       $var2 = $_SESSION['flight_no'];
         echo "<a id='aa' href='viewFlight.php?id1=$var1&id2=$var2'>Flight Instance: " .$row["InstanceId"]. " , Flight#: ".$row["Flight_no"]."</a><br>";

    }
}

	?>
        
       
              
</div>
</body>
</html>