<?php
    $page_title = "Edit Feed Consumption";
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
    //if feed consumption is selected
    if(isset($_GET['id'])) {
        $selectedid =  $_GET['id'];
    }

    //form submitted
    elseif(isset($_POST['btn_update_feed_consumption'])) {
        // form data
        $selectedid =  $_POST['id'];
        $feed_code = $_POST['code'];
        $quantity = $_POST['quantity'];
        $date_consumed = $_POST['date_consumed'];
        $shed_no = $_POST['shed_no'];
        
        //update
        $query = "UPDATE feeds_consumption_tbl SET code = '{$feed_code}', quantity = '{$quantity}', date_consumed ='{$date_consumed}', shed_no = '{$shed_no}' WHERE id =  $selectedid";
        $result = mysqli_query($connection, $query);

        header("Location: feeds-consumed.php?id=$selectedid&success_edit_info=true");
    } else{
        header("Location: feeds-consumed.php");
    }

    //fetching info from database
    $query =  "SELECT * FROM feeds_consumption_tbl WHERE id =  $selectedid";
    $result = mysqli_query($connection, $query);
    $count = 1;

    while($row=mysqli_fetch_array($result)) {
        $fetch_feed_code = $row['code'];
        $fetch_quantity = $row['quantity'];
        $fetch_date_consumed = $row['date_consumed'];
        $fetch_shed_no = $row['shed_no'];
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
                <form action="edit-feed-consumption.php" method="post">
                    <?php if(isset($_GET['success_edit_info'])) { ?>

                        <div class="alert alert-success">Feed consumption information updated successfully</div>

                    <?php 
                    } 
                    ?>

                    <input type="hidden" name="id" value="<?php echo $selectedid; ?>" >
                    <label>Enter Feed Code</label>
                    <input type="text" class="form-control" name="code" value="<?php echo $fetch_feed_code; ?>" required="">
                    <label>Enter Quantity</label>
                    <input type="number" class="form-control" name="quantity" value="<?php echo $fetch_quantity; ?>" required="">
                    <label>Enter Date Consumed</label>
                    <input type="date" class="form-control" name="date_consumed" value="<?php echo $fetch_date_consumed; ?>" required="">
                    <label>Select Shed No</label>
                    <select name="shed_no" class="form-control" required="" >
                        <?php
                            for($i=0; $i<=5; $i++){
                                echo '<option>'.$i.'</option>';
                            }
                        ?>
                    </select>

                    <input type="submit" name="btn_update_feed_consumption" class="btn btn-success pull-left" style="width:50%;" value="UPDATE">
                </form>
    
            </div><!-- col-md-8-->

            <div class="col-md-2"></div>
            </div>
        </div>
    </body>
</html>