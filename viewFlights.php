<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Theme Made By www.w3schools.com - No Copyright -->
  <title>JustFly - The easiest way to fly</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.8.1/bootstrap-table.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.8.1/bootstrap-table.min.js"></script>
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
			echo('<li><a href="loginPage.php">LOG IN</a></li>');
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
      <input type="radio" name="optradio" value="roundtrip">Round Trip
    </label>
    <label class="radio-inline">
      <input type="radio" name="optradio" value="oneway">One way
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
<?php
   if(isset($_GET['optradio']))
  {
	$fromAirport = $_GET['From'];
	$toAirport = $_GET['To'];
	echo("<h3>Showing flights from ".$fromAirport." to ".$toAirport."</h3>");
  }
  ?>
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
	//retrieve flights
	$sql = "SELECT fi.InstanceId, f.flight_no, fi.DepartureDate, fi.DepartTime, fi.ArriveTime, ta.cityName, fa.cityName FROM flight f JOIN flight_Instance fi ON f.flight_no =  fi.Flight_no JOIN Airport ta ON f.from_airport_id = ta.AirportId JOIN Airport fa ON f.to_airport_id = fa.AirportId WHERE fa.cityName = '".$fromAirport."' AND ta.cityName = '".$toAirport."';";
	$result = mysqli_query($link,$sql);

	if (mysqli_num_rows($result)>0)
	{
		if(strcmp($_GET['optradio'],"oneway")==0)
		{
			echo("<h2>Flights</h2>");
		}
		else if(strcmp($_GET['optradio'],"roundtrip")==0)
		{	
			echo("<h2>Onward Flights</h2>");
		}
		echo("<table id='onwardFlight' class='table table-hover' name='onwardflight' data-toggle='table' data-pagination='true' data-search='true'  data-fixed-columns='true'
       data-fixed-number='2'>");
		echo("<thead><th style=\"display: none;\"></th><th>Flight Number</th><th data-sortable='true'>Date</th><th data-sortable='true'>Departure Time</th><th data-sortable='true'>Arrival Time<th>From</th><th>To</th></thead><tbody>");
	while(($row = mysqli_fetch_row($result))!=null)
	{
		echo("<tr><td id='InstanceId' style=\"display: none;\">".$row[0]."</td><td>"
		. $row[1]. "</td><td>" .$row[2]. "</td><td>" .$row[3]. "</td><td>" .$row[4]. "</td><td>".$row[5]."</td><td>".$row[6]."</td></tr>");
	}
		echo("</tbody></table>");
	}
	else
	{
		echo("We are sorry! We do not have any onward flights for this route.");
		//echo ($sql);
	}
	
	//If 2 way, add Return Flights
	if(strcmp($_GET['optradio'], "roundtrip")==0)
	{
		echo("</br>");
		$sql1 = "SELECT fi.InstanceId, f.flight_no, fi.DepartureDate, fi.DepartTime, fi.ArriveTime, ta.cityName, fa.cityName FROM flight f JOIN flight_Instance fi ON f.flight_no =  fi.Flight_no JOIN Airport ta ON f.from_airport_id = ta.AirportId JOIN Airport fa ON f.to_airport_id = fa.AirportId WHERE fa.cityName = '".$toAirport."' AND ta.cityName = '".$fromAirport."';";
	$result1 = mysqli_query($link,$sql1);

	if (mysqli_num_rows($result1)>0)
	{
	    echo("<h2>Return Flights</h2>");
		echo("<table id='returnFlight' class='table table-hover' name='returnFlight' data-toggle='table' data-pagination='true' data-search='true'>");
		echo("<thead><th style=\"display: none;\"></th><th>Flight Number</th><th>Date</th><th data-sortable='true'>Departure Time</th><th data-sortable='true'>Arrival Time</th><th>From</th><th>To</th></thead><tbody>");
	while(($row1 = mysqli_fetch_row($result1))!=null)
	{
		echo("<tr><td id='InstanceId' style=\"display: none;\" >". $row1[0] ."</td><td>". $row1[1]. "</td><td>" .$row1[2]. "</td><td>" .$row1[3]. "</td><td>" .$row1[4]. "</td><td>".$row1[5]."</td><td>".$row1[6]."</td></tr>");
	}
		echo("</tbody></table>");
	}
	else
	{
		echo("We are sorry! We do not have any return flights for this route.");
		//echo ($sql1);
	}
	
	}
  }
  else
  {
	echo("Please select where you would like to fly.");  
  }
  ?>
  <button id="bookFlights">Book Flight</button>
</div>

<footer class="container-fluid text-center">
  <a href="#myPage" title="To Top">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a>
  <p>Bootstrap Theme Made By <a href="http://www.w3schools.com" title="Visit w3schools">www.w3schools.com</a></p>
</footer>
<script>
$(document).ready(function(){
var onwardInstnceId = null;
var returnInstanceId = null;
$('#onwardFlight').on('click-row.bs.table', function(e, row, $element){$('#onwardFlight').find('tbody tr.active').removeClass('active'); $element.addClass('active'); onwardInstanceId = $element.find('#InstanceId').html();});
$('#returnFlight').on('click-row.bs.table', function(e, row, $element){$('#returnFlight').find('tbody tr.active').removeClass('active'); $element.addClass('active');  returnInstanceId = $element.find('#InstanceId').html();});

// Post to the provided URL with the specified parameters.
$('#bookFlights').click(function post(path, parameters) {
    var form = $('<form></form>');

    form.attr("method", "post");
    form.attr("action", "bookFlight.php");
        var field1 = $('<input></input>');
		var field2 = $('<input></input>');

        field1.attr("type", "text");
        field1.attr("name", "OnwardInstanceID");
        field1.attr("value", onwardInstanceId);
		
		field2.attr("type", "text");
        field2.attr("name", "ReturnInstanceID");
        field2.attr("value", returnInstanceId);

        form.append(field1);
		form.append(field2);
    

    // The form needs to be a part of the document in
    // order for us to be able to submit it.
    $(document.body).append(form);
    form.submit();
});
});
</script>

</body>
</html>

