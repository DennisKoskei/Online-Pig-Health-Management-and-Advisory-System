<?php
    $page_title = "Feeds Purchased";
?>

<?php
    // Require connection
    require_once "includes/connection.php";

    // Require session
    require_once "includes/session.php";

    // Auth
    include "includes/auth.php";

    // Delete feed purchase
    if(isset($_GET['deleteid'])) {
        $deleteid = $_GET['deleteid'];
        $query = "DELETE FROM feeds_purchase_tbl WHERE id = $deleteid";
        $result = mysqli_query($connection, $query);
        header("Location: feeds-purchased.php");
    }
?>

<?php 
    // Include top template
    include "includes/top.php";
?>

<html>
    <body>
        <div>
            <div>
                <div>
                    <div class="row">
                        <div class="col-md-12">
                            <a href="add-feed-purchase.php" class="btn btn-primary pull-right">Add Purchase</a>
                        </div>
                    </div>

                    <table id="Table1" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="text-align: center;">Ref#</th>
                                <th>Feed Code</th>
                                <th>Receipt No</th>
                                <th>Quantity</th>
                                <th>Purchase Date</th>
                                <th>Cost</th>
                                <th>Farmer ID</th>
                                <th style="text-align: center;">Action</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <?php 
                                // Fetch purchased feeds
                                $query =  "SELECT * FROM feeds_purchase_tbl";
                                $result = mysqli_query($connection, $query);
                                $count = 1;
                                while($row=mysqli_fetch_array($result)){
                            ?>

                            <tr>  
                                <td style="text-align: center;"><?php echo $count; ?></td>
                                <td><?php echo $row['code']; ?></td>
                                <td><?php echo $row['receipt_no']; ?></td>
                                <td><?php echo $row['quantity']; ?></td>
                                <td><?php echo $row['purchase_date']; ?></td>
                                <td><?php echo $row['cost']; ?></td>
                                <td><?php echo $row['farmer_id']; ?></td>
                                <td style="text-align: center;">
                                    <a href="edit-feed-purchase.php?id=<?php echo $row['id']; ?>">Edit</a>
                                    <a href="feeds-purchased.php?deleteid=<?php echo $row['id']; ?>" style="color:#f03;" onclick="return confirm('Delete?');">Delete</a>
                                </td>
                            </tr>

                            <?php
                                $count++;
                                }
                            ?>
                        </tbody>
                    </table>
                </div><!-- col-md-8-->

                <div class="col-md-2"></div>
            </div>
        </div>
    </body>
</html>

<script>
    $(document).ready(function() {
        $('#Table1').dataTable();
    });
</script>
