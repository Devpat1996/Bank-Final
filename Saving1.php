<?php 


	include("dbconfig.php");

	if($con) {
		session_start();
		$user = $_SESSION['User'];
		$pass = $_SESSION['Pass'];
			if(isset($user)) {
		
		$Input = mysqli_real_escape_string($con,$_POST['BankType']); //Selection Account
		
		$You = $_SESSION['YOU'];
		$AccountInput =mysqli_real_escape_string($con,$_POST['Saving']); //Input Money
		$AccountValue = "SELECT * FROM dp428.accounts_$You WHERE Account='$Input'";
		$AccountConnect = mysqli_query($con,$AccountValue);

		
		if($Input=='None' && $AccountInput=='') { //If nothing selected
			header("Location: ErrorSaving.php");
		}
		if(mysqli_num_rows($AccountConnect)>0) { //If Dropdown selected
			while($rows = mysqli_fetch_array($AccountConnect)) {
			$AccountVALUE = $rows['Total_Budget'];
			echo $AccountVALUE;

			$_SESSION['DropdownValue'] = $$AccountVALUE;
			header("Location: DropdownSaving.php");	
			
		} }else { //If Input typed
			
echo "string";



		}
		} else {
			  header("Location: ../HTML/index.html");
		}

		

		
	
    
	?>











	<?php }?>