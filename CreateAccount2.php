<?php 

include("dbconfig.php");

	if($con) {
		session_start();
		$user = $_SESSION['User'];
		$pass = $_SESSION['Pass'];
        if(isset($user)) {
             $color = $_SESSION['color'];
        $Account_Number = mysqli_real_escape_string($con,$_SESSION['Account']);
        $CheckingAN = $_SESSION['CheckingAC'];
        $SavingAN = $_SESSION['SavingAC'];
		$AccountType = mysqli_real_escape_string($con,$_POST['BankType']);
        $_SESSION['AccountType'] = $AccountType;
		$You = $_SESSION['YOU'];
		$SA = $_SESSION['SavingAC'];
        $LoanID = $_SESSION['LoanID'];
$AC = $_SESSION['CheckingAC'];
           
      $SQL = "SELECT * FROM dp428.accounts";
      $connect = mysqli_query($con,$SQL);
         $LID = $_SESSION['LoanID'];
       $SID = $_SESSION['SavingID'];
       $CID = $_SESSION['CheckingID'];
       $SID2 = $SID+1;

    		$Query = "SELECT * FROM dp428.accounts WHERE ID='$SID' OR ID='$CID' or ID='$SID2'";
    			$QueryCon = mysqli_query($con,$Query);
     
      
			?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title></title>
    <?php if($color=='') { ?>
    <link rel="stylesheet" type="text/css" href="../CSS/CreatePortfolio.css">
<link rel="stylesheet" type="text/css" href="../CSS/CreatePortfolio2.css"><?php } else {?>

    <link rel="stylesheet" type="text/css" href="../CSS/create<?php echo "$color"?>.css">
    <link rel="stylesheet" type="text/css" href="../CSS/CreatePortfolio2.css">
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
    <div class="box">
    		<?php 
    		$AType = mysqli_real_escape_string($con,$_POST['BankType']);
    		if ($AType=='Checking') {
    			$SQL3 = "SELECT * FROM dp428.accounts WHERE Account='Checking' AND Account_Number='$CheckingAN'";
    			$SQLC = mysqli_query($con,$SQL3);
    			if(mysqli_num_rows($SQLC)>0) {
    				echo "<h1>You Already Have An Existing Account</h1>";
    			} else {
    			if(mysqli_num_rows($QueryCon)<1) {
    			echo "
    		
    		
    		 
    		<h1> Let's Create Your Checking's Account<br>Before we begin, you must deposit $5.00 </h1><br>";  ?>
    		<form action="CheckingCreate.php" method="POST">
    		<div class="cc"><input type="number" name="Checking" min="5" placeholder="$5.00" style="width: 100%;"></div>
    		<br>

    	<input type="submit" name="submit" class="a" value="Continue">
    </form>
<?php } ?>
<?php 
		if(mysqli_num_rows($QueryCon)>0) {
			echo "
    		
    		
    		 
    		<h1> Let's Create Your Checking's Account<br>Before we begin, you must deposit $5.00 </h1><br>";  ?>
            <form action="CheckingCreate.php" method="POST">
            <div class="cc"><input type="number" name="Checking" min="5" placeholder="$5.00" style="width: 100%;"></div>
            <br>

        <input type="submit" name="submit" class="a" value="Continue">
    </form>
		    		
    	<?php }}} 



    		 




    	if ($AType=='Saving') {
    		$SQL = "SELECT * FROM dp428.accounts WHERE Account='Saving' AND Account_Number='$SavingAN'";
    			$SQLC = mysqli_query($con,$SQL);
    			if(mysqli_num_rows($SQLC)>0) {
    				echo "<h1>You Already Have An Existing Account</h1>";
    			} else {
    		if(mysqli_num_rows($QueryCon)<1) {
    			
    			echo "
    		
    		
    		 
    		<h1>Create Your Checking's Account First</h1><br>";  ?>
    		<a href="CreateAccount.php" class="a">Click Here To Start</a>
<?php } ?>
<?php 
		if(mysqli_num_rows($QueryCon)>0) {
			echo "
    		
    		
    		 
    		<h1>Let's Create Your Saving's Account<br>Before we begin, you must deposit $5.00 or transfer from existing account</h1><br>";  ?>
    		<form action="DropdownSaving2.php" method="POST">
    		<div class="cc"><input type="number" name="num" min="5" placeholder="$5.00"></div>
    		<br>
    		<strong class="or">OR</strong>
    		<div class="custom-select" style="width:200px;">
    		<select name="Type">
    			<option value="None">Choose Account</option>
    			<?php 

    			
    			while($rows2 = mysqli_fetch_array($QueryCon)) {
    				$price = $rows2['Budget'];

    			 ?>
    			<option value="<?php echo $rows2['Account'] ?>"><?php echo $rows2['Account']; echo ": <b>$$price</b>"; ?></option>
    			<?php } ?>
    		</select>
    	</div>

    	<input type="submit" name="submit" class="a" value="Continue">
    </form>
		    		
    	<?php }}} 
    	if ($AType=='Loan') {
    		$SQL = "SELECT * FROM dp428.accounts WHERE Account='Loan' AND ID='$LoanID'";
          
    			$SQLC = mysqli_query($con,$SQL);
    			if(mysqli_num_rows($SQLC)>0) {
    				echo "<h1>You Already Have An Existing Account</h1>";
    			} else {
    		if(mysqli_num_rows($QueryCon)<2) {
    			echo "
    		
    		
    		 $Query
    		<h1>Look's Like You don't have 2 accounts yet. Add those accounts and come back after!</h1><br>";  ?>
    		
<?php } ?>
<?php 
		if(mysqli_num_rows($QueryCon)>1) {
			echo "
    		
    		
    		 
    		<h1>Let's Create Your Loan's Account<br>Before we begin, you must pick an account to deposit to</h1><br>";  ?>
    		<form action="LoanQuestion2.php" method="POST">
    	
    		<div class="custom-select" style="width:200px; margin-left: -50%; float: right;">
    		<select name="BankType">
    			<option value="None">Choose Account</option>
    			<?php 

    			
    			while($rows2 = mysqli_fetch_array($QueryCon)) {
    				$price = $rows2['Budget'];
    				
    			 ?>
    			<option value="<?php echo $rows2['Account'] ?>"><?php echo $rows2['Account']; echo ": <b>$$price</b>"; ?></option>
    			<?php } ?>
    		</select>
    	</div>

    	<input type="submit" name="submit" class="a" value="Continue">
    </form>
		    		
    	<?php }}} ?>
    	</div>
    	</div>
    
    <script>
var x, i, j, selElmnt, a, b, c;
/*look for any elements with the class "custom-select":*/
x = document.getElementsByClassName("custom-select");
for (i = 0; i < x.length; i++) {
  selElmnt = x[i].getElementsByTagName("select")[0];
  /*for each element, create a new DIV that will act as the selected item:*/
  a = document.createElement("DIV");
  a.setAttribute("class", "select-selected");
  a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
  x[i].appendChild(a);
  /*for each element, create a new DIV that will contain the option list:*/
  b = document.createElement("DIV");
  b.setAttribute("class", "select-items select-hide");
  for (j = 1; j < selElmnt.length; j++) {
    /*for each option in the original select element,
    create a new DIV that will act as an option item:*/
    c = document.createElement("DIV");
    c.innerHTML = selElmnt.options[j].innerHTML;
    c.addEventListener("click", function(e) {
        /*when an item is clicked, update the original select box,
        and the selected item:*/
        var y, i, k, s, h;
        s = this.parentNode.parentNode.getElementsByTagName("select")[0];
        h = this.parentNode.previousSibling;
        for (i = 0; i < s.length; i++) {
          if (s.options[i].innerHTML == this.innerHTML) {
            s.selectedIndex = i;
            h.innerHTML = this.innerHTML;
            y = this.parentNode.getElementsByClassName("same-as-selected");
            for (k = 0; k < y.length; k++) {
              y[k].removeAttribute("class");
            }
            this.setAttribute("class", "same-as-selected");
            break;
          }
        }
        h.click();
    });
    b.appendChild(c);
  }
  x[i].appendChild(b);
  a.addEventListener("click", function(e) {
      /*when the select box is clicked, close any other select boxes,
      and open/close the current select box:*/
      e.stopPropagation();
      closeAllSelect(this);
      this.nextSibling.classList.toggle("select-hide");
      this.classList.toggle("select-arrow-active");
    });
}
function closeAllSelect(elmnt) {
  /*a function that will close all select boxes in the document,
  except the current select box:*/
  var x, y, i, arrNo = [];
  x = document.getElementsByClassName("select-items");
  y = document.getElementsByClassName("select-selected");
  for (i = 0; i < y.length; i++) {
    if (elmnt == y[i]) {
      arrNo.push(i)
    } else {
      y[i].classList.remove("select-arrow-active");
    }
  }
  for (i = 0; i < x.length; i++) {
    if (arrNo.indexOf(i)) {
      x[i].classList.add("select-hide");
    }
  }
}
/*if the user clicks anywhere outside the select box,
then close all select boxes:*/
document.addEventListener("click", closeAllSelect);
</script>
</body>
</html>


<?php }	else {
      header("Location: ../HTML/index.html");
}} ?>