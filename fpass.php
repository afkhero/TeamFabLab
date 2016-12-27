<?php

 ob_start();
 session_start();
 if( isset($_SESSION['user'])!="" ){
  header("Location: home.php");
 }
 include_once 'dbconnect.php';

 $error = false;
 
 if (isset($_POST['email'])){
	$username = $_POST['email'];
	$query="SELECT * FROM `users` WHERE userEmail='$username'";
	$result   = mysqli_query($conn, $query) or die(mysqli_error($conn));
	$count=mysqli_num_rows($result);
	// If the count is equal to one, we will send message other wise display an error message.
	if($count==1)
	{
		$rows=mysqli_fetch_array($result);
		$pass  =  $rows['userPass'];//FETCHING PASS
		//echo "your pass is ::".($pass)."";
		$to = $rows['email'];
		//echo "your email is ::".$email;
		//Details for sending E-mail
		$from = "Fablab Robot Team - Admin";
		$url = "http://www.fablab.uta.edu/";
		$body  =  "Password Recovery E-mail
		-----------------------------------------------
		Url : $url
		Here is your password  : $pass;";
		$from = "raghava.vemuri@mavs.uta.edu";
		$subject = "Password Recovery";
		$headers1 = "From: $from\n";
		$headers1 .= "Content-type: text/html;charset=iso-8859-1\r\n";
		$headers1 .= "X-Priority: 1\r\n";
		$headers1 .= "X-MSMail-Priority: High\r\n";
		$sentmail = mail ( $to, $subject, $body, $headers1 );
	} else {
	if ($_POST ['email'] != "") {
	    $fmsg = "E-mail does not exist";
		}
		}
	if($sentmail==1)
	{
		$smsg = "Your Password has been delivered to your e-mail. Kindly check Spam and/or Junk folder if not found in Inbox.";
	}
		else
		{
		if($_POST['email']!= "")
		$nmsg = "E-mail not found in the database";
	}
}
?>

<!DOCTYPE html>
<form class="form-signin" method="POST">
    <center><h2 class="form-signin-heading">Forgot Password</h2></center>
        <div class="input-group">
	  <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-envelope"></span></span>
	  <input type="text" name="email" class="form-control" placeholder="Enter your e-mail" required>
	</div>
	<br />
        <button class="btn btn-lg btn-primary btn-block" type="submit">Forgot Password</button>
        <a class="btn btn-lg btn-primary btn-block" href="index.php">Login Here</a>
</form>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
 
<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
 
<link rel="stylesheet" href="style.css" >

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</html>

<?php ob_end_flush(); ?>