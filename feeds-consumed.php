<?php
    $page_title = "Feeds Consumed";
?>

<?php
    // Require connection
    require_once "includes/connection.php";

    // Require session
    require_once "includes/session.php";

    // Auth
    include "includes/auth.php";

    // Delete feed consumption
    if(isset($_GET['deleteid'])) {
        $deleteid = $_GET['deleteid'];
        $query = "DELETE FROM feeds_consumption_tbl WHERE id = $deleteid";
        $result = mysqli_query($connection, $query);
        header("Location: feeds-consumed.php");
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
                            <a href="add-feed-consumption.php" class="btn btn-primary pull-right">Add Feed Consumption</a>
                        </div>
                    </div>

                    <table id="Table1" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="text-align: center;">Ref#</th>
                                <th>Quantity</th>
                                <th>Date Consumed</th>
                                <th>Shed No</th>
                                <th>Feed Code</th>
                                <th>Farmer ID</th>
                                <th style="text-align: center;">Action</th>
                            </tr>  
                        </thead>  
                        <tbody>  
                            <?php 
                                // Fetch consumed feeds
                                $query =  "SELECT * FROM feeds_consumption_tbl";
                                $result = mysqli_query($connection, $query);
                                $count = 1;
                                while($row=mysqli_fetch_array($result)){
                            ?>
                            <tr>  
                                <td style="text-align: center;"><?php echo $count; ?></td>
                                <td><?php echo $row['quantity']; ?></td>
                                <td><?php echo $row['date_consumed']; ?></td>
                                <td><?php echo $row['shed_no']; ?></td>
                                <td><?php echo $row['code']; ?></td>
                                <td><?php echo $row['farmer_id']; ?></td>
                                <td style="text-align: center;">
                                    <a href="edit-feed-consumption.php?id=<?php echo $row['id']; ?>">Edit</a>
                                    <a href="feeds-consumed.php?deleteid=<?php echo $row['id']; ?>" style="color:#f03;" onclick="return confirm('Delete?');">Delete</a>
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
