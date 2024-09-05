<?php
require_once "includes/connection.php";

require_once "includes/session.php";

include "includes/auth.php";

function downloadReport($tableName, $fileName)
{
    global $connection;

    $query = "SELECT * FROM $tableName";
    $result = mysqli_query($connection, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($connection));
    }

    // Output CSV headers
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment;filename="' . $fileName . '"');

    $output = fopen('php://output', 'w');

    // Get the columns' names
    $columns = mysqli_fetch_fields($result);
    $columnNames = array();
    foreach ($columns as $column) {
        $columnNames[] = $column->name;
    }
    fputcsv($output, $columnNames);

    // Output the rows
    while ($row = mysqli_fetch_assoc($result)) {
        fputcsv($output, $row);
    }

    fclose($output);
    exit;
}

// Handle download requests
if (isset($_GET['download'])) {
    $download = $_GET['download'];

    switch ($download) {
        case 'pigs':
            downloadReport('pigs_tbl', 'pigs_report.csv');
            break;
        case 'feeds_available':
            downloadReport('feeds_tbl', 'feeds_available_report.csv');
            break;
        case 'feeds_consumed':
            downloadReport('feeds_consumption_tbl', 'feeds_consumed_report.csv');
            break;
        case 'feeds_purchased':
            downloadReport('feeds_purchase_tbl', 'feeds_purchased_report.csv');
            break;
        default:
            echo "Invalid download request.";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Download Reports</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="page">
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>

            <div class="col-md-8">
                <center>
                    <img src="img/logo-big.png" class="splash-logo logo <?php if (isset($_SESSION['pig_admin_user_id'])) echo 'admin-logo'; ?>">
                    <h2 align="center" class="title">Online Pig Health Management and Advisory System</h2>
                    <h3>Welcome <?php echo $session_names; ?> | <a href="logout.php">Logout</a></h3>
                </center>
                <hr />

                <div class="row menu-tabs">
                    <div class="col-md-3">
                        <a href="reports.php?download=pigs" class="btn btn-primary menu-tab">
                            <h3>
                                <span class="glyphicon glyphicon-piggy-bank"></span>
                                <br />Pigs <br>
                            </h3>
                        </a>
                    </div>

                    <div class="col-md-3">
                        <a href="reports.php?download=feeds_available" class="btn btn-success menu-tab">
                            <h3>
                                <span class="glyphicon glyphicon-grain"></span>
                                <br />Feeds <br> Available
                            </h3>
                        </a>
                    </div>

                    <div class="col-md-3">
                        <a href="reports.php?download=feeds_consumed" class="btn btn-warning menu-tab">
                            <h3>
                                <span class="glyphicon glyphicon-cutlery"></span>
                                <br />Feeds <br> Consumed
                            </h3>
                        </a>
                    </div>

                    <div class="col-md-3">
                        <a href="reports.php?download=feeds_purchased" class="btn btn-info menu-tab">
                            <h3>
                                <span class="glyphicon glyphicon-shopping-cart"></span>
                                <br />Feeds <br> Purchased
                            </h3>
                        </a>
                    </div>
                </div>
            </div><!-- col-md-8 -->

            <div class="col-md-2"></div>
        </div>
    </div>
</body>

</html>