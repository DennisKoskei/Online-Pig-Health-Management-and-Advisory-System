<?php
  $page_title = "Edit Farmer(user)";
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
      //if farmer is selected
      if(isset($_GET['id'])){
        $selectedid =  $_GET['id'];
      }

      //form submitted
      elseif(isset($_POST['btn_update_user'])){
           // form data
        $selectedid =  $_POST['id'];
        $fname = ucfirst(mysqli_real_escape_string($connection, $_POST['fname']));
        $lname = ucfirst(mysqli_real_escape_string($connection, $_POST['lname']));
        
 
          //insert
          $query = "UPDATE farmers_tbl SET first_name = '{$fname}', last_name ='{$lname}' WHERE farmer_id =  $selectedid";
          $result = mysqli_query($connection, $query);
           header("Location: user-edit.php?id=$selectedid&success_edit_info=true");
   
      }
      elseif(isset($_GET['resetpassword'])){
        $selectedid =  $_GET['resetpassword'];
        $password = md5('1234');
        $query = "UPDATE farmers_tbl SET password = '{$password}' WHERE farmer_id =  $selectedid";
        $result = mysqli_query($connection, $query);
        header("Location: user-edit.php?id=$selectedid&success_reset_info=true");
      }
      else{
        header("Location: users.php");
      }

      //fetch
        $query =  "SELECT * FROM farmers_tbl WHERE farmer_id =  $selectedid";
        $result = mysqli_query($connection, $query);
        $count = 1;
        while($row=mysqli_fetch_array($result)){
          $fetch_fname= $row['first_name'];
          $fetch_lname= $row['last_name'];
          $fetch_mobile= $row['mobile_no'];
        }

?>
<?php 
      //include top template
      include "includes/top.php";

?>
    <form action="user-edit.php" method="post">
          <?php if(isset($_GET['success_edit_info'])){ ?>
      <div class="alert alert-success">Info updated successfully</div>
      <?php } ?>

       <?php if(isset($_GET['success_reset_info'])){ ?>
      <div class="alert alert-info">Password reseted successfully</div>
      <?php } ?>
     <input type="hidden" name="id" value="<?php echo $selectedid; ?>" >
      <label>Enter First Name</label>
      <input type="text" class="form-control" name="fname" value="<?php echo $fetch_fname; ?>" required="">
      <label>Enter Last Name</label>
      <input type="text" class="form-control" name="lname" value="<?php echo $fetch_lname; ?>" required="">
      <label>Enter Mobile No.</label>
      <input type="text" class="form-control" name="mobile" value="<?php echo $fetch_mobile; ?>" disabled="">

      <label>Default Password</label>
      <input type="text" class="form-control"  value="1234" disabled="">
      <input type="hidden" name="password" value="1234" >
      <br/>
      <a href="user-edit.php?resetpassword=<?php echo $selectedid; ?>" class="btn btn-warning pull-left" onclick="return confirm('Reset Password?')" style="width:50%;">RESET PASSWORD</a>
      <input type="submit" name="btn_update_user" class="btn btn-success pull-left" style="width:50%;" value="UPDATE">

    </form>

 			

 		</div><!-- col-md-8-->
 		<div class="col-md-2"></div>
 	</div>
 </div>

</body>
</html>
