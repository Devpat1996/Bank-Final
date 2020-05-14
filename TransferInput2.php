<?php 

include("dbconfig.php");
	if($con) {
		session_start();
		$user = $_SESSION['User'];
		$pass = $_SESSION['Pass'];
		if(isset($user)) {
      $color = $_SESSION['color'];
		$AccountSource = mysqli_real_escape_string($con,$_SESSION['AccountS']);
		$SourceBudget = mysqli_real_escape_string($con,$_SESSION['SourceBudget']);
        date_default_timezone_set('America/New_York');
        $date = date('F d, Y g:i A ', strtotime("now")); 
		$AccountDest = mysqli_real_escape_string($con,$_SESSION['AccountD']);
		$DestBudget = mysqli_real_escape_string($con,$_SESSION['DestBudget']);

		$Amount = mysqli_real_escape_string($con,$_SESSION['Amount']);
        $NewAmount = 0-$Amount;
		$Option = mysqli_real_escape_string($con,$_POST['Option']);
        $ID = $_SESSION['Z'];
        $DestAccount = $_SESSION['D'];
		if($Option=='No') {
			$World = "SELECT * FROM dp428.accounts where Account_Number='$ID' and Account='$AccountSource' ";
            $WorldCon = mysqli_query($con,$World);

            $Dest = "SELECT * FROM dp428.accounts where Account_Number='$DestAccount' and Account='$AccountDest'";
            $DestCon = mysqli_query($con,$Dest);
             while ($i = mysqli_fetch_array($DestCon)) {
                 $DestBudget2 = $i['Budget'];
                 $DIID = $i['ID'];
             }

            while ($i = mysqli_fetch_array($WorldCon)) {
                $SID = $i['ID'];
                $_SESSION['SID'] = $SID;
                $SourceAccount = $i['Account_Number'];
                $SourceBudget = $i['Budget'];
               
            }
            $newSource = $SourceBudget-$Amount;
            $newDest = $DestBudget2 + $Amount;

            if(mysqli_num_rows($DestCon)>0 && mysqli_num_rows($WorldCon)>0) {

                 $TT2 = "INSERT INTO dp428.user (Account_Number, User,Pass, Accounts) VALUES ('$ID','$user','$pass','Transfer Transaction')";

               $TTcon = mysqli_query($con,$TT2);
               $TT3 = "INSERT INTO dp428.user (Account_Number, User,Pass, Accounts) VALUES ('$ID','$user','$pass','Transfer Transaction')";
                     
               $TTcon2 = mysqli_query($con,$TT3);

               if($TTcon2 && $TTcon) {
                $Query = "SELECT * FROM dp428.user WHERE Accounts like '%Transfer%' and Account_Number='$ID'";
    $QueryCon = mysqli_query($con,$Query);

    while ($T = mysqli_fetch_array($QueryCon)) {
      $UID = $T['ID'];
          $UID2 = $T['ID'] -1;
    }
                $SQL2 = "INSERT INTO dp428.accounts (ID,Account_Number, Account, Budget, Date) VALUES ('$UID','$ID','Transfer Transaction','$Amount','$date')";
    $SQLCONn = mysqli_query($con,$SQL2);
    $SQL3 = "INSERT INTO dp428.accounts (ID,Account_Number, Account, Budget, Date) VALUES ('$UID2','$ID','Transfer Transaction','$Amount','$date')";
$SQLCONn2 = mysqli_query($con,$SQL3);

$SOURCEChange = "UPDATE dp428.accounts SET Budget='$newSource' WHERE ID='$SID'";
               
               $SourceConn = mysqli_query($con,$SOURCEChange);


               $With = "UPDATE dp428.accounts SET Budget='$newDest' WHERE ID='$DIID'";
               $WithCOn = mysqli_query($con,$With);
                
                $Depo1 = "INSERT INTO dp428.transactions(ID,AccountSource,AccountDest,Changes, Memo,Total) VALUES ('$UID2','$SourceAccount','$DestAccount','$NewAmount','Transfer','$newSource')";
    echo "$Depo1";
               $TCON = mysqli_query($con,$Depo1);
                $Depo2 = "INSERT INTO dp428.transactions(ID,AccountSource,AccountDest,Changes, Memo,Total) VALUES ('$UID','$DestAccount','$SourceAccount','$Amount','Transfer','$newDest')";
                $TCON2 = mysqli_query($con,$Depo2);
               }

                if($TTcon&&$TTcon2&&$SQLCONn&&$SQLCONn2&&$SourceConn&&$WithCOn&&$TCON&&$TCON2) {
                    header("Location: HomePage.php");
                }
            }
		} elseif($Option=='Yes') {
			
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title></title>
    <?php if($color=='') { ?>
    <link rel="stylesheet" type="text/css" href="../CSS/CreatePortfolio.css">
<link rel="stylesheet" type="text/css" href="../CSS/CreatePortfolio2.css"><?php } else {?>

    <link rel="stylesheet" type="text/css" href="../CSS/create<?php echo "$color"?>.css">
    <link rel="stylesheet" type="text/css" href="../CSS/CreatePortfolio2.css">
  <?php } ?>
    
</head>
<body>
    <header>
        
        <nav class="top-menu active">
        
            <div class="components">
            
                <div class="logo">
                    <a href=""><span>Transfer</span></a>
                </div>
                
                <ul class="navigation">
                     <li><a href="HomePage.php">Home</a></li>
                    <li><a href="CreateAccount.php">Create Account</a></li>
                    <li><a href="deposit.php">Deposit</a></li>
                    <li><a href="withdraw.php">Withdraw</a></li>
                    <?php if($color=='') { ?> <li><a href="" style="color: #37d72f">Transfer</a></li> <?php }else{ ?>
                    <li><a href="" style="color: <?php echo "$color"; ?>">Transfer</a></li> <?php } ?>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            
            </div>
        
        </nav>
    </header>

    <div class="banner">
    	<div class="box">
    		
    		<h1>Enter the person's username</h1><br>
    		<form action="TransferInput3.php" method="POST">
    		   	<div class="cc"><input class="text" type="text" name="OtherUser" placeholder="Username" style="width: 100%;"></div>     

    		<input type="submit" name="submit" class="a" value="Continue">
    	</form>
 
    	</div>
    </div>
    </body>
    </html>









			<?php
		} else {
			header("Location: HomePage.php");
		}



}
}

 ?>