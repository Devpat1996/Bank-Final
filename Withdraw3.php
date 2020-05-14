<?php 

include("dbconfig.php");

	if($con) {
		session_start();
		$user = $_SESSION['User'];
		$pass = $_SESSION['Pass'];
    if(isset($user)) {
    $EPass = mysqli_real_escape_string($con,$_SESSION['Pass']);
    $EUser = mysqli_real_escape_string($con,$_SESSION['User']);
          date_default_timezone_set('America/New_York');
        $date = date('F d, Y g:i A ', strtotime("now")); 
		$Input = mysqli_real_escape_string($con,$_POST['D']);
		
		$Choice =$_SESSION['CHOICE']; //Bank Account
     if($Choice=='Checking') {
       $Account_Number = mysqli_real_escape_string($con,$_SESSION['CheckingAC']);
    } else {
       $Account_Number = mysqli_real_escape_string($con,$_SESSION['SavingAC']);
    }
		$You = $_SESSION['YOU'];
		$C = "SELECT * FROM dp428.accounts WHERE Account='$Choice' and Account_Number='$Account_Number'";
		$CC = mysqli_query($con,$C);
		while ($rows = mysqli_fetch_array($CC)) {
			         $TT = $rows['Budget'];
               $CID = $rows['ID'];
			
		}
		
		
      $SQL = "SELECT * FROM dp428.world";
      $Connn = mysqli_query($con,$SQL);
      while ($rows = mysqli_fetch_array($Connn)) {
        $WID = $rows['ID'];
        $WTB = $rows['Total_Budget'];
        $WA = $rows['Account'];
      }

      $DepositValue = $WTB+$Input;
      $WithdrawValue = $TT - $Input;
      $New = "SELECT * FROM dp428.user where Accounts='Withdraw'";
          $NewCon = mysqli_query($con,$New);

          $WHAT = "SELECT * FROM dp428.accounts where Account='$Choice' and Account_Number='$Account_Number'";
          $NewCon4 = mysqli_query($con,$WHAT);

          while ($rowww=mysqli_fetch_array($NewCon4)) {
            $MAX = $rowww['Budget'];
            
          }
        if($Input<$MAX) {
        if(mysqli_num_rows($NewCon)<1) {
           $TT2 = "INSERT INTO dp428.user (Account_Number, User,Pass, Accounts) VALUES ('$Account_Number','$user','$pass','Withdraw')";

               $TTcon = mysqli_query($con,$TT2);
               $TT3 = "INSERT INTO dp428.user (Account_Number, User,Pass, Accounts) VALUES ('$Account_Number','$user','$pass','Withdraw Transaction')";
                     
               $TTcon2 = mysqli_query($con,$TT3);
           if($TTcon && $TTcon2) {
     $Query = "SELECT * FROM dp428.user WHERE Accounts like '%Withdraw%' and Account_Number='$Account_Number'";
    $QueryCon = mysqli_query($con,$Query);
    $INPUT = 0-$Input;
    
    while ($T = mysqli_fetch_array($QueryCon)) {
      $UID = $T['ID'];
      $UID2 = $T['ID'] -1;
    }
     $SQL2 = "INSERT INTO dp428.accounts (ID,Account_Number, Account, Budget, Date) VALUES ('$UID','$Account_Number','Withdraw','$Input','$date')";
    $SQLCONn = mysqli_query($con,$SQL2);
    $SQL3 = "INSERT INTO dp428.accounts (ID,Account_Number, Account, Budget, Date) VALUES ('$UID2','$Account_Number','Withdraw Transaction','$Input','$date')";
    $SQLCONn2 = mysqli_query($con,$SQL3);
     $Depo1 = "INSERT INTO dp428.transactions(ID,AccountSource,AccountDest,Changes, Memo,Total) VALUES ('$UID2','$Account_Number','$WA','$INPUT','Withdraw','$WithdrawValue')";
   
               $TCON = mysqli_query($con,$Depo1);
                $Depo2 = "INSERT INTO dp428.transactions(ID,AccountSource,AccountDest,Changes, Memo,Total) VALUES ('$UID','$WA','$Account_Number','$Input','Withdraw','$DepositValue')";
                $TCON2 = mysqli_query($con,$Depo2);

     $DepositQuery = "UPDATE dp428.world SET Total_Budget='$DepositValue'";
     $DepositCon = mysqli_query($con,$DepositQuery);
      $WithdrawQuery = "UPDATE dp428.accounts SET Budget='$WithdrawValue' WHERE Account='$Choice'";
      $WithdrawCon = mysqli_query($con,$WithdrawQuery);

       $Statement = "Withdrawed $$Input fom $Choice Account";

               $Depo = "INSERT INTO dp428.statement(ID,Account_Number,Amount, Date, Statement) VALUES ('$UID','$Account_Number','$Input','$date','$Statement')";
               $DepoCOn = mysqli_query($con,$Depo);

      if($TTcon&&$TTcon2&&$SQLCONn2&&$SQLCONn&&$DepositCon&&$WithdrawCon&&$DepoCOn&&$Depo2&&$Depo1) {
        header("Location: HomePage.php");
      }


        }}


         else {
          $TT2 = "INSERT INTO dp428.user (Account_Number, User,Pass, Accounts) VALUES ('$Account_Number','$EUser','$EPass','Withdraw Transaction')";

               $TTcon = mysqli_query($con,$TT2);

                $TT3 = "INSERT INTO dp428.user (Account_Number, User,Pass, Accounts) VALUES ('$Account_Number','$user','$pass','Withdraw Transaction')";
                
               $TTcon2 = mysqli_query($con,$TT3);

    $Query = "SELECT * FROM dp428.user WHERE Accounts='Withdraw Transaction' and Account_Number='$Account_Number'";
    $QueryCon = mysqli_query($con,$Query);

      while ($T = mysqli_fetch_array($QueryCon)) {
      $UID = $T['ID'];
      $UID2 = $T['ID'] -1;
    }
       $INPUT = 0-$Input;
     $SQL2 = "INSERT INTO dp428.accounts (ID,Account_Number, Account, Budget, Date) VALUES ('$UID','$Account_Number','Withdraw Transaction','$Input','$date')";
    $SQLCONn = mysqli_query($con,$SQL2);

    $SQL3 = "INSERT INTO dp428.accounts (ID,Account_Number, Account, Budget, Date) VALUES ('$UID2','$Account_Number','Withdraw Transaction','$Input','$date')";
   
   $SQLCONn2 = mysqli_query($con,$SQL3);

      $DepositQuery = "UPDATE dp428.world SET Total_Budget='$DepositValue'";
      $DepositCon = mysqli_query($con,$DepositQuery);
      $WithdrawQuery = "UPDATE dp428.accounts SET Budget='$WithdrawValue' WHERE Account='$Choice'";
      $WithdrawCon = mysqli_query($con,$WithdrawQuery);

       $Statement = "Withdrawed $$Input fom $Choice Account";

               $Depo = "INSERT INTO dp428.statement(ID,Account_Number,Amount, Date, Statement) VALUES ('$UID','$Account_Number','$Input','$date','$Statement')";
               $DepoCOn = mysqli_query($con,$Depo);

                $Depo1 = "INSERT INTO dp428.transactions(ID,AccountSource,AccountDest,Changes, Memo,Total) VALUES ('$UID2','$Account_Number','$WA','$INPUT','Withdraw','$WithdrawValue')";
        echo "$Depo1";
               $TCON = mysqli_query($con,$Depo1);
                $Depo2 = "INSERT INTO dp428.transactions(ID,AccountSource,AccountDest,Changes, Memo,Total) VALUES ('$UID','$WA','$Account_Number','$Input','Withdraw','$DepositValue')";
              
                $TCON2 = mysqli_query($con,$Depo2);

      if($TTcon&&$SQLCONn&&$DepositCon&&$WithdrawCon&&$DepoCOn) {
        header("Location: HomePage.php");
      } 
          
        }} else {
         header("Location: WithdrawLimit.php");
        }

     
      

      

              

  } else {
    header("Location: ../HTML/index.html");
  }
}
			?>



