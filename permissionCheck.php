<?php

 ob_start();
 session_start();
 require_once 'dbconnect.php';
 
 // if session is not set this will redirect to login page
 if( !isset($_SESSION['user']) ) {
  header("Location: index.php");
  exit;
 }
 
 $permission = mysqli_query($conn, "SELECT * FROM users WHERE userId=".$_SESSION['user']);
 $rs = mysqli_fetch_array($permission);
 if($rs['userPermission'] == 'ADMIN')
 {
     //Everything should go here if the user is admin
     header("Location: deploy.php");
 }
 
 
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Access Denied!</title>

<center><h1 class="col-md-12">You need to have permission to deploy the FabLab Robot!</h1></center>

<h2><button type="button" class="btn btn-block btn-link" name="btn-back" style="color: white;"><a href="home.php">Go back to home page</a></button></h2>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
 
<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
 
<link rel="stylesheet" href="style.css" >

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

</html>
 

 
 
 