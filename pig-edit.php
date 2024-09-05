<?php
    $page_title = "Edit Pigs";
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
    //if pig is selected
    if(isset($_GET['id'])) {
        $selectedid =  $_GET['id'];
    }

    //form submitted
    elseif(isset($_POST['btn_update_pig'])) {
        // form data
        $selectedid =  $_POST['id'];
        $weight = $_POST['weight'];
        $dob = $_POST['dob'];
        $shed = $_POST['shed'];
        
        //insert
        $query = "UPDATE pigs_tbl SET pig_weight = '{$weight}', pig_dob ='{$dob}', shed_no = '{$shed}' WHERE pig_id =  $selectedid";
        $result = mysqli_query($connection, $query);

        header("Location: pigs-list.php?id=$selectedid&success_edit_info=true");
    } else{
        header("Location: pigs-list.php");
    }

    //fetching info from database
    $query =  "SELECT * FROM pigs_tbl WHERE pig_id =  $selectedid";
    $result = mysqli_query($connection, $query);
    $count = 1;

    while($row=mysqli_fetch_array($result)) {
        $fetch_weight= $row['pig_weight'];
        $fetch_dob= $row['pig_dob'];
        $fetch_shed = $row['shed_no'];
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
                <form action="pig-edit.php" method="post">
                    <?php if(isset($_GET['success_edit_info'])) { ?>

                        <div class="alert alert-success">Info updated successfully</div>

                    <?php 
                    } 
                    ?>

                    <input type="hidden" name="id" value="<?php echo $selectedid; ?>" >
                    <label>Enter Pig's weight</label>
                    <input type="number" class="form-control" name="weight" value="<?php echo $fetch_weight; ?>" required="">
                    <label>Enter Pig's Date of Birth</label>
                    <input type="date" class="form-control" name="dob" value="<?php echo $fetch_dob; ?>" required="">
                    <label>Enter Pig's Shed Number</label>
                    <select name="shed" class="form-control" required="" >
                        <?php
                            for($i=0; $i<=5; $i++){
                                echo '<option>'.$i.'</option>';
                            }
                        ?>
                    </select>

                    <input type="submit" name="btn_update_pig" class="btn btn-success pull-left" style="width:50%;" value="UPDATE">
                </form>
    
            </div><!-- col-md-8-->

            <div class="col-md-2"></div>
            </div>
        </div>
    </body>
</html>
