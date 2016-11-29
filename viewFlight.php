<!DOCTYPE html>
<html lang="en">
<head>
  
  <title>Add Flights</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel = "stylesheet" href="css/home.css">
  <script src="js/home.js"></script>
 
  
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
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-4 col-sm-offset-4 col-xs-offset-2 col-md-offset-4" >
            <form class="form" role="form" method ="POST">
            <input type="submit" name="cancel_flight" value="cancel flight" autofocus  onclick="return true;" class="btn btn-danger"/>          
            </form>
        </div>
	</div>   
</div>

<?php
session_start();
$con= mysqli_connect("localhost","root","root","AirlineReservation");
	
	if(!$con){
		die("Connection failed : ".mysqli_connect_error());
	}

$flight_instance = $_GET['id1'];

$flight_no = $_GET['id2'];


    if(isset($_POST['cancel_flight']))
    {
        echo "
            <script type=\"text/javascript\">
           var r = confirm('Are you sure you want to delete the Flight and corresponding Flight Instance?');
           if(r == true)
           {
           		document.write('<center><h1>Flight# '+ $flight_instance + ' with Instance Id ' + $flight_no + ' has been cancelled'); 		
           }
            </script>
        ";
        
        $sql1 = "DELETE FROM available_seats WHERE InstanceId='$flight_instance'";
        $sql2 = "DELETE FROM flight_instance WHERE InstanceId='$flight_instance' and Flight_no='$flight_no';";
    
        if (mysqli_query($con, $sql1) && mysqli_query($con, $sql2)) 
        {
        	echo "<p><h4><a href='updateFlights.html'> Add or View flight</a></h4></p>";
        }
     }
     
     
     mysqli_close($con);
  ?>






</body>
</html>


