<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Theme Made By www.w3schools.com - No Copyright -->
  <title>Just Fly</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel = "stylesheet" href="css/home.css">
  <script src = "js/home.js"></script>
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
      <a class="navbar-brand" href="home.html">JustFly</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="home.html">HOME</a></li>
        <li><a href="#services">FLIGHTS</a></li>
        <li><a href="viewReservations.php">RESERVATIONS</a></li>
		<?php
		if(isset($_SESSION['user_fname']))
		{
			echo("<li><a href='logout.php'>LOG OUT</a></li>");			
		}
		else
		{
			echo('<li><a href="login.html">LOG IN</a></li>');
			echo('<li><a href="signUp.html">SIGN UP</a></li>');
		}
		?>
      </ul>
    </div>
  </div>
</nav>

<!--Signup-->
<div class="jumbotron text-center">
<h1>Reservations</h1>
 </div>   
</div>
<!--List reservations-->
<div id="services" class="container-fluid text-center">
 <?php
  if(isset($_SESSION['username']))
  {
	echo ("<h3>Hi ". $_SESSION['user_fname']. "!</h3>");
	$username = $_SESSION['username'];
	$link = mysqli_connect('localhost', 'root', 'root', 'airlinereservation');
	//check if user with same username exists in db
	$sql = "SELECT r.reservationId, f.flight_no, fi.DepartTime, fi.DepartureDate, fa.cityName, ta.cityName, fi.ArriveTime, fi.ArrivalDate  FROM reservation r JOIN user_reservation ur ON r.reservationId = ur.reservationId JOIN user u ON ur.username = u.UserName JOIN Flight_Instance fi ON r.InstanceId = fi.InstanceId JOIN flight f ON fi.flight_no = f.flight_no JOIN airport fa ON f.from_airport_id = fa.airportId JOIN airport ta ON f.to_airport_id = ta.airportId WHERE u.username = '".$username."';";
	$result = mysqli_query($link,$sql);

	if (mysqli_num_rows($result)>0)
	{
		echo("<table class='table table-hover' >");
		echo("<thead><th>Reservation ID</th><th>Flight Number</th><th>Time</th><th>Date</th><th>From</th><th>To</th></thead><tbody>");
	while(($row = mysqli_fetch_row($result))!=null)
	{
		echo("<tr data-toggle='collapse' data-target='#accordion' class='clickable'><td>".$row[0]. "</td><td> " . $row[1]. "</td><td> ". $row[2]. "</td><td> ". $row[3]."</td><td>". $row[4]. "</td><td>". $row[5]. "</td></tr>");
		echo("<tr>
            <td colspan='6'>
                <div id='accordion' class='collapse'>Arrival at destination:<br> Time: ". $row[6]. " Date:   ". $row[7] ."<br>Seats: </div>
            </td>
        </tr>");
	}
		echo("</tbody></table>");
	}
	else
	{
		echo("Currently you have no reservations.");
		echo ($sql);
	}
  }
  ?>
</div>

<footer class="container-fluid text-center">
  <a href="#myPage" title="To Top">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a>
  <p>Bootstrap Theme Made By <a href="http://www.w3schools.com" title="Visit w3schools">www.w3schools.com</a></p>
</footer>


</body>
</html>

