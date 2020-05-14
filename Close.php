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
			$SA = $_SESSION['SavingAC'];
		$AC = $_SESSION['CheckingAC'];
		$LAN = $_SESSION['LAN'];
			
$SQL = "SELECT * FROM dp428.accounts where Account='Checking' and Account_Number = (SELECT distinct Account_Number FROM dp428.accounts where Account_Number='$AC') 
or Account='Saving' and Account_Number = (SELECT distinct Account_Number FROM dp428.accounts where Account_Number='$SA') or Account='Loan'and Account_Number = (SELECT distinct Account_Number FROM dp428.accounts where Account_Number='$LAN')  ";

$SQLcon = mysqli_query($con,$SQL);


			

		
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
                	<li><a href="Settings.php">Settings</a></li>
                    <li><a href="HomePage.php">Home</a></li>
                     <?php if($color=='') { ?> <li><a href="Close.php" style="color: #37d72f">Close Account</a></li> <?php }else{ ?>
                    <li><a href="Close.php" style="color: <?php echo "$color"; ?>">Close Account</a></li> <?php } ?>
                   
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            
            </div>
        
        </nav>
    </header>
    	



<div class="banner">
 	<div class="box">

 		<h1 style="color: white;">Choose an Account You Want to Close.</h1>
 		<form action="CloseAccount.php" method="POST">
    		
    		<div class="custom-select" style="width:200px;">
    		<select name="BankType">
    			<option value="None">Choose Account</option>
    			<?php 

    			
    			while($rows2 = mysqli_fetch_array($SQLcon)) {
    				$price = number_format($rows2['Budget'],2);


    			 ?>
    			<option value="<?php echo $rows2['Account']; ?>"><?php echo $rows2['Account']; echo ": <b>$$price</b>"; ?></option>
    			<?php } ?>
    		</select>
    	</div>

    	<input type="submit" name="submit" class="a" value="Continue">
    </form>
 		
 		
 	</div>
 </div>
	
</body>
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
</html>





<?php 


			
			
		
	} else {
		header("Location:../HTML/index.html");
	}
	}


 ?>