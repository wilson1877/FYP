<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php
session_start();
if(isset($_SESSION["userID"]) && !empty($_SESSION["userID"])) {
    $userid=$_SESSION['userID'];
    $usernamedisplay=$_SESSION['username'];
    $firstName=$_SESSION['firstName'];
    $isDriver = $_SESSION['isDriver'];
    $firstname = $_SESSION['firstName'];
	//$inputtedID = $_POST['INPUTTEDID'];
    $inputtedID = $_REQUEST['selectedID'];
}

/*Getting Existing Data*/
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fyp";
$con = new mysqli($servername, $username, $password, $dbname);
				
$sqlcheck = "SELECT a.invoiceID, a.date, a.totalPrice, b.customerName, a.purchaseOrderNo, a.miscNotes FROM invoice a, customer b WHERE a.invoiceID = '$inputtedID' AND a.customerID = b.customerID";
$getquery = mysqli_query($con, $sqlcheck);

if (mysqli_num_rows($getquery) > 0){
	$resultArray = mysqli_fetch_assoc($getquery);
	
	$customerNameold = $resultArray['customerName'];
	$dateold = $resultArray['date'];
	$totalPriceold = $resultArray['totalPrice'];
	$purchaseOrderNoold = $resultArray['purchaseOrderNo'];
	$miscNotesold = $resultArray['miscNotes'];
}

if (isset($_POST['submitEdit'])) {

	//if (isset($_POST['myCheck'])){ //Fill in the field with dropdown if checkbox is checked
	//	$customerName = $_POST['customerName'];
	//}else{
		$customerName = $_POST['customerNameDrop'];
	//}
	
	$purchaseOrderNo = $_POST['purchaseOrderNo'];
	$invoiceDate = $_POST['invoiceDate'];
	$miscNotes = $_POST['miscNotes'];

	
	
	$sqlcheckidnumber = "SELECT customerID FROM customer WHERE customerName = '$customerName'"; 
	$runquery = mysqli_query($con, $sqlcheckidnumber);
		
	if ($runquery -> num_rows > 0) {
		
		//Name found!
		$resultArray = mysqli_fetch_assoc($runquery);
		$customerID = $resultArray["customerID"];
		$totalPrice = 0;

		//Adding New Customer

		//$sqlinsert = "INSERT INTO invoice(totalPrice, customerID, miscNotes, purchaseOrderNo) VALUES ('$totalPrice', '$customerID', '$miscNotes', '$purchaseOrderNo')";
		//$con -> query($sqlinsert);
		
		$sqledit = "UPDATE invoice SET totalPrice = '$totalPrice', customerID = '$customerID', miscNotes = '$miscNotes', purchaseOrderNo = '$purchaseOrderNo' WHERE invoiceID = '$inputtedID'";
		$con -> query($sqledit);
		
		//$invoiceID = $con->insert_id;
		
		//Wiping out the database list from invoiceitemlist
		$deleteRecord = "DELETE FROM invoiceitemlist WHERE invoiceID = '$inputtedID'";
		$con -> query($deleteRecord);

		foreach($_POST['itemName'] as $index => $itemName ) {
			if ($itemName){
				$sqlcheckItemName = "SELECT stockID, price FROM stock WHERE stockName = '$itemName'";
				$runquery2 = mysqli_query($con, $sqlcheckItemName);

				if (mysqli_num_rows($runquery2) > 0){
					$resultArray = mysqli_fetch_assoc($runquery2);

					$stockID = $resultArray["stockID"];
					$price = $resultArray["price"];

					$itemQuantity = $_POST["itemQuantity"][$index];

					$totalPrice += $price * $itemQuantity;
					
					$sqlinsert2 = "INSERT INTO invoiceitemlist(invoiceID, stockID, itemQty) VALUES ('$inputtedID', '$stockID', '$itemQuantity')";
					$con -> query($sqlinsert2);
				}
			}
		}
		
		$sqlUpdate = "UPDATE invoice SET totalPrice= '$totalPrice' WHERE invoiceID = '$inputtedID'";
		$con -> query($sqlUpdate);
		
		echo
		"<script>
		location.href='invoice.php';
		</script>";
	}

}

?>
<!DOCTYPE html>
<html>
<head>
	<title>iBuzz - Invoices</title>
	<link href="images/Icon.ico" rel="icon" type="image/x-icon">
	<meta content="width=device-width, initial-scale=1" name="viewport">
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type">

	<script type="application/x-javascript">
	addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); }
	</script><!-- Bootstrap Core CSS -->
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">

	<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css'><!-- Custom CSS -->
	<link href="css/style.css" rel='stylesheet' type='text/css'><!-- Graph CSS -->
	<link href="css/font-awesome.css" rel="stylesheet"><!-- jQuery -->
	<!-- lined-icons -->
	<link href="css/icon-font.min.css" rel="stylesheet" type='text/css'><!-- //lined-icons -->
	<!-- chart -->

	<script src="js/Chart.js">
	</script><!-- //chart -->
	<!--animate-->
	<link href="css/animate.css" media="all" rel="stylesheet" type="text/css">
	<script src="js/wow.min.js">
	</script>
	<script>
	        new WOW().init();

			var nextItem = 0;
			<?php
				$sql = "SELECT * FROM stock";
				$result = mysqli_query($con, $sql);
				$select_options = "";
				while($row = mysqli_fetch_array($result)) {
					$select_options .= "<option value=\"" . $row['stockName'] . "\">" . $row['stockName'] . "</option>\n";
			} ?>
			function additem(){
                document.getElementById("row"+(nextItem)).innerHTML += "<div class=\"row\" id=\"divrow"+(nextItem)+"\"> <div class=\"col-md-8 grid_box1\"> <label>Item Name:</label>" +
				 "<select name=\"itemName[]\" id=\"itemName[]\" class=\"form-control selectpicker\" data-live-search=\"true\">" + `<?php echo $select_options; ?>` +"</select> </div>" +
				 "<div class=\"col-md-2\"> <label>Item Quantity:</label>" +
				 "<input type=\"number\" name=\"itemQuantity[]\" id=\"itemQuantity[]\" class=\"form-control1 control3\"/> </div>" +
				 "<div class=\"col-md-2\"><div><div><button class=\"btn btn-danger invoice-padding\" onClick=\"return removeItemRow('divrow"+(nextItem)+"');\">Remove Row</button></div></div> </div>"+
				 "<div class=\"clearfix\"> </div></div><span id=\"row"+(nextItem+1)+"\"/>";
                nextItem += 1;

				$('.selectpicker').last().selectpicker({
      			});
                return false;
            };
			function removeItemRow(rowID){
				 var row = document.getElementById(rowID); // this gives you the row you want to remove
				 row.parentNode.removeChild(row); // this gets the html object that holds the row and tells it to remove said row
				 return false;
			}
	</script>
	<style>
	   .activity_box{
	       min-height: 285px;
	   }
	   .scrollbar{
	       height: 236px;
	   }
	   .scrollbar1{
	       height: 236px;
	   }
	   .thead-inverse th {
	       background-color: #e1ffda;
	   }
	   .btn-info {
	       padding: 6px 12px;
	   }
	   textarea {
			resize: none;
	   }
	   .invoice-padding{
			margin-top : 25px;
		}
	</style><!--//end-animate-->
	<!--==webfonts=-->
	<link href='//fonts.googleapis.com/css?family=Cabin:400,400italic,500,500italic,600,600italic,700,700italic' rel='stylesheet' type='text/css'><!---//webfonts=-->
	<!-- Meters graphs -->

	<script src="js/jquery-1.10.2.min.js">
	</script><!-- Placed js at the end of the document so the pages load faster -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>

	<script type="text/javascript">
		$('.selectpicker').selectpicker({
		});
	</script>

</head>
<body class="sticky-header left-side-collapsed" onload="initMap()">
	<section>
		<!-- left side start-->
		<div class="left-side sticky-left-side">
			<!--logo and iconic logo start-->
			<div class="logo">
				<h1><a href="dashboard.php">i <span>Buzz</span></a></h1>
			</div>
			<div class="logo-icon text-center">
				<a href="dashboard.php"><i class="lnr lnr-home"></i></a>
			</div><!--logo and iconic logo end-->
			<div class="left-side-inner">
				<!--sidebar nav start
                https://linearicons.com/free#cheat-sheet-->
				<ul class="nav nav-pills nav-stacked custom-nav">
					<li>
						<a href="userAccount.php"><i class="lnr lnr-user"></i> <span>User Accounts</span></a>
					</li>
					<li>
						<a href="customerData.php"><i class="fa fa-users"></i> <span>Customer Data</span></a>
					</li>
					<li>
						<a href="invoice.php"><i class="lnr lnr-book"></i> <span>Invoices</span></a>
					</li>
					<li><a href="creditdebit.php"><i class="fa fa-usd"></i> <span>View Debtor Listing</span></a></li>
					<li>
						<a href="inventory.php"><i class="fa fa-inbox"></i> <span>Inventory</span></a>
					</li>
					<li><a href="#"><i class="lnr lnr-car"></i> <span>View Online Map</span></a></li>
					<li><a href="#"><i class="fa fa-folder"></i> <span>View Deliveries</span></a></li>
				</ul><!--sidebar nav end-->
			</div>
		</div><!-- left side end-->
		<!-- main content start-->
		<div class="main-content">
			<!-- header-starts -->
			<div class="header-section">
				<!--toggle button start-->
				<a class="toggle-btn menu-collapsed"><i class="fa fa-bars"></i></a> <!--toggle button end-->
				 <!--notification menu start -->
         <div class="menu-right">
   				<div class="user-panel-top">
   					<div class="profile_details">
   						<ul>
   							<li class="dropdown profile_details_drop">
   								<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
   									<div class="profile_img">
   										<span style="background:url(images/1.jpg) no-repeat center"> </span>
   										 <div class="user-name">
   											<p><p><?php echo $usernamedisplay ;?><span>
   											<?php
   											if ($userid == 1){
   												echo 'Admin';
   											}
   											else {
   												if ($isDriver == 0){
   													echo 'Staff';
   												}
   												else {
   													echo 'Driver';
   												}
   											}
   											?></span></p>
   										 </div>
   										 <i class="lnr lnr-chevron-down"></i>
   										 <i class="lnr lnr-chevron-up"></i>
   										<div class="clearfix"></div>
   									</div>
   								</a>
   								<ul class="dropdown-menu drp-mnu">
   									<li> <a href="profile.php"><i class="fa fa-user"></i> Profile</a> </li>
   									<li> <a href="sign-out.php"><i class="fa fa-sign-out"></i> Logout</a> </li>
   								</ul>
   							</li>
   							<div class="clearfix"> </div>
   						</ul>
   					</div>
   					<div class="social_icons">
   					</div>
   					<div class="clearfix"></div>
   				</div>
   			  </div><!--notification menu end -->
			</div><!-- //header-ends -->
			<div id="page-wrapper">
				<h3 class="blank1">Editing Invoice #<?php echo $inputtedID ?> - <?php echo $customerNameold ?> [<?php echo $purchaseOrderNoold ?>]</h3>
				<hr>
				<form action="" class="custom-form-horizontal" data-toggle="validator" method="post" role="form">
				<?php
				$servername = "localhost";
				$username = "root";
				$password = "";
				$dbname = "fyp";
				$con = new mysqli($servername, $username, $password, $dbname);

				$sql = "SELECT a.*, b.* FROM invoice a, customer b WHERE a.invoiceID = '$inputtedID' AND a.customerID = b.customerID";

				$result = mysqli_query($con, $sql);

				if (mysqli_num_rows($result) > 0){
					$resultArray = mysqli_fetch_assoc($result);
				?>
					<div class="grid_3 grid_4">
					<label>Customer Name: </label>
					
					<?php
					$sql = "SELECT * FROM customer";
					$result = mysqli_query($con, $sql);
					?>
					<!--Dropdown list for Customer -->
					<p id="text2">
					<select class="selectpicker show-tick" data-live-search="true" name="customerNameDrop" id="customerNameDrop">
					<?php while($row = mysqli_fetch_array($result)) { 
						if ($row['customerName'] == $customerNameold){?>
							<option selected value="<?php echo $row['customerName']; ?>"><?php echo $row['customerName']; ?></option>
						<?php }else{ ?>
							<option value="<?php echo $row['customerName']; ?>"><?php echo $row['customerName']; ?></option>
						<?php }
					} ?>
					</select>
					</p>
					<!--<label>Customer is New: <input type="checkbox" name="myCheck" id="myCheck" onclick="myFunction()"> </label>-->
					<br>
					<p class="well" id="text" style="display:none">
					<label>Company Name:</label>
					<input type="text" id="companyName" name="companyName" class="form-control1 control3">
					<label>Customer Contact No:</label>
					<input type="text" id="customerContactNo" name="customerContactNo" class="form-control1 control3">
					<label>E-Mail Address:</label>
					<input type="text" id="customerEmail" name="customerEmail" class="form-control1 control3">
					<label>Company Address:</label>
					<input type="text" id="customerAddress" name="customerAddress" class="form-control1 control3">
				<br>
				</p>
					<label>Purchase Order No:</label>
					<input type="text" value="<?php echo $purchaseOrderNoold ?>" id="purchaseOrderNo" name="purchaseOrderNo" class="form-control1 control3">
					<hr>
					<label>Invoice Date:</label>
					<input type="text" value="<?php echo $dateold ?>" id="invoiceDate" name="invoiceDate" class="form-control1 control3">
					<hr>
					<p><h2>Items Ordered:</h2></p>
					<!-- loop here -->
					
					<div id="items" class="form-group">
							<?php
						
							$sqlgetItemList = "SELECT iit.*, stockName FROM invoiceitemlist iit INNER JOIN stock ON iit.stockID=stock.stockID WHERE invoiceID = '$inputtedID'";
							$result = mysqli_query($con, $sqlgetItemList);
							if ($result->num_rows > 0){
								$x = 0;
								echo "<script>window.nextItem = " . $result->num_rows . ";</script>";
								
								while ($row = mysqli_fetch_assoc($result)){ 
								?>
									<div class="row" id="row<?php echo $x; ?>">
										<input type="hidden" id="itemID[]" name="itemID[]" value="<?php echo $row['ID'] ?>" />
										<div class="col-md-<?php if ($x == 0 ) { echo 10; } else { echo 8; }; ?> grid_box1">
											<label>Item Name:</label>
											<select required id="itemName[]" name="itemName[]" class="form-control selectpicker" data-live-search="true" >
											<?php
												$sql = "SELECT * FROM stock";
												$result2 = mysqli_query($con, $sql);
												$select_options = "";
												while($row2 = mysqli_fetch_array($result2)) {
													
													echo "<option value=\"" . $row2['stockName'] . "\" ". ( $row['stockName'] == $row2['stockName'] ? "selected=\"selected\"" : "" ) . ">" . $row2['stockName'] . "</option>\n";
											} ?>
											</select>
										</div>
										<div class="col-md-2">
											<label>Item Quantity:</label>
											<input type="number" id="itemQuantity[]" name="itemQuantity[]" class="form-control1 control3"  value="<?php echo $row['itemQty'] ?>" />
										</div>
									<?php if ($x > 0 ) { ?>
										<div class="col-md-2">
													<button class="btn btn-danger invoice-padding" onClick="return removeItemRow('row<?php echo $x ?>');">Remove Row</button>
										</div>
									<?php } ?>
										<div class="clearfix"> </div>
									</div>
							<?php 
								$x += 1;
								}
							}?>
							<span id="row<?php echo $x ?>"/>
					</div>
					
					
					<button class="btn btn-normal" onclick="return additem()">Add Item</button>
					<br>
					<label>Notes:</label>
					<textarea class="form-control" rows="5" name="miscNotes" id="miscNotes"><?php echo $miscNotesold ?></textarea>
					<br>
					<center>
						<input class="btn btn-success" name="submitEdit" type="submit" value="Submit"> <input class="btn btn-info" name="reset" type="reset" value="Reset">
						<br>
					</center>
					</div>
					</form>
				<?php
				}else{ ?>
					<h1>Invoice not found!!</h1>
					<hr>
					<p>Ensure that you wrote the ID properly!</p>
				<?php } ?>
				<center>
					<a href="invoice.php" class="btn btn-default"><span class="glyphicon glyphicon-backward"></span> Click here to return</a>
				</center>
			</div>
		</div>
		<!-- //switches -->
		<div class="col_1">
			<div class="clearfix"></div>
		</div><!--body wrapper start-->
		<!--body wrapper end-->
		<!--footer section start-->
		<footer>
			<p>Copyright © iBuzz 2018</p>
		</footer><!--footer section end-->
		<!-- main content end-->
	</section>
	<script src="js/jquery.nicescroll.js">
	</script>
	<script src="js/scripts.js">
	</script> <!-- Bootstrap Core JavaScript -->

	<script src="js/bootstrap.min.js">
	</script>
</body>
</html>
