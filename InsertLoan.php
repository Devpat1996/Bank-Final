 <?php 
include("dbconfig.php");

	if($con) {

		session_start();
		$user = $_SESSION['User'];
		$pass = $_SESSION['Pass'];
    if (isset($user)) {
		$You = $_SESSION['YOU'];
    $DepositName = $_SESSION['De'];
    $WithdrawName= $_SESSION['D'];
    $LoanValue = mysqli_real_escape_string($con,$_POST['LoanVALUE']);
    $Account_Number = rand(100000000000,999999999999);
    $EPass = mysqli_real_escape_string($con,$_SESSION['Pass']);
    $EUser = mysqli_real_escape_string($con,$_SESSION['User']);
    $R = $_SESSION['SAC'];
          
        date_default_timezone_set('America/New_York');
        $date = date('F d, Y g:i A ', strtotime("now")); 
        $firstday = date('F d, Y g:i A', strtotime("first day of this month midnight")); 

        $RR = "SELECT * FROM dp428.accounts where Account='$WithdrawName' and Account_Number='$R'";
        $RRCOn = mysqli_query($con,$RR);
        while ($RRR = mysqli_fetch_array($RRCOn)) {
          $R1 = $RRR['Budget'];
        }

    
    if($date==$firstday) {
      
      $r = 0.01;
              $n = 12;

              $APV = (((pow((1+($r/$n)), $n))-1)*$R1);
              
   
              $RealAPV = round($R1+$APV,2);
              $E = $_SESSION['SavingAC'];

              $SQL = "UPDATE dp428.accounts SET Budget='$RealAPV' WHERE Account='Saving' AND Account_Number='$E'";
              $SQLCon = mysqli_query($con,$SQL);

              if($SQLCon) {
                header("Location: HomePage.php");
              }

    } else {

      $TT = "INSERT INTO dp428.user (Account_Number, User,Pass, Accounts) VALUES ('$Account_Number','$EUser','$EPass','Loan')";
      $TTcon = mysqli_query($con,$TT);
      $Query = "SELECT * FROM dp428.user WHERE Accounts='Loan' where Account_Number='$Account_Number'";
    $QueryCon = mysqli_query($con,$Query);
$_SESSION['LAN'] = $Account_Number;
    while ($T = mysqli_fetch_array($QueryCon)) {
      $UID = $T['ID'];

    }
    $_SESSION['LoanID'] = $UID;
    $SQL = "INSERT INTO dp428.accounts (ID,Account_Number, Account, Budget, Date) VALUES ('$UID','$Account_Number','Loan','$LoanValue','$date')";
    $SQLCON = mysqli_query($con,$SQL);
    $Statement = "$$LoanValue has been added to your Loan Account";

    $Transaction = "INSERT INTO dp428.statement (ID,Account_Number, Amount, Date, Statement) VALUES ('$UID','$Account_Number','$LoanValue','$date','$Statement') ";
    $TransactionsCon = mysqli_query($con,$Transaction);

    if($TTcon&&$SQLCON&&$TransactionsCon) {
      header("Location: HomePage.php");
    }
    }
    } else {
        header("Location: ../HTML/index.html");
    }
       

       }

 ?>