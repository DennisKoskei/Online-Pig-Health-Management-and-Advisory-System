<?php

  $page_title = "My Account";

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

      if(isset($_POST['btn_update_user'])){//

           // form data

        $fname = ucfirst(mysqli_real_escape_string($connection, $_POST['fname']));
        $lname = ucfirst(mysqli_real_escape_string($connection, $_POST['lname']));

   
          //update
          $query = "UPDATE farmers_tbl SET first_name = '{$fname}', last_name ='{$lname}' WHERE farmer_id =  $session_id";
          $result = mysqli_query($connection, $query);
           header("Location: account.php?success_edit_info=true");
         }//



      if(isset($_POST['btn_update_password'])){


        $password = md5($_POST['password']);
        $query = "UPDATE farmers_tbl SET password = '{$password}' WHERE farmer_id =$session_id";
        $result = mysqli_query($connection, $query);

        header("Location: account.php?success_reset_info=true");

      }

      



      //fetch

        $query =  "SELECT * FROM farmers_tbl WHERE farmer_id =  $session_id";
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

    <form action="account.php" method="post">

<?php if(isset($_GET['success_edit_info'])){ ?>
      <div class="alert alert-success">Info updated successfully</div>
  <?php } ?>


 <?php if(isset($_GET['success_reset_info'])){ ?>
   <div class="alert alert-info">Password changed successfully</div>
  <?php } ?>

      <label>Enter First Name</label>
<input type="text" class="form-control" name="fname" value="<?php echo $fetch_fname; ?>" required="">

      <label>Enter Last Name</label>
<input type="text" class="form-control" name="lname" value="<?php echo $fetch_lname; ?>" required="">

      <label>Enter Mobile No.</label>
<input type="text" class="form-control" name="mobile" value="<?php echo $fetch_mobile; ?>" disabled="">

      <br/>
 <input type="submit" name="btn_update_user" class="btn btn-success pull" style="width:100%;" value="UPDATE">

    </form>

<br>			
<div class="clear"></div>
<script>
function validate_pass(){
	var password = document.change_pass_form.password.value;
	var cpassword = document.change_pass_form.password.value;
	
	if((password=="")||(cpassword=="") ){
		alert('Please enter password');
		return false;
	}
	else if((password==cpassword) ){
		alert('Password do not match');
		return false;
	}
	
	else if
	return true;
	
}
</script>
<form action="account.php" name="change_pass_form" method="post" onsubmit="return validate_pass();">
 <h4>Change Password</h4>
 <hr/>
	 
     <label>Password</label>
     <input type="password" class="form-control"  name="password"  >
     <label>Confirm Password</label>
     <input type="password" class="form-control"  name="cpassword"  >
     
      <br/>
     <input type="submit" name="btn_update_password" class="btn btn-info" style="width:100%;" value="CHANGE PASSWORD">
     

      <br/>
</form>


 		</div><!-- col-md-8-->

 		<div class="col-md-2"></div>

 	</div>

 </div>



</body>

</html>

