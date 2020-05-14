<?php 

	include("dbconfig.php");

	if($con) {
		session_start();
		$user = $_SESSION['User'];
		$pass = $_SESSION['Pass'];
		
		$You = $_SESSION['YOU'];
		if(isset($user)) {
              $color = $_SESSION['color'];
            $AccountType = mysqli_real_escape_string($con,$_POST['BankType']);
      $SQL = "SELECT * FROM dp428.accounts where Account='Checking'";
      $connect = mysqli_query($con,$SQL);

    	
     	while ($r = mysqli_fetch_array($connect)) {
     			$A = $r['Budget'];
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
                    <a href=""><span>Bank</span><?php echo "$You"; ?></a>
                </div>
                
                <ul class="navigation">
                    <li><a href="HomePage.php">Home</a></li>
                                         <?php if($color=='') { ?> <li><a href="Close.php" style="color: #37d72f">Create Account</a></li> <?php }else{ ?>
                    <li><a href="Close.php" style="color: <?php echo "$color"; ?>">Create Account</a></li> <?php } ?>
                  
                    <li><a href="deposit.php">Deposit</a></li>
                    <li><a href="withdraw.php">Withdraw</a></li>
                    <li><a href="transfer.php">Transfer</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            
            </div>
        
        </nav>
    </header>

    <div class="banner">
    <div class="box">
<h1>Enter an Amount to Deposit into Saving </h1><br>
    		<form action="Alpha2.php" method="POST">
    		<div class="cc"><input type="number" name="D" min="5" placeholder="$<?php echo $A ?> Available" style="width: 100%;"></div>
    		<br>

    	<input type="submit" name="submit" class="a" value="Continue">
    </form>
    </div>
</div>
</body>
</html>



			<?php } else {
                  header("Location: ../HTML/index.html");
            }} ?>