<?php
	$page_title = "Add Pig";
?>

<?php
	//require connection
	require_once "includes/connection.php";

	//require session
	require_once "includes/session.php";

	//auth
	include "includes/auth.php";
?>

<?php
	//form submitted
	if(isset($_POST['btn_add_pig'])){
		// form data
		$ref_no = mysqli_real_escape_string($connection, $_POST['refno']);
		$pig_weight = mysqli_real_escape_string($connection, $_POST['weight']);
		$pig_dob = $_POST['dob'];
		$farmer_id = $_SESSION['pig_user_id'];
		$shed_no = $_POST['shedno'];

		//check whether mobile exists
		$query =  "SELECT * FROM pigs_tbl WHERE pig_id = '$ref_no' and farmer_id = $farmer_id";
		$result = mysqli_query($connection, $query);
		$row_count = mysqli_fetch_array($result);

		if($row_count>0) {
			//refno exists
			$error_exists = true;
		} else {
			//insert
			$query = "INSERT INTO pigs_tbl (pig_id,pig_weight,pig_dob,farmer_id,shed_no) VALUES 
			('{$ref_no}','{$pig_weight}','{$pig_dob}','{$farmer_id}','{$shed_no}' )";
			$result = mysqli_query($connection, $query);
			header("Location: pig-add.php?success=true");
		}
	}
?>

<?php 
	//include top template
	include "includes/top.php";
?>

<html>
	<body>
		<div>
			<div>
				<div>
					<form action="pig-add.php" method="post">
						<?php if(isset($error_exists)){ ?>
						
						<div class="alert alert-danger">Ref Number already exists - <?php echo $_POST['refno'] ?></div>
					
						<?php } ?>
					
						<?php if(isset($_GET['success'])){ ?>
					
						<div class="alert alert-success">Pig Information added successfully</div>
					
						<?php } ?>
					
						<label>Enter Reference Number/indentication</label>
						<input type="text" class="form-control" name="refno" required="">
					
						<label>Enter Weight(kg)</label>
						<input type="number" class="form-control" name="weight" required="">
					
						<label>Enter DOB</label>
						<input type="date" class="form-control" name="dob" required="">
					
						<label>Select Shed No</label>
						<select name="shedno" class="form-control" required="" >
							<?php
								for($i=0; $i<=5; $i++){
									echo '<option>'.$i.'</option>';
								}
							?>
						</select>
						<br/>
					
						<input type="submit" name="btn_add_pig" class="btn btn-success" style="width:100%;" value="ADD">
					</form>
				</div><!-- col-md-8-->

				<div class="col-md-2"></div>
			</div>
		</div>
	</body>
</html>
