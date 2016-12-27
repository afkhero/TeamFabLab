<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
ob_start();
 session_start();
 require_once 'dbconnect.php';
 
 // if session is not set this will redirect to login page
 if( !isset($_SESSION['user']) ) {
  header("Location: index.php");
  exit;
 }
 
 $perm = mysqli_query($conn, "SELECT * FROM users WHERE userId=".$_SESSION['user']);
 $rslt = mysqli_fetch_array($perm);
 if($rslt['userPermission'] == 'NORMAL')
 {
     //Everything should go here if the user is not admin
     echo "You do not have access to this page";
     header("Location: home.php");
 }
 
 
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Access Granted</title>

<center><h1 class="col-md-12" style="background-color: navy; color: white;">FabLab Robot Deployment Page</h1></center>
</head>

<body>

    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" 
                  aria-expanded="false" aria-controls="navbar"> 
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="https://cse.uta.edu/" style="background-color:navy; color:white;">CSE 4316 FabLab Robot Team</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
              <li><a href="home.php" style="background-color:navy; color:white;">Home Page</a></li>
              <li class="active"><a href="deploy.php">Deployment Page</a></li>
            <li><a href="mailto:fablab@uta.edu" style="background-color:navy; color:white;">
                    Ask for Assistance</a></li>        
            <li><a onclick="resetFunction()" style="background-color:navy; 
                           color:white;">Reset Values</a></li>
            <li><a href="" style="background-color:red; color:white;">Emergency Stop</a></li>
            <li><a href="logout.php?logout" style="background-color:navy; color:white;"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a></li>
          </ul>
        
    </nav>
    
    <div id="wrapper">

 <div class="container">
    
     <div class="page-header">
         <center><h3>All fields are required</h3></center>
     </div>
     
 <div id="dep-form">
     <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="on" id="deploy-form">
    
     <div class="col-md-12">
        
        <div class="form-group">
             <div class="input-group">
                 <span class="input-group-addon" style="color: red;">*</span>
             <input type="number" name="speed" class="form-control" placeholder="Test Speed (kmph)" maxlength="20" />
                </div>
                <span class="text-danger"><?php echo $passError; ?></span>
        </div>
         
         <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon" style="color: red;">*</span>
             <input type="text" name="location" class="form-control" placeholder="Set Location" maxlength="30" />
                </div>
                <span class="text-danger"><?php echo $passError; ?></span>
        </div>
         
         <!-- Trip Description -->
         <div class="form-group">
             <div class="input-group">
                 <span class="input-group-addon" style="color: red;">*</span>
                 <textarea name="tdesc" rows="8" cols="147" placeholder="  Trip Description"></textarea>
             </div>
         </div>
            
 </div>
     </form>
    </div>
    
    </div>
   

<script src="assets/jquery-1.11.3-jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
 
<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
 
<link rel="stylesheet" href="style.css" >

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script>
function resetFunction() {
    document.getElementById("deploy-form").reset();
}
</script>
</body>
</html>
<?php ob_end_flush(); ?>