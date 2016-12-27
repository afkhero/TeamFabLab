<?php
 ob_start();
 session_start();
 require_once 'dbconnect.php';
 
 // if session is not set this will redirect to login page
 if( !isset($_SESSION['user']) ) {
  header("Location: index.php");
  exit;
 }
 // select loggedin users detail
 $res=mysqli_query($conn, "SELECT * FROM users WHERE userId=".$_SESSION['user']);
 $userRow=mysqli_fetch_array($res);
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome - <?php echo $userRow['userName']; ?></title>
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"  />
<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>

    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" 
                  aria-expanded="false" aria-controls="navbar" style="background-color:navy;"> 
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="https://cse.uta.edu/" style="background-color:navy; color:white;">CSE 4316 FabLab Robot Team</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="https://fablab.uta.edu/">FabLab Home Page</a></li>
            <li><a href="https://www.facebook.com/UTAFabLab/" style="background-color:navy; color:white;">
                    FabLab Facebook Page</a></li>
            <li><a href="https://fablab.uta.edu/about-fablab" style="background-color:navy; color:white; border-color:white;">
                    Learn more about FabLab</a></li>
                    <li><a href="permissionCheck.php" style="background-color:green; color:white;">Deploy Robot!</a></li>
            <li><a href="logout.php?logout" style="background-color:navy; color:white;"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            
            <!--<li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
     <span class="glyphicon glyphicon-user"></span>&nbsp;Hi,  < ?php echo $userRow['userName']; ?>&nbsp;<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a></li>
                <!--<li><a href="https://www.google.com"><span style="color:black"></span>&nbsp;Google</a></li> -->
            
           <!-- <div class="form-group">
             
            </div>
              </ul>
            </li>
          
        </div><!--/.nav-collapse 
      </div>-->
           </ul>
           
    </nav> 

 <div id="wrapper">

 <div class="container">
    
     <div class="page-header">
     <h3>Team Members: </h3>
     </div>
        
        <div class="row">
        <div class="col-lg-12">
            <h1>Eyob Gemechu, <br> 
            Eric Tran, <br> 
            LeAnn Rasmussen, <br> 
            Raghava Vemuri, <br> 
            Sarah Varghese</h1> <br>
            
        </div>
        </div>
    
    </div>
    
    </div>
    
    <script src="assets/jquery-1.11.3-jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
 
<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
 
<link rel="stylesheet" href="style.css" >

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
</body>
</html>
<?php ob_end_flush(); ?>