<?php 

include("dbconfig.php");

	if($con) {
		session_start();
		$user = $_SESSION['User'];
		$pass = $_SESSION['Pass'];
		
		$You = $_SESSION['YOU'];
		if(isset($user)) {
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
    <link rel="stylesheet" type="text/css" href="../CSS/CreatePortfolio.css">
    <link rel="stylesheet" type="text/css" href="../CSS/CreatePortfolio2.css">
    
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
                    <li><a href="CreateAccount.php">Create Account</a></li>
                    <li><a href="deposit.php">Deposit</a></li>
                    <li><a href="#" style="color: #37d72f">Withdraw</a></li>
                    <li><a href="transfer.php">Transfer</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            
            </div>
        
        </nav>
    </header>

    <div class="banner">
    <div class="box">
<h1>You are beyond your limit, Try Again</h1><br>
<a href="withdraw.php" class="a" style="text-decoration: none;">Click Here To Try Again</a>
    		
    </div>
</div>
</body>
</html>



			<?php } else {
                header("Location: ../HTML/index.html");
            }} ?>