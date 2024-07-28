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
 			    
 			    

 				<div class="col-md-3">
 					  <a href="account.php" class="btn btn-primary menu-tab">
 					  	<h3><span class="glyphicon glyphicon-user"></span>
 					  		<br/>
 					  		My Account
 					  	</h3>
 					  </a>
 				</div>
 				
 				<div class="col-md-3">
 					<?php if(isset($_SESSION['pig_admin_user_id'])){ ?>
 					 <a href="users.php" class="btn btn-warning menu-tab">
 					  	<h3><span class="glyphicon glyphicon-list-alt"></span>
 					  		<br/>
 					  		Users Info
 					  	</h3>
 					  </a>
 					<?php } else{ ?>
 					<a href="pigs.php" class="btn btn-success menu-tab">
 				    	<h3><span class="glyphicon glyphicon-piggy-bank"></span>
 					  		<br/>
 					  		Pigs Info
 					  	</h3>
 					  </a>
                    <?php } ?>
 				</div>

 				<?php if(isset($_SESSION['pig_user_id'])){ ?>
 				<div class="col-md-3">
 					<a href="" class="btn btn-warning menu-tab">
 				  	<h3><span class="glyphicon glyphicon-grain"></span>
 					 		<br/>
 					  		Feeds
 					  	</h3>
 					  </a>
 				</div>
 				 <?php } ?>

 				<div class="col-md-3">
 					<a href="" class="btn btn-danger menu-tab">
 					  	<h3><span class="glyphicon glyphicon-stats"></span>
 				  		<br/>
 					  		Reports
 					  	</h3>
 					  </a>
 				</div>
 				
 			</div>



 		</div><!-- col-md-8 -->
 		<div class="col-md-2"></div>
 	</div>
 </div>


</body>
</html>