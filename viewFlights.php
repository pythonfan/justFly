<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Theme Made By www.w3schools.com - No Copyright -->
  <title>Bootstrap Theme Company Page</title>
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
        <li><a href="viewFligths.php">FLIGHTS</a></li>
		<?php
		if(isset($_SESSION['user_fname']))
		{
			echo("<li><a href='viewReservations.php'>RESERVATIONS</a></li>");
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

<!--Select Flights-->
<div class="jumbotron text-center">
<form action="viewFlights.php">
<div class="container">
   

  <h1>Just Fly </h1>
  <p>Where would you like to fly??</p>
    <label class="radio-inline">
      <input type="radio" name="optradio">Round Trip
    </label>
    <label class="radio-inline">
      <input type="radio" name="optradio">One way
    </label>
    <label class="radio-inline">
      <input type="radio" name="optradio">Multicity
    </label>
</div>
  <br>
<div class="form-inline" >
  <select name="Guests" class="form-control"  placeholder="Guests" required>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
    <option value="6">6</option>
    <option value="7">7</option>
    <option value="8">8</option>
    <option value="9">9</option>
    <option value="10">10</option>
    <option value="11">11</option>
    <option value="12">12</option>
    <option value="13">13</option>
    <option value="14">14</option>
    <option value="15">15</option>
 </select>

   <select name="From" class="form-control" placeholder="From" required>
    <option value="Dallas">Dallas</option>
    <option value="San Diego">San Diego</option>
    <option value="Florida">Florida</option>
    <option value="NewYork">New york</option>
	<option value="Los Angeles">Los Angeles</option>
  </select>
   <select name="To" class="form-control"  placeholder="To" required>
    <option value="Chicago">Chicago</option>
    <option value="Raleigh">Raleigh</option>
    <option value="Atlanta">Atlanta</option>
    <option value="Austin">Austin</option>
	<option value="Los Angeles">Los Angeles</option>
	<option value="Dallas">Dallas</option>

  </select>
  
  <button type="submit" class="btn btn-danger">Search Flights</button>
</div>
</form>
</div>
<!-- Display filghts -->
<!--List reservations-->
<div id="services" class="container-fluid text-center">
 <?php
  if(isset($_GET['optradio']))
  {
	$fromAirport = $_GET['From'];
	$toAirport = $_GET['To'];
	$link = mysqli_connect('localhost', 'root', 'root', 'airlinereservation');
	//check if user with same username exists in db
	$sql = "SELECT f.flight_no, fi.DepartureDate, ta.cityName, fa.cityName FROM flight f JOIN flight_Instance fi ON f.flight_no =  fi.Flight_no JOIN Airport ta ON f.from_airport_id = ta.AirportId JOIN Airport fa ON f.to_airport_id = fa.AirportId WHERE fa.cityName = '".$fromAirport."' AND ta.cityName = '".$toAirport."';";
	$result = mysqli_query($link,$sql);

	if (mysqli_num_rows($result)>0)
	{
		echo("<table class='table table-hover' >");
		echo("<thead><th>Flight Number</th><th>Date</th><th>From</th><th>To</th></thead><tbody>");
	while(($row = mysqli_fetch_row($result))!=null)
	{
		echo("<tr><td>". $row[0]. "</td><td>" .$row[1]. "</td><td>" .$row[2]. "</td><td>" .$row[3]. "</td></tr>");
	}
		echo("</tbody></table>");
	}
	else
	{
		echo("We are sorry! We do not have any flights for this route.");
		echo ($sql);
	}
  }
  else
  {
	echo("Please select where you would like to fly.");  
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

