<?php
session_start();
unset($_SESSION['user_fname']);
unset($_SESSION['user_lastname']);
unset($_SESSION['username']);
header("Location: home.html");
?>