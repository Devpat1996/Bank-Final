<?php 
include("dbconfig.php");

	if($con) {
		session_start();
		$user = $_SESSION['User'];
		$pass = $_SESSION['Pass'];
		$You = $_SESSION['YOU'];
		
		$SA = $_SESSION['SavingAC'];
		$AC = $_SESSION['CheckingAC'];
		$LAN = $_SESSION['LAN'];
       
		if(isset($user)) {
			
			$Color = mysqli_real_escape_string($con,$_POST['BankType']);
			$_SESSION['color'] = $Color;
		$ColorCheck = "SELECT * FROM dp428.color where User='$user' and Pass='$pass'";

				$ColorCon = mysqli_query($con,$ColorCheck);
				while ($i = mysqli_fetch_array($ColorCon)) {
					$A = $i['ID'];
			
				}
				if(mysqli_num_rows($ColorCon)>0) {
					$SQL = "UPDATE dp428.color SET Color='$Color' where ID='$A'";
					$SQLcon = mysqli_query($con,$SQL);
					if($SQLcon) {
						header("Location: HomePage.php");
					}
				} else {
					$SQL = "INSERT INTO dp428.color (User,Pass,Color) VALUES ('$user','$pass', '$Color')";
		
			$SQLcon = mysqli_query($con,$SQL);
			if($SQLcon) {
				
				header("Location: HomePage.php");
			}
				}

			
			

		} else {
			header("Location: ../HTML/index.html");
		}
	}

		
?>