<?php
    $page_title = "Add Feed Purchase";
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
    if(isset($_POST['btn_add_feed_purchase'])){
        // form data
        $feed_code = mysqli_real_escape_string($connection, $_POST['code']);
        $receipt_no = mysqli_real_escape_string($connection, $_POST['receipt_no']);
        $quantity = mysqli_real_escape_string($connection, $_POST['quantity']);
        $purchase_date = $_POST['purchase_date'];
        $cost = mysqli_real_escape_string($connection, $_POST['cost']);
        $farmer_id = $_SESSION['pig_user_id'];

        //check whether the receipt number exists
        $query =  "SELECT * FROM feeds_purchase_tbl WHERE receipt_no = '$receipt_no'";
        $result = mysqli_query($connection, $query);
        $row_count = mysqli_fetch_array($result);

        if($row_count > 0){
            //receipt number exists
            $error_exists = true;
        }else{
            //insert
            $query = "INSERT INTO feeds_purchase_tbl (code, receipt_no, quantity, purchase_date, cost, farmer_id) VALUES ('{$feed_code}', '{$receipt_no}', '{$quantity}', '{$purchase_date}', '{$cost}', '{$farmer_id}')";
            $result = mysqli_query($connection, $query);

            header("Location: feeds-purchased.php?success=true");
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
                    <form action="add-feed-purchase.php" method="post">
                        <?php 
                            if(isset($error_exists)){ 
                        ?>
                                <div class="alert alert-danger">Receipt Number already exists - <?php echo $_POST['receipt_no'] ?></div>
                        <?php 
                            } 
                        ?>
                        <?php 
                            if(isset($_GET['success'])){ 
                        ?>
                                <div class="alert alert-success">Feed Purchase added successfully</div>
                        <?php 
                            } 
                        ?>
                        
                        <label>Enter Feed Code</label>
                        <input type="text" class="form-control" name="code" required="">
                        
                        <label>Enter Receipt Number</label>
                        <input type="text" class="form-control" name="receipt_no" required="">
                        
                        <label>Enter Quantity</label>
                        <input type="number" class="form-control" name="quantity" required="">
                        
                        <label>Enter Purchase Date</label>
                        <input type="date" class="form-control" name="purchase_date" required="">
                        
                        <label>Enter Cost</label>
                        <input type="number" class="form-control" name="cost" required="">
                        <br/>
                        
                        <input type="submit" name="btn_add_feed_purchase" class="btn btn-success" style="width:100%;" value="ADD">
                    </form>

                </div><!-- col-md-8-->

                <div class="col-md-2"></div>
            </div>
        </div>
    </body>
</html>
