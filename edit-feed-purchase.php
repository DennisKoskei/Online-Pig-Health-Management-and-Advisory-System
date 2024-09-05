<?php
    $page_title = "Edit Feed Purchase";
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
    //if feed purchase is selected
    if(isset($_GET['id'])) {
        $selectedid =  $_GET['id'];
    }

    //form submitted
    elseif(isset($_POST['btn_update_feed_purchase'])) {
        // form data
        $selectedid =  $_POST['id'];
        $feed_code = $_POST['code'];
        $quantity = $_POST['quantity'];
        $purchase_date = $_POST['purchase_date'];
        $cost = $_POST['cost'];
        
        //update
        $query = "UPDATE feeds_purchase_tbl SET code = '{$feed_code}', quantity = '{$quantity}', purchase_date ='{$purchase_date}', cost = '{$cost}' WHERE id =  $selectedid";
        $result = mysqli_query($connection, $query);

        header("Location: feeds-purchased.php?id=$selectedid&success_edit_info=true");
    } else{
        header("Location: feeds-purchased.php");
    }

    //fetching info from database
    $query =  "SELECT * FROM feeds_purchase_tbl WHERE id =  $selectedid";
    $result = mysqli_query($connection, $query);
    $count = 1;

    while($row=mysqli_fetch_array($result)) {
        $fetch_feed_code = $row['code'];
        $fetch_quantity = $row['quantity'];
        $fetch_purchase_date = $row['purchase_date'];
        $fetch_cost = $row['cost'];
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
                <form action="edit-feed-purchase.php" method="post">
                    <?php if(isset($_GET['success_edit_info'])) { ?>

                        <div class="alert alert-success">Feed purchase information updated successfully</div>

                    <?php 
                    } 
                    ?>

                    <input type="hidden" name="id" value="<?php echo $selectedid; ?>" >
                    <label>Enter Feed Code</label>
                    <input type="text" class="form-control" name="code" value="<?php echo $fetch_feed_code; ?>" required="">
                    <label>Enter Quantity</label>
                    <input type="number" class="form-control" name="quantity" value="<?php echo $fetch_quantity; ?>" required="">
                    <label>Enter Purchase Date</label>
                    <input type="date" class="form-control" name="purchase_date" value="<?php echo $fetch_purchase_date; ?>" required="">
                    <label>Enter Cost</label>
                    <input type="number" class="form-control" name="cost" value="<?php echo $fetch_cost; ?>" required="">
                    
                    <input type="submit" name="btn_update_feed_purchase" class="btn btn-success pull-left" style="width:50%;" value="UPDATE">
                </form>
    
            </div><!-- col-md-8-->

            <div class="col-md-2"></div>
            </div>
        </div>
    </body>
</html>
