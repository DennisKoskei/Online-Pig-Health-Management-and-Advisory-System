<?php
    $page_title = "Add Feed";
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
    if(isset($_POST['btn_add_feed'])) {
        // form data
        $feed_code = mysqli_real_escape_string($connection, $_POST['code']);
        $feed_type = mysqli_real_escape_string($connection, $_POST['feeds_type']);
        $particular = mysqli_real_escape_string($connection, $_POST['particular']);

        //check whether feed code exists
        $query =  "SELECT * FROM feeds_tbl WHERE code = '$feed_code'";
        $result = mysqli_query($connection, $query);
        $row_count = mysqli_fetch_array($result);

        if($row_count > 0){
            //feed code exists
            $error_exists = true;
        }else{
            //insert
            $query = "INSERT INTO feeds_tbl (code, feeds_type, particular) VALUES ('{$feed_code}', '{$feed_type}', '{$particular}')";
            $result = mysqli_query($connection, $query);

            header("Location: feeds-available.php?success=true");
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
                    <form action="add-feed.php" method="post">
                        <?php 
                            if(isset($error_exists)) { 
                        ?>
                                <div class="alert alert-danger">Feed Code already exists - <?php echo $_POST['code'] ?></div>
                        <?php 
                            } 
                        ?>
                        
                        <?php 
                            if(isset($_GET['success'])) { 
                        ?>
                                <div class="alert alert-success">Feed added successfully</div>
                        <?php 
                            } 
                        ?>
                        
                        <label>Enter Feed Code</label>
                        <input type="text" class="form-control" name="code" required="">
                        
                        <label>Enter Feed Type</label>
                        <input type="text" class="form-control" name="feeds_type" required="">
                        
                        <label>Enter Particular</label>
                        <input type="text" class="form-control" name="particular" required="">
                        <br/>
                        
                        <input type="submit" name="btn_add_feed" class="btn btn-success" style="width:100%;" value="ADD">
                    </form>

                </div><!-- col-md-8-->

                <div class="col-md-2"></div>
            </div>
        </div>
    </body>
</html>
