<?php 

include("dbconfig.php");

	if($con) {
		session_start();
		$user = $_SESSION['User'];
		$pass = $_SESSION['Pass'];
    $CRYPT = $_SESSION['CRYPT'];
		$You = $_SESSION['YOU'];
		if(isset($user)) {
       $color = $_SESSION['color'];
        $You = $_SESSION['YOU'];
     $AccountChoose = mysqli_real_escape_string($con,$_POST['Account']);
     $_SESSION['AccountS'] = $AccountChoose;
     if($AccountChoose=="Checking") {
      $AC = $_SESSION['LAN'];
      $AC1 = "Loan";
      $SA = $_SESSION['SavingAC'];
      $SA1 = "Saving";
      $Your = $_SESSION['SavingID'];
      $Your2 = $_SESSION['LoanID'];
      $Choice = "Saving or Loan Account";
      $_SESSION['Z'] = $_SESSION['CheckingAC'];
     
     } elseif ($AccountChoose=='Loan') {
        $AC = $_SESSION['CheckingAC'];
        $AC1 = "Checking";
      $SA = $_SESSION['SavingAC'];
      $SA1 = "Saving";
      $_SESSION['Z'] = $_SESSION['LAN'];
      $Your = $_SESSION['SavingID'];
      $Your2 = $_SESSION['CheckingID'];
      $Choice = "Saving or Checking Account";
      
     } else {
       $AC = $_SESSION['LAN'];
       $AC1 = "Loan";
      $SA = $_SESSION['CheckingAC'];
      $SA1 = "Checking";
      $_SESSION['Z'] =  $_SESSION['SavingAC'];
     $Your = $_SESSION['SavingID'];
      $Your2 = $_SESSION['CheckingID'];
     $Choice = "Checking or Loan Account";
     }
     
       

        $Query = "SELECT * FROM dp428.accounts WHERE  Account!='$AccountChoose' AND ID='$Your' or ID='$Your2'";
          $QueryCon = mysqli_query($con,$Query);

             $SQL = "SELECT * FROM dp428.accounts where Account='$AccountChoose'";
     $SQLC = mysqli_query($con,$SQL);

      while ($rows=mysqli_fetch_array($SQLC)) {
      $STB = $rows['Budget'];
      $_SESSION['SourceBudget'] = $STB;
     }
      
			?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title></title>
     <?php if($color=='') { ?>
    <link rel="stylesheet" type="text/css" href="../CSS/CreatePortfolio.css"><?php } else {?>

    <link rel="stylesheet" type="text/css" href="../CSS/create<?php echo "$color"?>.css">
  <?php } ?>
    
</head>
<body>
    <header>
        
        <nav class="top-menu active">
        
            <div class="components">
            
                <div class="logo">
                    <a href=""><span>Transfer</span></a>
                </div>
                
                <ul class="navigation">
                    <li><a href="HomePage.php">Home</a></li>
                    <li><a href="CreateAccount.php">Create Account</a></li>
                    <li><a href="deposit.php">Deposit</a></li>
                    <li><a href="withdraw.php">Withdraw</a></li>
                   <?php if($color=='') { ?> <li><a href="" style="color: #37d72f">Transfer</a></li> <?php }else{ ?>
                    <li><a href="" style="color: <?php echo "$color"; ?>">Transfer</a></li> <?php } ?>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            
            </div>
        
        </nav>
    </header>

    <div class="banner">
    	<div class="box">

        <?php if(mysqli_num_rows($QueryCon)<1) {
          
          echo "<h1>You need to create a $Choice";
        } else { ?>

        <?php 
 
        if($STB<0) {
         ?>
        <h1>You Need To Deposit money into <?php echo "$AccountChoose"; ?><br>Deposit by clicking <a href="deposit.php" style="color: white;">here</a></h1><?php } else{ ?>
    		
    	 <h1>Select what account you want to transfer to</h1><br>

        <form action="transfer3.php" method="POST">

        <div class="custom-select" style="width:200px;">
       <select name="AccountD">
          <option value="None">Choose Account</option>
          <?php 

          
          while($rows2 = mysqli_fetch_array($QueryCon)) {
            $price = number_format($rows2['Budget'],2);

           ?>
          <option value="<?php echo $rows2['Account']; ?>"><?php echo $rows2['Account']; echo ": <b>$$price</b>"; ?></option>
          <?php } ?>
        </select>
      </div><br>

      <input type="submit" name="submit" class="a" value="Continue">
    </form>
  <?php }} ?>
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