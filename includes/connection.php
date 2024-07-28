<?php

define('DB_NAME', 'pigs_db');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');
 
//1. create database connection
$connection = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
if(mysqli_connect_errno()) {
echo "Database connection failed" . mysqli_connect_error();
}


 
?>