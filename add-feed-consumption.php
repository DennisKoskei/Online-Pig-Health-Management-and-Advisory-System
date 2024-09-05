<?php
    $page_title = "Add Feed Consumption";
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
    if(isset($_POST['btn_add_feed_consumption'])){
        // form data
        $feed_code = mysqli_real_escape_string($connection, $_POST['code']);
        $quantity = mysqli_real_escape_string($connection, $_POST['quantity']);
        $date_consumed = $_POST['date_consumed'];
        $shed_no = $_POST['shed_no'];
        $farmer_id = $_SESSION['pig_user_id'];

        //check whether shed no exists
        $query =  "SELECT * FROM feeds_consumption_tbl WHERE shed_no = '$shed_no' AND date_consumed = '$date_consumed' AND code = '$feed_code'";
        $result = mysqli_query($connection, $query);
        $row_count = mysqli_fetch_array($result);

        if($row_count > 0){
            //entry exists
            $error_exists = true;
        }else{
            //insert
            $query = "INSERT INTO feeds_consumption_tbl (code, quantity, date_consumed, shed_no, farmer_id) VALUES ('{$feed_code}', '{$quantity}', '{$date_consumed}', '{$shed_no}', '{$farmer_id}')";
            $result = mysqli_query($connection, $query);

            header("Location: feeds-consumed.php?success=true");
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
                    <form action="add-feed-consumption.php" method="post">
                        <?php 
                            if(isset($error_exists)){ 
                        ?>
                                <div class="alert alert-danger">Entry already exists for the given date, shed number, and feed code</div>
                        <?php 
                            } 
                        ?>
                        
                        <?php 
                            if(isset($_GET['success'])){ 
                        ?>
                                <div class="alert alert-success">Feed Consumption added successfully</div>
                        <?php 
                            } 
                        ?>
                        
                        <label>Enter Feed Code</label>
                        <input type="text" class="form-control" name="code" required="">
                        
                        <label>Enter Quantity</label>
                        <input type="number" class="form-control" name="quantity" required="">
                        
                        <label>Enter Date Consumed</label>
                        <input type="date" class="form-control" name="date_consumed" required="">
                        
                        <label>Select Shed No</label>
                        <select name="shed_no" class="form-control" required="">
                            <?php
                                for($i=0; $i<=5; $i++){
                                    echo '<option>'.$i.'</option>';
                                }
                            ?>
                        </select>
                        <br/>
                        
                        <input type="submit" name="btn_add_feed_consumption" class="btn btn-success" style="width:100%;" value="ADD">
                    </form>
                </div><!-- col-md-8-->

                <div class="col-md-2"></div>
            </div>
        </div>
    </body>
</html>
