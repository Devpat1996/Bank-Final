<?php 
	
include("dbconfig.php");

	if($con) {
		session_start();
		$user = $_SESSION['User'];
		$pass = $_SESSION['Pass'];
		if(isset($user)) {
            $color = $_SESSION['color'];
     	$AccountS = $_SESSION['AccountS'];
        $Z = $_SESSION['Z'];
     $AccountD = mysqli_real_escape_string($con,$_POST['AccountD']);
     $_SESSION['AccountD'] = $AccountD;
     if($AccountD=="Checking") {
      $D = $_SESSION['CheckingAC'];
     } elseif ($AccountD=='Loan') {
      $D = $_SESSION['LAN'];
     } else {
      $D = $_SESSION['SavingAC'];
     }
     $_SESSION['D'] = $D;
     $SQL = "SELECT * FROM dp428.accounts where Account='$AccountS' and Account_Number='$Z'";
     $SQLC = mysqli_query($con,$SQL);

     $SQL2 = "SELECT * FROM dp428.accounts where Account='$AccountD' and Account_Number='$D'";
     $SQLC2 = mysqli_query($con,$SQL2);

     while ($rows=mysqli_fetch_array($SQLC)) {
     	$STB = $rows['Budget'];
     	$_SESSION['SourceBudget'] = $STB;
     }

      while ($rows=mysqli_fetch_array($SQLC2)) {
     	$DTB = $rows['Budget'];
     	$_SESSION['DestBudget'] = $DTB;
     }
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
    		<?php 
         
    		if($DTB<0) {
    		 ?>
    		<h1>You Need To Deposit money into <?php echo "$AccountD"; ?><br>Deposit by clicking <a href="deposit.php" style="color: white;">here</a></h1><?php } else{ ?>
    		<h1>How much will you like to transfer?</h1><br>
    		<form action="TransferInput.php" method="POST">
    		<div class="cc"><input type="number" name="Amount"   min="1" max="<?php echo"$STB" ?>" placeholder=" <?php echo"Max: $STB" ?> " style="width: 100%;"></div>
    		<input type="submit" name="submit" class="a" value="Continue">
    	</form>
    <?php } ?>
    	</div>
    </div>
</body>
</html>






   <?php

 }
}

 ?>