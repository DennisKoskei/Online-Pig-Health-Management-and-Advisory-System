<?php

     //require connection
     require_once "includes/connection.php";

     //require session
     require_once "includes/session.php";

     //auth
     include "includes/auth.php";

?>
<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="page">

	<div class="container">
     <div class="row">
    	<div class="col-md-2"></div>

 	<div class="col-md-8">
        <?php if(isset($session_error_default_password)){?>
         <div class="alert alert-danger">Please change your password; you are currently using the default password <a href="account.php">Click Here</a></div>
         <?php } ?>

 			
 			<center>
            <img src="img/logo-big.png" class="splash-logo logo <?php if(isset($_SESSION['pig_admin_user_id'])) echo 'admin-logo'; ?>">

 			<h2 align="center" class="title">PIGS WAKULIMA</h2>
 			<h3>Welcome <?php echo $session_names; ?> | <a href="logout.php">Logout</a></h3>

 			</center>
        	<hr />

 			<div class="row" class="menu-tabs">
        	<div class="col-md-3"></div>
 			<div class="col-md-3">
             	<a href="pigs-list.php" class="btn btn-success menu-tab">
                <h3>
                <span class="glyphicon glyphicon-piggy-bank"></span>
                <br/>	Pigs List	</h3> </a>  
            </div>

	       <div class="col-md-3">
             	<a href="pigs-disease.php" class="btn btn-warning menu-tab">
                <h3>
                <span class="glyphicon glyphicon-plus"></span> 
                <br/> Diseases	</h3> </a>  
            </div>
            <div class="col-md-3"></div>
      	</div>
 	</div><!-- col-md-8 -->

 		<div class="col-md-2"></div>

 	</div>
 </div>

</body>
</html>