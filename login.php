<?php



//require connection

require_once "includes/connection.php";



//require session

require_once "includes/session.php";



//form submitted

if (isset($_GET['btn_login'])) {

	//form data

	$username = mysqli_real_escape_string($connection, $_GET['username']);

	$password = md5($_GET['password']);



	if (isset($_GET['admin'])) { //

		//admin login

		$query = "SELECT * FROM admin_tbl WHERE username = '$username' and password = '$password' ";

		$result = mysqli_query($connection, $query) or die(mysqli_error($connection));

		$row_count = mysqli_fetch_array($result);

		if ($row_count) {

			//valid login

			$query2 = "SELECT * FROM admin_tbl WHERE username = '$username' and password = '$password' ";

			$result2 = mysqli_query($connection, $query2) or die(mysqli_error($connection));

			while ($row = mysqli_fetch_array($result2)) {

				$_SESSION['pig_admin_user_id'] = $row['admin_id'];

				header("location: home.php");
			}
		} else {

			//invalid login

			header("location: login.php?admin=true&error_login=true");
		}
	} //
	else {
		//farmer login 
		$query = "SELECT * FROM farmers_tbl WHERE mobile_no = '$username' and password = '$password' ";
		$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
		$row_count = mysqli_fetch_array($result);

		if ($row_count) {

			//valid login

			$query2 = "SELECT * FROM farmers_tbl WHERE mobile_no = '$username' and password = '$password' ";
			$result2 = mysqli_query($connection, $query2) or die(mysqli_error($connection));
			while ($row = mysqli_fetch_array($result2)) {

				$_SESSION['pig_user_id'] = $row['farmer_id'];

				header("location: home.php");
			}
		} else {

			//invalid login

			header("location: login.php?error_login=true");
		}
	}
}



?>

<!DOCTYPE html>

<html>

<head>

	<title>Login</title>

	<link rel="stylesheet" href="css/bootstrap.min.css">

	<link rel="stylesheet" href="css/style.css">

</head>

<body class="login">

	<div class="container">

		<div class="row">

			<div class="col-md-2"></div>

			<div class="col-md-8">



				<center>

					<img src="img/logo-big.png" class="splash-logo logo  <?php if (isset($_GET['admin'])) echo 'admin-logo'; ?>">

					<h2 align="center"><?php if (isset($_GET['admin'])) echo 'ADMIN LOGIN';
										else echo 'Online Pig Health Management and Advisory System'; ?></h2>

				</center>

				<form action="login.php" method="get">



					<?php if (isset($_GET['error_login'])) { ?>

						<div class="alert alert-danger">

							Invalid login

						</div>

					<?php } ?>



					<?php if (isset($_GET['admin'])) { ?>

						<input type="hidden" name="admin" value="admin">

					<?php } ?>



					<input type="text" name="username" class="form-control" placeholder="<?php if (isset($_GET['admin'])) echo 'Enter Username';
																							else echo 'Enter Phone Number'; ?>">

					<input type="password" name="password" class="form-control" placeholder="Enter Password">

					<input type="submit" name="btn_login" class="btn btn-primary" style="width: 100%;" value="LOGIN">

				</form>





			</div>

			<div class="col-md-2"></div>

		</div>

	</div>



</body>

</html>