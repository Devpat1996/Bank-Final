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
 		<h1>In order to close loan account, you must pay the loan in full
 		</h1><br>
 		<a href="HomePage.php" class="a" style="text-decoration: none;">Go To Home</a>
 		<a href="payLoan.php" class="a" style="text-decoration: none;">Pay Full Loan</a>
 	</div>
 </div>
</body>
</html>




	<?php


}else {
		header("Location:../HTML/index.html");
	}
	}

 ?>