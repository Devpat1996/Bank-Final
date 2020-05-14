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
			$firstday = date('Y-m-d H:i:s', strtotime("first day of this month midnight")); 
    $today = date('Y-m-d H:i:s', strtotime(" 0 day today")); 
     $today2 = date('Y-m-d H:i:s', strtotime(" 0 day today")); 
$Account_Number = mysqli_real_escape_string($con,$_SESSION['Account']);
			$SQL = 
			"SELECT * FROM dp428.transactions where AccountSource = '$SA' or AccountSource = '$AC' or AccountSource = '$LAN' or AccountDest = '$AC' or AccountDest = '$LAN' or AccountDest = '$SA' order by ID DESC";
			$CON = mysqli_query($con,$SQL);


			

		
?>
		<!DOCTYPE html>
<html lang="en">
<head>
	<title>Table V04</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php if($color=='') { ?>
    <link rel="stylesheet" type="text/css" href="../CSS/CreatePortfolio.css">
<link rel="stylesheet" type="text/css" href="../CSS/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="../CSS/perfect-scrollbar.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../CSS/util.css">
	<link rel="stylesheet" type="text/css" href="../CSS/main2.css"><?php } else {?>

    <link rel="stylesheet" type="text/css" href="../CSS/create<?php echo "$color"?>.css">
    <link rel="stylesheet" type="text/css" href="../CSS/<?php echo $color ?>main.css">
    <link rel="stylesheet" type="text/css" href="../CSS/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="../CSS/perfect-scrollbar.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../CSS/util.css">
  
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

    		
    		<br>
		<div class="limiter">
		<div class="container-table100">
			<div class="wrap-table100">
				

					

				<div class="table100 ver3 m-b-110">
					<div class="table100-head">
						<table>
							<thead>
								<tr class="row100 head">
									<th class="cell100 column1">Account Source</th>
									<th class="cell100 column2">Account Destination</th>
									<th class="cell100 column3">Changes</th>
									<th class="cell100 column4">Memo</th>
									<th class="cell100 column5">Total</th>
								
								</tr>
							</thead>
						</table>
					</div>

					<div class="table100-body js-pscroll">
						<table>
							<tbody>
								<tr class="row100 body">
									<?php while ($rows = mysqli_fetch_array($CON)) {
					
					$AS = $rows['AccountSource'];
					$AD = $rows['AccountDest'];
					$Changes = $rows['Changes'];
					$Memo = $rows['Memo'];
					$Total = $rows['Total'];


				 ?>
								 <?php if($color=='') { ?>	<td class="cell100 column1" style="color: #37d72f"><?php echo "$AS"; ?></td>
									<td class="cell100 column2" style="color: #37d72f"><?php echo "$AD"; ?></td> <?php }else{ ?>
										<td class="cell100 column1" style="color: <?php echo "$color"; ?>"><?php echo "$AS"; ?></td>
									<td class="cell100 column2" style="color: <?php echo "$color"; ?>"><?php echo "$AD"; ?></td> <?php } ?>

									<td class="cell100 column3"><?php echo "$Changes"; ?></td>
									<td class="cell100 column4"><?php echo "$Memo"; ?></td>
									<td class="cell100 column5"><?php echo "$Total"; ?></td>
									
								</tr>

								<?php } ?>
							</tbody>
						</table>
					</div>
				

				</div>
			</div>
		</div>
	</div>


<!--===============================================================================================-->	
	<script src="../js/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->


<!--===============================================================================================-->
	
<!--===============================================================================================-->
	<script src="../js/perfect-scrollbar.min.js"></script>
	<script>
		$('.js-pscroll').each(function(){
			var ps = new PerfectScrollbar(this);

			$(window).on('resize', function(){
				ps.update();
			})
		});
			
		
	</script>
<!--===============================================================================================-->
	
</body>
</html>





<?php 


			
			
		
	} else {
		header("Location:../HTML/index.html");
	}
	}


 ?>