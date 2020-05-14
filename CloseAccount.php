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
       $Close = mysqli_real_escape_string($con,$_POST['BankType']);
       echo "$Close";
		if(isset($user)) {
			$color = $_SESSION['color'];
			if ($Close=='Loan') {
				header("Location: closeLoan.php");
			} else {
			if($Close=='Checking') {
				$CID = $_SESSION['CheckingID'];
				$SID = $_SESSION['SavingID'];
			}elseif($Close=='Saving') {
				$CID = $_SESSION['SavingID'];
				$SID = $_SESSION['CheckingID'];
			}

			$SA = $_SESSION['SavingAC'];
		$AC = $_SESSION['CheckingAC'];
		$LAN = $_SESSION['LAN'];

		
		$LID = $_SESSION['LoanID'];
		$SQL2 = "SELECT * FROM dp428.accounts where ID='$SID'";
		$SQL2Con = mysqli_query($con,$SQL2);
		while ($i = mysqli_fetch_array($SQL2Con)) {
			$Other = $i['Budget'];
			$ID2 = $i['ID'];
			$NameAc = $i['Account'];
		}
		
			
$SQL = "SELECT * FROM dp428.accounts where Account='$Close' and Account_Number = (SELECT distinct Account_Number FROM dp428.accounts where Account_Number='$AC') 
or Account='$Close' and Account_Number = (SELECT distinct Account_Number FROM dp428.accounts where Account_Number='$SA') or Account='$Close'and Account_Number = (SELECT distinct Account_Number FROM dp428.accounts where Account_Number='$LAN')  ";

$SQLcon = mysqli_query($con,$SQL);

while ($i = mysqli_fetch_array($SQLcon)) {
	$ID = $i['ID'];
	$ANum = $i['Account_Number'];
	$Budget = $i['Budget'];
}

$NB = $Budget + $Other;
$NewBudget = number_format($NB,2);

$Update = "UPDATE  dp428.accounts SET Budget='$NB' where ID = '$ID2'";
$UpdateCon = mysqli_query($con,$Update);
$Delete = "DELETE FROM dp428.accounts WHERE (Account_Number='$ANum')";
$DeleteCon = mysqli_query($con,$Delete);
$Delete2 = "DELETE FROM dp428.user WHERE (Account_Number='$ANum')";
$Delete2Con = mysqli_query($con,$Delete2);

if($UpdateCon&&$DeleteCon&&$Delete2Con) {
	
	?>


<!DOCTYPE html>
<html lang="en">
<head>
	<title>Table V04</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php if($color=='') { ?>
    <link rel="stylesheet" type="text/css" href="../CSS/indexPortfolio.css"><?php } else {?>

    <link rel="stylesheet" type="text/css" href="../CSS/index<?php echo "$color"?>.css">
  <?php } ?>

<!--===============================================================================================-->
</head>
<body>

	<header>
        
        <nav class="top-menu active">
        
            <div class="components">
            
                <div class="logo">
                    <a href=""><span>Transaction</span>Table:</a>
                </div>
                
                <ul class="navigation">
                	<li><a href="Settings.php">Settings</a></li>
                    <li><a href="HomePage.php">Home</a></li>
                     <?php if($color=='') { ?> <li><a href="Close.php" style="color: #37d72f">Close Account</a></li> <?php }else{ ?>
                    <li><a href="Close.php" style="color: <?php echo "$color"; ?>">Close Account</a></li> <?php } ?>
                   
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            
            </div>
        
        </nav>
    </header>
    	



<div class="banner">
 	<div class="box">
 		<h1><?php echo "$Close"; ?> Account has been deleted<br>
 		Funds have been transferred to <?php echo "$NameAc"; ?><br>
 		Total Value: $<?php echo "$NewBudget"; ?><br>
 		</h1><br>
 		<a href="HomePage.php" class="a" style="text-decoration: none;">Go To Home</a>
 	</div>
 </div>
</body>
</html>




	<?php
}

}}else {
		header("Location:../HTML/index.html");
	}
	}

 ?>