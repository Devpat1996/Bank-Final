<?php 


	include("dbconfig.php");

	if($con) {
		session_start();
		$user = $_SESSION['User'];
		$pass = $_SESSION['Pass'];

		
		if(isset($user)) {
      $color = $_SESSION['color'];
      $Choice = mysqli_real_escape_string($con,$_POST['BankType']);
    $_SESSION['CHOICE'] = $Choice;
    $You = $_SESSION['YOU'];
      $SQL = "SELECT * FROM dp428.accounts";
      $connect = mysqli_query($con,$SQL);

       $SA = $_SESSION['SavingAC'];
       $AC = $_SESSION['CheckingAC'];

        $Query = "SELECT * FROM dp428.accounts WHERE Account!='Loan' AND Account_Number='$AC' OR Account_Number='$SA'";
          $QueryCon = mysqli_query($con,$Query);
     $SQL2 = "SELECT * FROM dp428.world";
     	$Connn = mysqli_query($con,$SQL2);

     	while ($row=mysqli_fetch_array($Connn)) {
     		$Account = $row['Account'];
     		$Total = $row['Total_Budget'];
     		
     	}
      
			?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title></title>
     <?php if($color=='') { ?>
    <link rel="stylesheet" type="text/css" href="../CSS/CreatePortfolio.css"> <link rel="stylesheet" type="text/css" href="../CSS/CreatePortfolio2.css"><?php } else {?>

    <link rel="stylesheet" type="text/css" href="../CSS/create<?php echo "$color"?>.css">
     <link rel="stylesheet" type="text/css" href="../CSS/CreatePortfolio2.css">
  <?php } ?>
  
    
</head>
<body>
    <header>
        
        <nav class="top-menu active">
        
            <div class="components">
            
                <div class="logo">
                    <a href=""><span>Deposit</span></a>
                </div>
                
                <ul class="navigation">
                    <li><a href="HomePage.php">Home</a></li>
                    <li><a href="CreateAccount.php">Create Account</a></li>
                      <?php if($color=='') { ?> <li><a href="" style="color: #37d72f">Deposit</a></li> <?php }else{ ?>
                    <li><a href="" style="color: <?php echo "$color"; ?>">Deposit</a></li> <?php } ?>
                    <li><a href="withdraw.php">Withdraw</a></li>
                    <li><a href="transfer.php">Transfer</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            
            </div>
        
        </nav>
    </header>

    <div class="banner">
    <div class="box">
      
<h1>How much would you like to deposit?</h1><br>
    		<form action="Deposit3.php" method="POST">
    		
    		<div class="cc"><input type="number" name="D"  min="1" placeholder=" <?php echo"Max: $Total" ?> " style="width: 100%;"></div>
    		<br>


    	<input type="submit" name="submit" class="a" value="Continue">
    </form>
</div>
</div>

</body>
</html>



			<?php }else {
        header("Location: ../HTML/index.html");
      }} ?>