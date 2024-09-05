<?php
    $page_title = "Available Feeds";
?>

<?php
    // Require connection
    require_once "includes/connection.php";

    // Require session
    require_once "includes/session.php";

    // Auth
    include "includes/auth.php";

    // Delete feed
    if(isset($_GET['deleteid'])) {
        $deleteid = $_GET['deleteid'];
        $query = "DELETE FROM feeds_tbl WHERE code = '$deleteid'";
        $result = mysqli_query($connection, $query);
        header("Location: feeds-available.php");
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
                            <a href="add-feed.php" class="btn btn-primary pull-right">Add Feed</a>
                        </div>
                    </div>

                    <table id="Table1" class="table table-striped table-bordered table-hover">  
                        <thead>
                            <tr>
                                <th style="text-align: center;">Ref#</th>
                                <th>Feed Code</th>
                                <th>Feed Type</th>
                                <th>Particular</th>
                                <th style="text-align: center;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                // Fetch available feeds
                                $query =  "SELECT * FROM feeds_tbl";
                                $result = mysqli_query($connection, $query);
                                $count = 1;
                                while($row=mysqli_fetch_array($result)){
                            ?>
                            <tr>
                                <td style="text-align: center;"><?php echo $count; ?></td>
                                <td><?php echo $row['code']; ?></td>
                                <td><?php echo $row['feeds_type']; ?></td>
                                <td><?php echo $row['particular']; ?></td>
                                <td style="text-align: center;">
                                    <a href="edit-feed.php?code=<?php echo $row['code']; ?>">Edit</a>
                                    <a href="feeds-available.php?deleteid=<?php echo $row['code']; ?>" style="color:#f03;" onclick="return confirm('Delete?');">Delete</a>
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
    $(document).ready(function(){
        $('#Table1').dataTable();
    });
</script>
