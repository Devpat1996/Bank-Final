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
       
		if(isset($user)) {
			 $color = $_SESSION['color'];


			

		
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
                	 <?php if($color=='') { ?> <li><a href="Settings.php" style="color: #37d72f">Settings</a></li> <?php }else{ ?>
                    <li><a href="Settings.php" style="color: <?php echo "$color"; ?>">Settings</a></li> <?php } ?>
                	
                	<li><a href="background.php">Change Background</a></li>
                    <li><a href="HomePage.php">Home</a></li>
                    <li><a href="Close.php">Close Account</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            
            </div>
        
        </nav>
    </header>
    	



<div class="banner">
 	<div class="box">
 		<h1 style="color: white;">Click on Close Account to close a specfic account</h1>
 		
 		
 	</div>
 </div>
	
</body>
</html>





<?php 


			
			
		
	} else {
		header("Location:../HTML/index.html");
	}
	}


 ?>