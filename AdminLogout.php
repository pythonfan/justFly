<?php
session_start();
unset($_SESSION['admin_email']);
header("Location: home.html");
?>