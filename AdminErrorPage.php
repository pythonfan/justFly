<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  
  <title>Error Page</title>
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
     <img src="logo.png" alt="LOGO" height="100" width="130"/>
    </div>
  </div>
</nav>

<div class="jumbotron text-center">
<h1>Error </h1>
  <?php
  if(isset($_SESSION['error_msg']))
  {
	  $error_message = $_SESSION['error_msg'];
  }
  else
	  $error_message = "An error occured on the previous page";
  echo "<h3>". $error_message. "</h3>";
  echo "<a href='Admin_signIn.html'>Try Again</a>";
  ?>
 </div>   
</div>



</body>
</html>

