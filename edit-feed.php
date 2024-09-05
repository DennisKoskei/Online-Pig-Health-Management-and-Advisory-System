<?php
    $page_title = "Edit Feed";
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
    //if feed is selected
    if(isset($_GET['code'])) {
        $selectedid =  $_GET['code'];
    }

    //form submitted
    elseif(isset($_POST['btn_update_feed'])) {
        // form data
        $selectedid =  $_POST['code'];
        $feed_type = $_POST['feeds_type'];
        $particular = $_POST['particular'];
        
        //update
        $query = "UPDATE feeds_tbl SET feeds_type = '{$feed_type}', particular ='{$particular}' WHERE code =  '$selectedid'";
        $result = mysqli_query($connection, $query);

        header("Location: feeds-available.php?id=$selectedid&success_edit_info=true");
    } else{
        // header("Location: feeds-available.php");
    }

    //fetching info from database
    $query =  "SELECT * FROM feeds_tbl WHERE code =  '$selectedid'";
    $result = mysqli_query($connection, $query);
    $count = 1;

    while($row=mysqli_fetch_array($result)) {
        $fetch_feed_type = $row['feeds_type'];
        $fetch_particular = $row['particular'];
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
                <form action="edit-feed.php" method="post">
                    <?php if(isset($_GET['success_edit_info'])) { ?>

                        <div class="alert alert-success">Feed information updated successfully</div>

                    <?php 
                    } 
                    ?>

                    <input type="hidden" name="code" value="<?php echo $selectedid; ?>" >
                    <label>Enter Feed Type</label>
                    <input type="text" class="form-control" name="feeds_type" value="<?php echo $fetch_feed_type; ?>" required="">
                    <label>Enter Particular</label>
                    <input type="text" class="form-control" name="particular" value="<?php echo $fetch_particular; ?>" required="">
                    
                    <input type="submit" name="btn_update_feed" class="btn btn-success pull-left" style="width:50%;" value="UPDATE">
                </form>
    
            </div><!-- col-md-8-->

            <div class="col-md-2"></div>
            </div>
        </div>
    </body>
</html>
