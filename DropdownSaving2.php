<?php 

include("dbconfig.php");
	if($con) {
		session_start();
		$user = $_SESSION['User'];
		$pass = $_SESSION['Pass'];
		if(isset($user)) {
		$Input = mysqli_real_escape_string($con,$_POST['Type']); 
		$_SESSION['Input'] = $Input;
		$Number = mysqli_real_escape_string($con,$_POST['num']); //Selection Account
		
		$EPass = mysqli_real_escape_string($con,$_SESSION['Pass']);
		$EUser = mysqli_real_escape_string($con,$_SESSION['User']);

		date_default_timezone_set('America/New_York');
				$date = date('F d, Y g:i A ', strtotime("now")); 
				$firstday = date('F d, Y g:i A', strtotime("first day of this month midnight")); 
		
		$You = $_SESSION['YOU'];


		

	if($Input!='None' && $Number=='') {




		header("Location: Alpha.php");





			
	} elseif ($Input=='None' && $Number!= '') {

	$Account_Number = rand(100000000000,999999999999);

			$_SESSION['SavingAC'] = $Account_Number;

		echo "$Number";
		$TT = "INSERT INTO dp428.user (Account_Number, User,Pass, Accounts) VALUES ('$Account_Number','$EUser','$EPass','Saving')";
		$TTCon = mysqli_query($con,$TT);
		$Query = "SELECT * FROM dp428.user WHERE Accounts='Saving'";
		$QueryCon = mysqli_query($con,$Query);

		while ($T = mysqli_fetch_array($QueryCon)) {
			$UID = $T['ID'];
		}
			
		$SQL = "INSERT INTO dp428.accounts (ID,Account_Number, Account, Budget, Date) VALUES ('$UID','$Account_Number','Saving','$Number','$date')";
		$_SESSION['SavingID'] = $UID;
		$SQLCON = mysqli_query($con,$SQL);
		$Statement = "$$Number has been added to your Savings Account";

		$Transaction = "INSERT INTO dp428.statement (ID,Account_Number, Amount, Date, Statement) VALUES ('$UID','$Account_Number','$Number','$date','$Statement') ";
			$TransactionCon = mysqli_query($con,$Transaction);
		echo "$TT<br>$SQL";

		$Total = ($_SESSION['TotalBudget'])-$Number;
		$UPDATE = "UPDATE dp428.world SET Total_Budget='$Total' WHERE ID='1'";
			$UPDATECon = mysqli_query($con,$UPDATE);

		if($TTCon&&$SQLCON&&$TransactionCon&&$UPDATECon) {
			header("Location: HomePage.php");
		}

			if($date==$firstday) {
			$r = 0.01;
              $n = 12;

              $APV = (((pow((1+($r/$n)), $n))-1)*$Number);
              
   
              $RealAPV = round($Number+$APV,2);

              $SQL = "UPDATE dp428.accounts SET Budget='$RealAPV' WHERE Account='Saving'";
              $SQLCon = mysqli_query($con,$SQL);

              if($SQLCon) {
              	header("Location: HomePage.php");
              }
			  
		}
	} elseif($Input=='None' && $Number== '') {
		echo "You need to select something";
	} else {
		header("Location: CreateAccount.php");
	}

} else {
	  header("Location: ../HTML/index.html");
}
			

}
?>