<?php 


	include("dbconfig.php");

	if($con) {
		session_start();
		$user = $_SESSION['User'];
		$pass = $_SESSION['Pass'];
		$AC = $_SESSION['CheckingAC'];
		if(isset($user)) {
		
		$QUE = "SELECT * FROM dp428.accounts where Account='Checking' AND Account_Number='$AC'";
		$QUEC = mysqli_query($con,$QUE);

		while ($F = mysqli_fetch_array($QUEC)) {
			$TOTALL = $F['Budget'];
		}
		
		$Input = mysqli_real_escape_string($con,$_POST['D']); 
		$Accountt = mysqli_real_escape_string($con,$_SESSION['Input']); 
		
		
		
		$EPass = mysqli_real_escape_string($con,$_SESSION['Pass']);
		$EUser = mysqli_real_escape_string($con,$_SESSION['User']);

		$Account_Number = rand(100000000000,999999999999);

			$_SESSION['SavingAC'] = $Account_Number;
		date_default_timezone_set('America/New_York');
				$date = date('F d, Y g:i A ', strtotime("now")); 
				$firstday = date('F d, Y g:i A', strtotime("first day of this month midnight")); 
		
		$You = $_SESSION['YOU'];

		$NEWB = $TOTALL - $Input;

		
		


	$QQ = "UPDATE dp428.accounts SET Budget = '$NEWB' WHERE Account='Checking' AND Account_Number='$AC'";
	$QQCon = mysqli_query($con,$QQ);

	$TT = "INSERT INTO dp428.user (Account_Number, User,Pass, Accounts) VALUES ('$Account_Number','$EUser','$EPass','Saving')";
		$TTCon = mysqli_query($con,$TT);
	$Query = "SELECT * FROM dp428.user WHERE Accounts='Saving' and Account_Number='$Account_Number'";
		$QueryCon = mysqli_query($con,$Query);

		while ($T = mysqli_fetch_array($QueryCon)) {
			$UID = $T['ID'];
		}
	$SQL = "INSERT INTO dp428.accounts (ID,Account_Number, Account, Budget, Date) VALUES ('$UID','$Account_Number','Saving','$Input','$date')";
		$SQLCON = mysqli_query($con,$SQL);
		$Statement = "$$Input has been added to your Savings Account";

		$Transaction = "INSERT INTO dp428.statement (ID,Account_Number, Amount, Date, Statement) VALUES ('$UID','$Account_Number','$Input','$date','$Statement') ";
			$TransactionCon = mysqli_query($con,$Transaction);

			if($QQCon&&$TTCon&&$SQLCON&&$TransactionCon) {
				header("Location: HomePage.php");
			}
	

			if($date==$firstday) {
			$r = 0.01;
              $n = 12;

              $APV = (((pow((1+($r/$n)), $n))-1)*$Input);
              
   
              $RealAPV = round($Input+$APV,2);

              $SQL = "UPDATE dp428.accounts SET Budget='$RealAPV' WHERE Account='Saving'";
              $SQLCon = mysqli_query($con,$SQL);

              if($SQLCon) {
              	header("Location: HomePage.php");
              }
			  
		}
	
} else {
	  echo "$user";
}}
	?>