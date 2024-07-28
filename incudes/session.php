<?php
      //start session
      session_start();


     //user session
      function logged_in(){
      	return isset($_SESSION['pig_user_id']);
      }

      // admin user session
      function admin_logged_in(){
            return isset($_SESSION['pig_admin_user_id']);
      }


      function confirm_admin_logged_in(){
      	
            if(!admin_logged_in()){
      		header("Location: login.php");
      	}
            
      }

   
      






?>