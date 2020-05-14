<?php 

	include("dbconfig.php");

	if($con) {
		session_start();
		$user = $_SESSION['User'];
		$pass = $_SESSION['Pass'];
		if(isset($user)) {
		$AccountSource = mysqli_real_escape_string($con,$_SESSION['AccountS']);
		$SourceBudget = mysqli_real_escape_string($con,$_SESSION['SourceBudget']);

		$AccountDest = mysqli_real_escape_string($con,$_SESSION['AccountD']);
		$DestBudget = mysqli_real_escape_string($con,$_SESSION['DestBudget']);
date_default_timezone_set('America/New_York');
        $date = date('F d, Y g:i A ', strtotime("now")); 
		$Amount = mysqli_real_escape_string($con,$_SESSION['Amount']);
		$OtherUser = md5(mysqli_real_escape_string($con,$_SESSION['UserNew']));
		$OtherPass = mysqli_real_escape_string($con,$_POST['OtherPass']);
		$ID = $_SESSION['Z'];
		$NewAmount = 0-$Amount;
		$SQL = "SELECT A.ID,A.Account_Number,A.Account,A.Budget,A.Date FROM dp428.accounts A inner join dp428.user User on A.ID = User.ID where  A.Account_Number like '%$OtherPass%' and User.User='$OtherUser' and A.Account not like '%Transaction%' and A.Account not like '%Deposit%' and A.Account not like '%Withdraw%'";
		
		$SQLcon = mysqli_query($con,$SQL);
		while ($i = mysqli_fetch_array($SQLcon)) {
			$FriendID = $i['ID'];
			$FriendAccountNum = $i['Account_Number'];
			$FriendAcountName = $i['Account'];
			$FriendBudget = $i['Budget'];
		}
		$newDest = $FriendBudget+$Amount;

		$SQL2 = "SELECT * from dp428.accounts A where Account_Number='$ID'and A.Account not like '%Transaction%' and A.Account not like '%Deposit%' and A.Account not like '%Withdraw%'";
		$SQL2con = mysqli_query($con,$SQL2);

		while ($i = mysqli_fetch_array($SQL2con)) {
			$ID2 = $i['ID'];
			$AccountNum = $i['Account_Number'];
			$AcountName = $i['Account'];
			$Budget = $i['Budget'];
		}
		$newSource = $Budget-$Amount;
		
		$TT2 = "INSERT INTO dp428.user (Account_Number, User,Pass, Accounts) VALUES ('$ID','$user','$pass','Transfer Transaction')";

               $TTcon = mysqli_query($con,$TT2);
               $TT3 = "INSERT INTO dp428.user (Account_Number, User,Pass, Accounts) VALUES ('$ID','$user','$pass','Transfer Transaction')";
                     
               $TTcon2 = mysqli_query($con,$TT3);

               if($TTcon2 && $TTcon) {
                $Query = "SELECT * FROM dp428.user WHERE Accounts like '%Transfer%' and Account_Number = '$ID'";
    $QueryCon = mysqli_query($con,$Query);
    echo "$Query<br>";
    while ($T = mysqli_fetch_array($QueryCon)) {
      $UID = $T['ID'];
          $UID2 = $T['ID'] -1;
    }

    $SQL2 = "INSERT INTO dp428.accounts (ID,Account_Number, Account, Budget, Date) VALUES ('$UID','$ID','Transfer Transaction','$Amount','$date')";
    echo($SQL2);
    $SQLCONn = mysqli_query($con,$SQL2);
    $SQL3 = "INSERT INTO dp428.accounts (ID,Account_Number, Account, Budget, Date) VALUES ('$UID2','$ID','Transfer Transaction','$Amount','$date')";
$SQLCONn2 = mysqli_query($con,$SQL3);

$SOURCEChange = "UPDATE dp428.accounts SET Budget='$newSource' WHERE ID='$ID2'";
               
               $SourceConn = mysqli_query($con,$SOURCEChange);


               $With = "UPDATE dp428.accounts SET Budget='$newDest' WHERE ID='$FriendID'";
               $WithCOn = mysqli_query($con,$With);
                
                $Depo1 = "INSERT INTO dp428.transactions(ID,AccountSource,AccountDest,Changes, Memo,Total) VALUES ('$UID2','$AccountNum','$FriendAccountNum','$NewAmount','Transfer','$newSource')";
    echo "$Depo1";
               $TCON = mysqli_query($con,$Depo1);
                $Depo2 = "INSERT INTO dp428.transactions(ID,AccountSource,AccountDest,Changes, Memo,Total) VALUES ('$UID','$FriendAccountNum','$AccountNum','$Amount','Transfer','$newDest')";
                $TCON2 = mysqli_query($con,$Depo2);
               }

                if($TTcon&&$TTcon2&&$SQLCONn&&$SQLCONn2&&$SourceConn&&$WithCOn&&$TCON&&$TCON2) {
                    header("Location: HomePage.php");
                } 
        


}
}
 ?>