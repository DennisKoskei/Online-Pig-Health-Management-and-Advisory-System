<?php
  $page_title = "Add New Farmer(user)";
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
      //form submitted
      if(isset($_POST['btn_add_user'])){
           // form data
        $fname = ucfirst(mysqli_real_escape_string($connection, $_POST['fname']));
        $lname = ucfirst(mysqli_real_escape_string($connection, $_POST['lname']));
        $mobile = $_POST['mobile'];
        $password = md5($_POST['password']);
        $admin_id = $_SESSION['pig_admin_user_id'];


        //check whether mobile exists
        $query =  "SELECT * FROM farmers_tbl WHERE mobile_no = '$mobile'";
        $result = mysqli_query($connection, $query);
        $row_count = mysqli_fetch_array($result);

        if($row_count>0){
           //mobile exists
          $error_exists = true;
           
        }else{
          //insert
          $query = "INSERT INTO farmers_tbl (first_name,last_name,mobile_no,password,admin_id) VALUES 
          ('{$fname}','{$lname}','{$mobile}','{$password}','{$admin_id}' )";
          $result = mysqli_query($connection, $query);
          header("Location: users.php");

        }



      }

?>
<?php 
      //include top template
      include "includes/top.php";

?>
    <form action="add-user.php" method="post">
      <?php if(isset($error_exists)){ ?>
      <div class="alert alert-danger">Mobile already exists - <?php echo $_POST['mobile'] ?></div>
      <?php } ?>
      <label>Enter First Name</label>
      <input type="text" class="form-control" name="fname" required="">
      <label>Enter Last Name</label>
      <input type="text" class="form-control" name="lname" required="">
      <label>Enter Mobile No.</label>
      <input type="text" class="form-control" name="mobile" required="">
      <label>Default Password</label>
      <input type="text" class="form-control"  value="1234" disabled="">
      <input type="hidden" name="password" value="1234" >
      <br/>
      <input type="submit" name="btn_add_user" class="btn btn-success" style="width:100%;" value="ADD">
    </form>

 			

 		</div><!-- col-md-8-->
 		<div class="col-md-2"></div>
 	</div>
 </div>

</body>
</html>
