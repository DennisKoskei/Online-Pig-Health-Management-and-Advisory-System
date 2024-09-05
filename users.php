<?php
  $page_title = "Users";
?>
<?php
     //require connection
     require_once "includes/connection.php";

     //require session
     require_once "includes/session.php";

     //auth
     include "includes/auth.php";

     //confirm admin logged
     confirm_admin_logged_in();

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
<div class="row">
	<div class="col-md-12">
		<a href="add-user.php" class="btn btn-primary pull-right">Add Farmer(User)</a>
	</div>

</div>
<table id="Table1" class="table table-striped table-bordered table-hover">  
        <thead>  
          <tr>  
            <th style="text-align: center;">NO</th>  
            <th>First Name</th>  
            <th>Last Name</th>  
            <th>Mobile</th>
            <th style="text-align: center;">Action</th>   
          </tr>  
        </thead>  
        <tbody>  
        	<?php 
                 //fetch
        $query =  "SELECT * FROM farmers_tbl";
        $result = mysqli_query($connection, $query);
        $count = 1;
        while($row=mysqli_fetch_array($result)){
        	?>
          <tr>  
            <td style="text-align: center;"><?php echo $count; ?></td>  
            <td><?php echo $row['first_name']; ?></td>  
            <td><?php echo $row['last_name']; ?></td>  
            <td><?php echo $row['mobile_no']; ?></td>
            <td style="text-align: center;"><a href="user-edit.php?id=<?php echo $row['farmer_id']; ?>">Edit</a> <a href="users.php?deleteid=<?php echo $row['farmer_id']; ?>" style="color:#f03;" onclick="return confirm('Delete?'); ">Delete</a></td>  
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