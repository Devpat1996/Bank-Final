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
      $Ac = $rows['Account_Number'];
               $CID = $rows['ID'];
			
		}
		
		
     
     	$SQL = "SELECT * FROM dp428.world";
     	$Connn = mysqli_query($con,$SQL);

     	while ($row=mysqli_fetch_array($Connn)) {
     		$Account = $row['Account'];
     		$Total = $row['Total_Budget'];
     		$ID = $row['ID'];
     		
     	}
          $New = "SELECT * FROM dp428.user where Accounts='Deposit'";
          $NewCon = mysqli_query($con,$New);

     	if($Input<$Total) {
               if(mysqli_num_rows($NewCon)<1) {
     $TT2 = "INSERT INTO dp428.user (Account_Number, User,Pass, Accounts) VALUES ('$Account_Number','$user','$pass','Deposit')";

               $TTcon = mysqli_query($con,$TT2);
               $TT3 = "INSERT INTO dp428.user (Account_Number, User,Pass, Accounts) VALUES ('$Account_Number','$user','$pass','Deposit Transaction')";
                     
               $TTcon2 = mysqli_query($con,$TT3);
          if($TTcon && $TTcon2) {
     $Query = "SELECT * FROM dp428.user WHERE Accounts like '%Deposit%' and Account_Number='$Account_Number'";
    $QueryCon = mysqli_query($con,$Query);

    while ($T = mysqli_fetch_array($QueryCon)) {
      $UID = $T['ID'];
          $UID2 = $T['ID'] -1;
    }
     $SQL2 = "INSERT INTO dp428.accounts (ID,Account_Number, Account, Budget, Date) VALUES ('$UID','$Account_Number','Deposit','$Input','$date')";
    $SQLCONn = mysqli_query($con,$SQL2);
    $SQL3 = "INSERT INTO dp428.accounts (ID,Account_Number, Account, Budget, Date) VALUES ('$UID2','$Account_Number','Deposit Transaction','$Input','$date')";
$SQLCONn2 = mysqli_query($con,$SQL3);
      $TB = $TT+$Input;
        $World = $Total-$Input;
        $INPUT = 0-$Input;
        $Totttal = $TT+$Input;
    $Depo1 = "INSERT INTO dp428.transactions(ID,AccountSource,AccountDest,Changes, Memo,Total) VALUES ('$UID2','$Account','$Ac','$INPUT','Deposit','$World')";
    echo "$Depo1";
               $TCON = mysqli_query($con,$Depo1);
                $Depo2 = "INSERT INTO dp428.transactions(ID,AccountSource,AccountDest,Changes, Memo,Total) VALUES ('$UID','$Ac','$Account','$Input','Deposit','$Totttal')";
                $TCON2 = mysqli_query($con,$Depo2);

    
               $Deposit = "UPDATE dp428.accounts SET Budget='$TB' WHERE ID='$CID'";
               
               $DepCOn = mysqli_query($con,$Deposit);
               $With = "UPDATE dp428.world SET Total_Budget='$World' WHERE ID='$ID'";
               $WithCOn = mysqli_query($con,$With);
               
               
               $Statement = "Deposited $$Input into $Choice Account";

               $Depo = "INSERT INTO dp428.statement(ID,Account_Number,Amount, Date, Statement) VALUES ('$UID','$Account_Number','$Input','$date','$Statement')";
               $DepoCOn = mysqli_query($con,$Depo);
               
               
               

     if($SQLCONn && $TTcon && $DepCOn && $DepoCOn && $WithCOn &&$TCON&&$TCON2 &&$TTcon2 &&$SQLCONn2) {
          header("Location: HomePage.php");
     }
}
               
               } else {

                      $TT2 = "INSERT INTO dp428.user (Account_Number, User,Pass, Accounts) VALUES ('$Account_Number','$user','$pass','Deposit Transaction')";
                      echo "$TT2<br>";
               $TTcon = mysqli_query($con,$TT2);
               $TT3 = "INSERT INTO dp428.user (Account_Number, User,Pass, Accounts) VALUES ('$Account_Number','$user','$pass','Deposit Transaction')";
                      echo "$TT2<br>";
               $TTcon2 = mysqli_query($con,$TT3);

               $Query = "SELECT * FROM dp428.user WHERE Accounts='Deposit Transaction' and Account_Number='$Account_Number'";
    $QueryCon = mysqli_query($con,$Query);

    while ($T = mysqli_fetch_array($QueryCon)) {
      $UID = $T['ID'];
      $UID2 = $T['ID'] -1;
    }
     $SQL2 = "INSERT INTO dp428.accounts (ID,Account_Number, Account, Budget, Date) VALUES ('$UID','$Account_Number','Deposit Transaction','$Input','$date')";
   
    $SQLCONn = mysqli_query($con,$SQL2);
 $SQL3 = "INSERT INTO dp428.accounts (ID,Account_Number, Account, Budget, Date) VALUES ('$UID2','$Account_Number','Deposit Transaction','$Input','$date')";
    $TB = $TT+$Input;
        $World = $Total-$Input;
        $INPUT = 0-$Input;
        $Totttal = $TT+$Input;
   $SQLCONn2 = mysqli_query($con,$SQL3);
    $Depo1 = "INSERT INTO dp428.transactions(ID,AccountSource,AccountDest,Changes, Memo,Total) VALUES ('$UID2','$Account','$Ac','$INPUT','Deposit','$World')";
        
               $TCON = mysqli_query($con,$Depo1);
         
                $Depo2 = "INSERT INTO dp428.transactions(ID,AccountSource,AccountDest,Changes, Memo,Total) VALUES ('$UID','$Ac','$Account','$Input','Deposit','$Totttal')";
            
              
                $TCON2 = mysqli_query($con,$Depo2);
     	
     		$Deposit = "UPDATE dp428.accounts SET Budget='$TB' WHERE ID='$CID'";
     		
     		$DepCOn = mysqli_query($con,$Deposit);
     		$With = "UPDATE dp428.world SET Total_Budget='$World' WHERE ID='$ID'";
     		$WithCOn = mysqli_query($con,$With);
     		
               
     		$Statement = "Deposited $$Input into $Choice Account";

     		$Depo = "INSERT INTO dp428.statement(ID,Account_Number,Amount, Date, Statement) VALUES ('$UID','$Account_Number','$Input','$date','$Statement')";
     		$DepoCOn = mysqli_query($con,$Depo);
        echo "<br>$Depo";
     		

     	    if($DepCOn && $DepoCOn && $WithCOn && $TTcon && $TTcon2 &&$SQLCONn2 &&$SQLCONn &&$TCON&&$TCON2) {
     			header("Location: HomePage.php");

     		} 

     	} }else {
     		header("Location: HomePage.php");
     	}
     
      } else {
        header("Location: ../HTML/index.html");
      }
  }
			?>



