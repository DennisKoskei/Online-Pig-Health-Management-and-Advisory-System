<?php

     if(isset($_SESSION['pig_user_id'])){
        
		    $session_id  =  $_SESSION['pig_user_id'];
            $query = "SELECT * FROM farmers_tbl WHERE farmer_id = $session_id";
            $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
            while ($row=mysqli_fetch_array($result)) {

    	   	         	$session_names = $row['first_name'].' '.$row['last_name'];
				        $session_password = $row['password'];
				       

    	   	         }
		     //check password if default
		    $default_password =  md5('1234');
		    if($default_password == $session_password){
			    $session_error_default_password = true;
		    }
		     
		    
       

     }

     elseif(isset($_SESSION['pig_admin_user_id'])){

     	    $session_id  =  $_SESSION['pig_admin_user_id'];
            $query = "SELECT * FROM admin_tbl WHERE admin_id = $session_id";
            $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
            while ($row=mysqli_fetch_array($result)) {

    	   	         	$session_names = $row['username'];

    	   	         }



     } 

     else{

     	header("Location: login.php");

     }









?>