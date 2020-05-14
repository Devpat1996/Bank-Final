<?php 
include("dbconfig.php");

	if($con) {
		session_start();
		$user = $_SESSION['User'];
		$pass = $_SESSION['Pass'];
    if(isset($user)) {
        $color = $_SESSION['color'];
		$You = $_SESSION['YOU'];
        $APVValue = $_SESSION['Price'];
        $Withdraw = mysqli_real_escape_string($con,$_POST['BankType']);
     
        $_SESSION['AccountType'] = $Withdraw;

        if($Withdraw=='Checking') {
          $C = $_SESSION['SavingID'];
        }elseif ($Withdraw=='Saving') {
          $C = $_SESSION['CheckingID'];
        }
     $SQL = "SELECT * FROM dp428.accounts where Account!='$Withdraw' and ID='$C'";
     $SQLCON = mysqli_query($con,$SQL);

     while ($Fetch = mysqli_fetch_array($SQLCON)) {
       $Fetchit = number_format($Fetch['Budget'],2);
     }

       


		
   



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
      
 <h1>How much wil you like to take for the loan?</h1><br>

 
        
            
 		<form action="InsertLoan.php" method="POST">
    		<div class="cc"><input type="number" name="LoanVALUE" min="5" max=" <?php echo $Fetchit ?> " placeholder=" <?php echo "Max of: $$Fetchit" ?>" style="width: 100%"></div>
        <input type="submit" name="submit" class="a" value="Continue">
    </form>
 
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








   <?php
  } else {
      header("Location: ../HTML/index.html");
  }
}

 ?>