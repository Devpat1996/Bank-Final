<?php 

	include("dbconfig.php");

	if($con) {
		$User = mysqli_real_escape_string($con,$_POST['login']);
		$Pass = mysqli_real_escape_string($con,$_POST['pass']);


		session_start();

		$_SESSION['YOU'] = $User;

		$EncryptUser = md5($User);
		$EncryptPass = md5($Pass);
	

		$SQL = "SELECT * FROM dp428.user WHERE User='$EncryptUser' AND Pass='$EncryptPass'";
		$Connect = mysqli_query($con,$SQL);
		while ($rows = mysqli_fetch_array($Connect)) {
			$A = $rows['Account_Number'];
			$_SESSION['Account'] = $A;
		}

		if($Connect) {
			if(mysqli_num_rows($Connect)>0) {
				$ColorCheck = "SELECT * FROM dp428.color where User='$EncryptUser' and Pass='$EncryptPass'";
				$ColorCon = mysqli_query($con,$ColorCheck);
				while ($i = mysqli_fetch_array($ColorCon)) {
					$C = $i['Color'];
					$_SESSION['color'] = $C;
				}
				$SQL = "SELECT * from dp428.user where Accounts='Saving' and User='$EncryptUser'";
				$coM = mysqli_query($con,$SQL);
				while ($i = mysqli_fetch_array($coM)) {
					$A = $i['Account_Number'];
					$B = $i['ID'];
					$_SESSION['SavingAC'] = $A;
					$_SESSION['SavingID'] = $B;
				}
				$SQL2 = "SELECT * from dp428.user where Accounts='Checking' and User='$EncryptUser'";
				$coM2 = mysqli_query($con,$SQL2);
				while ($i = mysqli_fetch_array($coM2)) {
					$A = $i['Account_Number'];
					$_SESSION['CheckingAC'] = $A;
					$B = $i['ID'];
					$_SESSION['CheckingID'] = $B;
				}
				$SQL3 = "SELECT * from dp428.user where Accounts='Loan' and User='$EncryptUser'";
				$coM3 = mysqli_query($con,$SQL3);
				while ($i = mysqli_fetch_array($coM3)) {
					$A = $i['Account_Number'];
					$_SESSION['LAN'] = $A;
					$B = $i['ID'];
					$_SESSION['LoanID'] = $B;
				}
				$_SESSION['User'] = $EncryptUser;
				$_SESSION['Pass'] = $EncryptPass;

				$_SESSION['User2'] = $EncryptUser;
				$_SESSION['Pass2'] = $EncryptPass;
			header("Location: HomePage.php");
		 }else {

			?>
			
			<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" type="text/css" href="../CSS/index.css">
    <link rel="stylesheet" type="text/css" href="../CSS/Wrong.css">
</head>
<body>
    <header>
        
        <nav class="top-menu active">
        
            <div class="components">
            
                <div class="logo">
                    <a href=""><span>Bank</span>Deval</a>
                </div>
                
                <ul class="navigation">
                    <li><a href="index.html">Home</a></li>
                    <li><a href="" style="color: #37d72f">Sign In</a></li>
                    <li><a href="registration.html">Registration</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            
            </div>
        
        </nav>
    </header>

    <div class="banner">
        <h1>Wrong Credentials..Sorry You Can't Log In.<br>Click <a href="../HTML/Sign.html" class="link">here</a> to try again</h1>
        
        
    </div>
</body>
</html>





<?php

		}
	}
	}

 ?>
