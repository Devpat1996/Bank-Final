<?php 

include("dbconfig.php");
 
	if($con) {
		session_start();
		$user = mysqli_real_escape_string($con,$_SESSION['User']);
		$pass = mysqli_real_escape_string($con,$_SESSION['Pass']);
		if(isset($user)) {
       
		$AccountType = mysqli_real_escape_string($con,$_POST['Checking']);
		$Budget = mysqli_real_escape_string($con,$_SESSION['AccountType']);
		$You = mysqli_real_escape_string($con,$_SESSION['YOU']);
		$Statement = "$$AccountType Deposited Into Checking Account";

		$EPass = mysqli_real_escape_string($con,$_SESSION['Pass']);
		$EUser = mysqli_real_escape_string($con,$_SESSION['User']);

	

		$Total = ($_SESSION['TotalBudget'])-$AccountType;

			$Account_Number = rand(100000000000,999999999999);

			$_SESSION['CheckingAC'] = $Account_Number;


		    date_default_timezone_set('America/New_York');
				$date = date('F d, Y g:i A ', strtotime("now")); 
		
			$TT = "INSERT INTO dp428.user (Account_Number, User,Pass, Accounts) VALUES ('$Account_Number','$EUser','$EPass','Checking')";
			$TTCON = mysqli_query($con,$TT);
			$Query = "SELECT * FROM dp428.user WHERE Accounts='Checking'";
    $QueryCon = mysqli_query($con,$Query);

      while ($T = mysqli_fetch_array($QueryCon)) {
      $UID = $T['ID'];
     
    }
			$SQL = "INSERT INTO dp428.accounts (ID,Account_Number, Account, Budget, Date) VALUES ('$UID','$Account_Number','$Budget','$AccountType', '$date' )";

    		 $_SESSION['CheckingID'] = $UID;
			$SQLCON = mysqli_query($con,$SQL);
			
			$Transaction = "INSERT INTO dp428.statement (ID,Account_Number, Amount, Date, Statement) VALUES ('$UID','$Account_Number','$AccountType','$date','$Statement') ";
			$TransactionCon = mysqli_query($con,$Transaction);
			$UPDATE = "UPDATE dp428.world SET Total_Budget='$Total' WHERE ID='1'";
			$UPDATECon = mysqli_query($con,$UPDATE);
			echo "$TT";

			if($SQLCON&&$TransactionCon&&$UPDATECon&&$TTCON) {
				header("Location: HomePage.php");
			}
		} else {
			  header("Location: ../HTML/index.html");
		}
	}






 ?>