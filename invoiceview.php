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
	$_SESSION['inputtedID'] = $_REQUEST['selectedID'];
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>iBuzz - Invoices</title>
	<link href="images/Icon.ico" rel="icon" type="image/x-icon">
	<meta content="width=device-width, initial-scale=1" name="viewport">
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type"><!--<meta name="keywords" content="Easy Admin Panel Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />-->

	<script type="application/x-javascript">
	addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); }
	</script><!-- Bootstrap Core CSS -->
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>

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

			var nextItem = 1;

			function additem(){
                document.getElementById("items").innerHTML += "  <label>Item "+ (nextItem+1) +"\ Name:</label> <input type=\"text\" list=\"itemList\" name=\"itemName[" +nextItem+ "]\" id=\"itemName[" +nextItem+ "]\" class=\"form-control1 control3\">  <label>Item "+(nextItem+1)+"\ Quantity:</label> <input type=\"text\" name=\"itemQuantity[" +nextItem+ "]\" id=\"itemQuantity[" +nextItem+ "]\" class=\"form-control1 control3\">"
                nextItem += 1;

                return false;
            };
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
	       background-color: #000000;
	   }
	   .btn-info {
	       padding: 6px 12px;
	   }
	   textarea {
			resize: none;
	   }
	</style><!--//end-animate-->
	<!--==webfonts=-->
	<link href='//fonts.googleapis.com/css?family=Cabin:400,400italic,500,500italic,600,600italic,700,700italic' rel='stylesheet' type='text/css'><!---//webfonts=-->
	<!-- Meters graphs -->

	<script src="js/jquery-1.10.2.min.js">
	</script><!-- Placed js at the end of the document so the pages load faster -->
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
				<h3 class="blank1">Invoice View #<?php echo $inputtedID ?></h3>
				<hr>
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
					<p><h2><b><?php echo $resultArray["companyName"] ?></b></h2></p>
					<p><h3><b>Contact:</b> <?php echo $resultArray["customerName"] ?></h3></p>
					<p><h3><b>Purchase Order No.:</b> <?php echo $resultArray["purchaseOrderNo"] ?></h3></p>
					<hr>
					<p><h4><b>Tel.No:</b> <?php echo $resultArray["contactNumber"] ?></h4></p>
					<p><h4><b>Invoice Date:</b> <?php echo $resultArray["date"] ?></h4></p>
					<hr>
					<p><h2>Items Ordered: </h2></p>
					<table class="table table-bordered">
							<!-- Incoming Table -->
							<thead class="thead-inverse">
								<tr>
									<th><font color="#fff">#</font></th>
									<th><font color="#fff">Item</font></th>
									<th><font color="#fff">Unit Price</font></th>
									<th><font color="#fff">Quantity</font></th>
									<th><font color="#fff">Amount</font></th>
								</tr>
							</thead>
					<?php
					$itemssql = "SELECT a.itemQty, b.stockName, b.price FROM invoiceitemlist a INNER JOIN stock b ON a.stockID = b.stockID WHERE a.invoiceID = '$inputtedID'";
					$itemsresult = mysqli_query($con, $itemssql);
					$counter = 0;
					while($row = mysqli_fetch_array($itemsresult)) {
						$itemQty = $row["itemQty"];
						$itemPrice = $row["price"];
						$individualPrice = $itemQty * $itemPrice;
						$counter += 1;
						
						$individualPriceDecimal = number_format($individualPrice,2);
						?>
						<!--<p><h4><b>Item:</b> <?php echo $row["stockName"] ?></h4></p>
						<p><h4><b>Quantity:</b> <?php echo $row["itemQty"] ?></h4></p>
						<p><h4><b>Total Price:</b> $<?php echo $individualPrice ?></h4></p>-->
							<tbody>
								<tr>
									<td><?php echo $counter ?></td>
									<td><?php echo $row["stockName"] ?></td>
									<td>RM <?php echo $row["price"] ?></td>
									<td><?php echo $row["itemQty"] ?> pcs</td>
									<td>RM <?php echo $individualPriceDecimal ?></td>
								</tr>

					<?php } ?>
					<tr>
					<td colspan="5"><h3 align="right"><b>Grand Total:  </b> RM<?php echo $resultArray["totalPrice"] ?></h3></td>
					</tr>
					</tbody>
					</table>
						<hr>
					<!--<p><h2><b>Grand Total:</b> $<?php echo $resultArray["totalPrice"] ?></h2></p>-->
					<p><h4><b>Misc.Notes:</b> <?php echo $resultArray["miscNotes"] ?></h4></p>
					</div>
				<?php
				}else{ ?>
					<h1>Invoice not found!!</h1>
					<hr>
					<p>Ensure that you wrote the ID properly!</p>
				<?php } ?>
				<center>
					<a href="invoice.php" class="btn btn-default"><span class="glyphicon glyphicon-backward"></span> Click here to return</a>
					<a onclick="invoicePrint()" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> Print Invoice</a>
					<a onclick="doPrint()" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> Print Delivery Order</a>
					
					<script>
					function invoicePrint() {
						window.open("invoiceprint.php");
					}
					function doPrint() {
						window.open("doprint.php");
					}
					</script>
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
