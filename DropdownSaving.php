<?php 

	include("dbconfig.php");

	if($con) {
		session_start();
		$user = $_SESSION['User'];
		$pass = $_SESSION['Pass'];
        if(isset($user)) {
		$AccountType = mysqli_real_escape_string($con,$_POST['BankType']);
		$You = $_SESSION['YOU'];
		
      $SQL = "SELECT * FROM dp428.accounts_$You";
      $connect = mysqli_query($con,$SQL);

    		$Query = "SELECT * FROM dp428.accounts_$You WHERE Account!='$AccountType' AND Account!='Loan'";
    			$QueryCon = mysqli_query($con,$Query);
     
      
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
                    <li><a href="" style="color: #37d72f">Create Account</a></li>
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
<h1>Enter Amount From Checking Account To Deposit<br>Before we begin, you must deposit $5.00 </h1><br>
    		<form action="DropdownSaving2.php" method="POST">
    		<div class="cc"><input type="number" name="D" min="5" placeholder="$5.00" style="width: 100%;"></div>
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