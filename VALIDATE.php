<?php 

include("dbconfig.php");

	if($con) {

		$USER = mysqli_real_escape_string($con,$_POST['login']);
		$PASS = mysqli_real_escape_string($con,$_POST['pass']);
		$BUDGET = mysqli_real_escape_string($con,$_POST['budget']);

		date_default_timezone_set('America/New_York');
		$date = date('F m, Y g:i A ', strtotime("now")); 

		session_start();

	


		$EncryptUser = md5($USER);
		$EncryptPass = md5($PASS);
		$_SESSION['EncryptUser'] = $EncryptUser;
		$_SESSION['EncryptPass'] = $EncryptPass;

		$EncryptBudget = md5($BUDGET);

		$SQL = "SELECT * FROM dp428.user";
		$Connect = mysqli_query($con,$SQL);

		while ($rows = mysqli_fetch_array($Connect)) {

			$user = $rows['User'];
			$_SESSION['User'] = $user;
			$pass = $rows['Pass'];
		}

		if($EncryptUser==$user) {
			echo "Username Already Exists";
		} else {
		$count=0;

		while ( $count < 12 ) {
    	$random_digit = mt_rand(0, 9);
    	$count++;
    	$random_number .=$random_digit;
}
		$SQL2 = "INSERT INTO dp428.user (Account_Number,User,Pass,Accounts) VALUES ('$random_number','$EncryptUser','$EncryptPass','') ";
		
		$Connect2 = mysqli_query($con,$SQL2);
			if($Connect2) {
				$_SESSION['User2'] = $USER;
				$_SESSION['Pass2'] = $PASS;
				$_SESSION['YOU'] = $USER; 
				$_SESSION['CRYPT'] = $EncryptUser;

				header("Location: ../HTML/index.html");



}
}
} else {
	echo "Not connected";
}


 ?>