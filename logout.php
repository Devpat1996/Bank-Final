<?php 
	include("dbconfig.php");

	if($con) {
		session_start();
		$user = $_SESSION['User'];
		$pass = $_SESSION['Pass'];
		$You = $_SESSION['YOU'];
		if(isset($user)) {
       $firstday = date('Y-m-d H:i:s', strtotime("first day of this month midnight")); 
    $today = date('Y-m-d H:i:s', strtotime(" 0 day today")); 
     $today2 = date('Y-m-d H:i:s', strtotime(" 0 day today")); 

		
			session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage

    header("Location: ../HTML/index.html");
     exit();
	} else {
		
		session_unset();     // unset $_SESSION variable for the run-time 
    	session_destroy(); 
    	header("Location: ../HTML/index.html");
		exit();
	}
		}
	

 ?>