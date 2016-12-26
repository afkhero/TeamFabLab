<?php

 ob_start();
 session_start();
 require_once 'dbconnect.php';
 
 // if session is not set this will redirect to login page
 if( !isset($_SESSION['user']) ) {
  header("Location: index.php");
  exit;
 }
 
 $permission = mysqli_query($conn, "SELECT userPermission FROM users;");
 $rs = mysqli_fetch_all($permission);
 if($rs == 'ADMIN')
 {
     //Everything should go here if the user is admin
     echo 'working';
 }
 
 
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>You have to acquire permission to deploy the robot!</title>

<h2><button type="button" class="btn btn-block btn-primary" name="btn-back"><a href="home.php">Go back to home page</a></button>></h2>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
 
<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
 
<link rel="stylesheet" href="style.css" >

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

</html>
 

 
 
 