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
      $SQL = "SELECT * FROM dp428.user WHERE User='$user'";
      $connect = mysqli_query($con,$SQL);

       $LID = $_SESSION['LoanID'];
       $SID = $_SESSION['SavingID'];
       $CID = $_SESSION['CheckingID'];

        $Query = "SELECT * FROM dp428.accounts WHERE Account!='Loan' AND ID='$CID' OR ID='$SID'";
          $QueryCon = mysqli_query($con,$Query);

      while ($rows = mysqli_fetch_array($connect)) {
        $AN = $rows['Account_Number'];
        $UID = $rows['ID'];
        $_SESSION['UID'] = $UID;
        $_SESSION['Account'] = $AN;
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
    		
    	 <h1>Before we begin select what account you want to transfer from</h1><br>

        <form action="transfer2.php" method="POST">

        <div class="custom-select" style="width:200px;">
        <select name="Account">
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