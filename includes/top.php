<!DOCTYPE html>
<html>
<head>
	<title>Online Pig Health Management and Advisory System</title>

<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/jquery.dataTables.min.css">
    <script src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
</head>
<body class="inner-page">
	<div class="container">
      <div class="row">
      <div class="col-md-2"></div> 
      <div class="col-md-8 nav-col">  
         <?php if(isset($session_error_default_password)){?>
         <div class="alert alert-danger">Please change your password; you are currently using the default password <a href="account.php">Click Here</a></div>
         <?php } ?>
          <div class="row">
           <div class="col-md-6">
          	  <nav class="navbar navbar-inverse">
            	<div class="container-fluid">
                 <div class="navbar-header">

<a class="navbar-brand" href="home.php"><span class="glyphicon glyphicon-home"></span></a>
     <span class="navbar-brand"><?php
       if(isset($page_title)) echo ' / '.$page_title; 
   ?></span>
                 </div>
  </div>
	</nav>
          </div>
          <div class="col-md-6">
          	 <ul class="nav navbar-nav">

			      <li class="active"><a style="color:#fff; font-weight:600;" href="javascript:history.back()">GO BACK</a></li>

			    </ul>
            </div>  
          </div>
		</div>
    </div>
    
    

 	<div class="row">

 		<div class="col-md-2"></div>

 		<div class="col-md-8 content">



 			<center>

 			<img src="img/logo-big.png" class="splash-logo logo <?php if(isset($_SESSION['pig_admin_user_id'])) echo 'admin-logo'; ?>">

 			<h2 align="center" class="title">Online Pig Health Management and Advisory System</h2>

 			<h3 class="sub-title">Welcome <?php echo $session_names; ?>  | <a href="logout.php">Logout</a></h3>

 			</center>



 			<hr />