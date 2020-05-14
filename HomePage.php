<?php 

	 include("dbconfig.php");

	if($con) {
		session_start();
		$user = $_SESSION['User'];
		$pass = $_SESSION['Pass'];
    
		$You = $_SESSION['YOU'];
    if(isset($user)) {
      $color = $_SESSION['color'];
         date_default_timezone_set('America/New_York');
        
        $date = date('F d, Y g:i A ', strtotime("now"));
        $firstday = date('F d, Y g:i A', strtotime("first day of this month midnight")); 

        $ANUM = "SELECT * FROM dp428.user where User='$user'";
        $ANUMCON = mysqli_query($con,$ANUM);

        while ($k = mysqli_fetch_array($ANUMCON)) {
          $A = $k['Account_Number'];
        }
$SA = $_SESSION['SavingAC'];
        $U = "SELECT * FROM dp428.accounts WHERE Account='Saving' AND Account_Number='$SA'";
        $UCO = mysqli_query($con,$U);

        while ($UR = mysqli_fetch_array($UCO)) {
           $GN = $UR['Budget'];
         } 

     

       
     
     $SQL = "SELECT * FROM dp428.world ";
     $SQLCON = mysqli_query($con,$SQL);

     while ($r = mysqli_fetch_array($SQLCON)) {
       $TotalB = $r['Total_Budget'];
       $_SESSION['TotalBudget'] = $TotalB;
     }

		
      




      
      
        
      
			?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title></title>
    <?php if($color=='') { ?>
    <link rel="stylesheet" type="text/css" href="../CSS/indexPortfolio.css"><?php } else {?>

    <link rel="stylesheet" type="text/css" href="../CSS/<?php echo "$color"?>.css">
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
                    <li><a href="Settings.php">Settings</a></li>
                   <?php if($color=='') { ?> <li><a href="#" style="color: #37d72f">Home</a></li> <?php }else{ ?>
                    <li><a href="#" style="color: <?php echo "$color"; ?>">Home</a></li> <?php } ?>
                    <li><a href="CreateAccount.php">Create Account</a></li>
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

    <a href="transactionTable.php" class="a">View Transaction Table</a>
    
    <?php 
    $AC = $_SESSION['CheckingAC'];
    $SQL2 = "SELECT * FROM dp428.accounts where Account='Checking' and Account_Number='$AC' and Budget<5 OR Account='Saving' and Account_Number='$SA' and Budget<5";
    
    $connect2 = mysqli_query($con,$SQL2);
      $count2 = mysqli_num_rows($connect2);
 
      $LAN = $_SESSION['LAN']; //AC,LAN,SA


$SQL = "SELECT * FROM dp428.accounts where Account='Checking' and Account_Number = (SELECT distinct Account_Number FROM dp428.accounts where Account_Number='$AC') 
or Account='Saving' and Account_Number = (SELECT distinct Account_Number FROM dp428.accounts where Account_Number='$SA') or Account='Loan'and Account_Number = (SELECT distinct Account_Number FROM dp428.accounts where Account_Number='$LAN')  ";



  
    $connect = mysqli_query($con,$SQL);

    $count = mysqli_num_rows($connect);
  if($count2>0) {
    while($rows=mysqli_fetch_array($connect2)) {
       
         
        $Account = $rows['Account'];
        $Total = number_format($rows['Budget'],2);
    ?>
<div class="mySlides fade">
  <div class="numbertext">Account(S): <?php echo "$count"; ?></div><br><br>
  <div class="fit">
  <h2 style="color: orange;"><?php echo "$Account"; ?> Account</h2>
    <p style="color: orange;">Account Value: $<?php echo "$Total"; ?></p>
    <a href="deposit.php" class="a" style="background-color: black; color: #fff;">Deposit Now!</a>
  </div>
</div>



    <?php
  } }else {
 if($count<1) {
  echo "<h1>Hey $You! Let's create your acccount </h1><br><a href='CreateAccount.php' class='a'>Create An Account</a>";
 } 

 elseif($date==$firstday) {
     $r = 0.01;
              $n = 12;

              $APV = (((pow((1+($r/$n)), $n))-1)*$GN); //Saving
               $APV2 = (((pow((1+($r/$n)), $n))-1)*$GN2); //Loan
   
              $RealAPV = round($GN+$APV,2);
              $RealAPV2 = round($Loan-$APV,2);

              $SQL = "UPDATE dp428.accounts SET Budget='$RealAPV' WHERE Account='Saving' AND Account_Number='$A'";//Saving
              $SQLCon = mysqli_query($con,$SQL);//Saving

              $SQL4 = "UPDATE dp428.accounts SET Budget='$RealAPV2' WHERE Account='$Loan' AND Account_Number='$A'";//Saving
              $SQLCon4 = mysqli_query($con,$SQL4);//Saving

              if($SQLCon4&&$SQLCon) {
                header("Location: HomePage.php");
              }
}



 else { 





  ?>
 	<div class="slideshow-container">
<?php 
 
 while($rows=mysqli_fetch_array($connect)) {
       
         
        $Account = $rows['Account'];
        $Total = number_format($rows['Budget'],2);
        $AccountN = $rows['Account_Number'];
         ?>
<div class="mySlides fade">
  <div class="numbertext">Account(S): <?php echo "$count"; ?></div><br><br>
  <div class="fit">

  <h2><?php echo "$Account"; ?> Account</h2>
   <h3 style="color: #FFF">Account Number: <?php echo "$AccountN"; ?></h3><br>
    <p>Account Value: $<?php echo "$Total"; ?></p>
    <a href="<?php echo"$Account" ?>View.php" class="a">View Account</a>
  </div>
</div>
<?php } } }


    


?>

<?php if($count>0 && $count2<1) { ?>
<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
<a class="next" onclick="plusSlides(1)">&#10095;</a>

</div>
<br>

<div style="text-align:center">
  <span class="dot" onclick="currentSlide(1)"></span> 
  <span class="dot" onclick="currentSlide(2)"></span> 
  <span class="dot" onclick="currentSlide(3)"></span> 
</div>
 	</div>
        
        </div>
    </div>
  <?php } }

  else {
    header("Location: ../HTML/index.html");
  }

  ?>
    <script>
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
}
</script>	
</body>
</html>








			<?php
		
	}


 ?>