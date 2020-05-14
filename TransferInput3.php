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

		$AccountDest = mysqli_real_escape_string($con,$_SESSION['AccountD']);
		$DestBudget = mysqli_real_escape_string($con,$_SESSION['DestBudget']);

		$Amount = mysqli_real_escape_string($con,$_SESSION['Amount']);
		$UserNew = mysqli_real_escape_string($con,$_POST['OtherUser']);
        $_SESSION['UserNew'] = $UserNew;


	
			
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
    		
    		<h1>Enter the person's last 6 digit account number</h1><br>
    		<form action="TransferInput4.php" method="POST">
    		   	<div class="cc"><input class="text" min="6" max="6" type="password" name="OtherPass" placeholder="Account Number" style="width: 100%;"></div>     

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

 ?>