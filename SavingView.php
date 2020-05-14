<?php 

include("dbconfig.php");

	if($con) {
		session_start();
		$user = $_SESSION['User'];
		$pass = $_SESSION['Pass'];
		$You = $_SESSION['YOU'];
		$SA = $_SESSION['SavingAC'];

		if(isset($user)) {

       $firstday = date('Y-m-d H:i:s', strtotime("first day of this month midnight")); 
    $today = date('Y-m-d H:i:s', strtotime(" 0 day today")); 
     $today2 = date('Y-m-d H:i:s', strtotime(" 0 day today")); 
$Account_Number = mysqli_real_escape_string($con,$_SESSION['Account']);
			$SQL = "SELECT * FROM dp428.statement where Account_Number='$SA'order by Date DESC";
			$CON = mysqli_query($con,$SQL);

			$Check = "SELECT * FROM dp428.accounts where Account_Number='$SA' and Account='Saving'";
			$CheckCon = mysqli_query($con,$Check);

			while ($CC = mysqli_fetch_array($CheckCon)) {
				$VALUE = number_format($CC['Budget'],2);
			}

		
?>
		<!DOCTYPE html>
<html lang="en">
<head>
	<title>Table V04</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../CSS/CreatePortfolio.css">
	<link rel="stylesheet" type="text/css" href="../CSS/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="../CSS/perfect-scrollbar.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../CSS/util.css">
	<link rel="stylesheet" type="text/css" href="../CSS/main2.css">
<!--===============================================================================================-->
</head>
<body>

	<header>
        
        <nav class="top-menu active">
        
            <div class="components">
            
                <div class="logo">
                    <a href=""><span>Saving:</span>&nbsp$<?php echo "$VALUE"; ?></a>
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
    		<br>
		<div class="limiter">
		<div class="container-table100">
			<div class="wrap-table100">
				

					

				<div class="table100 ver3 m-b-110">
					<div class="table100-head">
						<table>
							<thead>
								<tr class="row100 head">
									<th class="cell100 column1">Amount</th>
									<th class="cell100 column2">Date</th>
									<th class="cell100 column3">Statements</th>
								
								</tr>
							</thead>
						</table>
					</div>

					<div class="table100-body js-pscroll">
						<table>
							<tbody>
								<tr class="row100 body">
									<?php while ($rows = mysqli_fetch_array($CON)) {
				
				$Amount = $rows['Amount'];
				$Date = $rows['Date'];
				date_default_timezone_set('America/New_York');
				$Loan = date('F m, Y g:i A ', strtotime("$Date")); 
				
				
				$Statement = $rows['Statement']; ?>
									<td class="cell100 column1"><?php echo "$Amount"; ?></td>
									<td class="cell100 column2" style="color: #37d72f"><?php echo "$Loan"; ?></td>
									<td class="cell100 column3"><?php echo "$Statement"; ?></td>
									
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