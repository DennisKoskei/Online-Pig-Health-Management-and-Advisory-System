<?php
	$page_title = "Pigs List";
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
	//delete farmer
	if(isset($_GET['deleteid'])){
		$deleteid =$_GET['deleteid'];
		$query = "DELETE FROM farmers_tbl WHERE farmer_id = $deleteid";
		$result = mysqli_query($connection, $query);

		header("Location: users.php");
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
					<div class="row">
						<div class="col-md-12">
							<a href="pig-add.php" class="btn btn-primary pull-right">Add Pig</a>
						</div>
					</div>

					<table id="Table1" class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th style="text-align: center;">Ref#</th>
								<th>Shed#</th>
								<th>Weight</th>
								<th>DOB</th>
								<th style="text-align: center;">Action</th>
							</tr>
						</thead>
					
						<tbody>
						<?php
							//fetch
							$query =  "SELECT * FROM pigs_tbl";
							$result = mysqli_query($connection, $query);
							$count = 1;

							while($row=mysqli_fetch_array($result)){
						?>

						<tr>  
							<td style="text-align: center;"><?php echo $count; ?></td>
							<td><?php echo $row['shed_no']; ?></td>
							<td><?php echo $row['pig_weight']; ?></td>
							<td><?php echo $row['pig_dob']; ?></td>
							
							<td style="text-align: center;">
								<a href="pig-edit.php?id=<?php echo $row['pig_id']; ?>">Edit</a>
								<a href="pigs.php?deleteid=<?php echo $row['pig_id']; ?>" style="color:#f03;" onclick="return confirm('Delete?'); ">Delete</a>
							</td>  
						</tr> 

						<?php
								$count++;
							}
						?>
						</tbody>  
					</table>  
				</div><!-- col-md-8-->

				<div class="col-md-2"></div>
			</div>
		</div>
	</body>
</html>

<script>
	$(document).ready(function(){
		$('#Table1').dataTable();
	});
</script>