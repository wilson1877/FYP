<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php
include "config.php";
if(isset($_SESSION["userID"]) && !empty($_SESSION["userID"])) {
	$inputtedID = $_REQUEST['selectedID'];
    $_SESSION['inputtedID'] = $_REQUEST['selectedID'];
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>iBuzz - Audit View</title>
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
		//new WOW().init();
		var nextItem = 1;

		function additem(){
			document.getElementById("items").innerHTML += "  <label>Item "+ (nextItem+1) +"\ Name:</label> <input type=\"text\" list=\"itemList\" name=\"itemName[" +nextItem+ "]\" id=\"itemName[" +nextItem+ "]\" class=\"form-control1 control3\">  <label>Item "+(nextItem+1)+"\ Quantity:</label> <input type=\"text\" name=\"itemQuantity[" +nextItem+ "]\" id=\"itemQuantity[" +nextItem+ "]\" class=\"form-control1 control3\">"
			nextItem += 1;

			return false;
		};
	</script>
	<style>
		.pagination{
			display: flex;
			justify-content: center;

		}
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
	       background-color: #fcffa4;
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

		.selected {
			background-color: brown;
			color: #FFF;
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
					<li><a href="#"><i class="fa fa-clipboard"></i> <span>View Debtor List</span></a></li>
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
				<h3 class="blank1">Customer Audit Record: <?php 
				$sql3 = "SELECT customerName, companyName FROM customer WHERE customerID = '$inputtedID'";
				$result3 = mysqli_query($con, $sql3);
				if ($result3->num_rows > 0) {
					while ($row3 = mysqli_fetch_assoc($result3)){
						$customerName = $row3["customerName"];
						$companyName = $row3["companyName"];
					}
				}
											echo $customerName?> (<?php echo $companyName ?>)</h3>
				<hr>
				<?php
				$sql = "SELECT * FROM creditdebit WHERE customerID = $inputtedID";

				$result = mysqli_query($con, $sql);

				if (mysqli_num_rows($result) > 0){
					$resultArray = mysqli_fetch_assoc($result);
				?>
					<div class="grid_3 grid_4">
						<script>
							function selectInvoice(invoiceID){
								var selectedIDInput = document.getElementById("selectedID");
								var previously_selected = document.getElementById("Srow"+selectedIDInput.value);
								if (previously_selected != null ){
									previously_selected.style.backgroundColor = "";
								}
								selectedIDInput.value = invoiceID;
								document.getElementById("Srow"+invoiceID).style.backgroundColor = "lightcyan";
							}
						</script>
						<table id="myTable" class="table table-striped table-bordered">
							<!-- Incoming Table -->
							<thead class="thead-inverse">
								<tr>
									<th>#</th>
									<th>Date</th>
									<th>Invoice ID</th>
									<th>Debit</th>
									<th>Credit</th>
									<th>Balance ($)</th>
								</tr>
							</thead>
							<form id="actionSender">
								<input type="hidden" id="selectedID" name="selectedID" value="0"/>
							</form>
							<tbody>
								<?php
								$oldCustomerID = "";
								$grandtotal = 0.00;
								$sql = "SELECT * FROM creditdebit WHERE customerID = '$inputtedID'";
								$result = mysqli_query($con, $sql); //Getting 
								
								if ($result->num_rows > 0) {
								while ($row = mysqli_fetch_assoc($result)){
									$oldCustomerID = $row["customerID"]; //Puts the existing Customer ID in
						
									//Calculating Total Balance
									$cusID = $row["customerID"];
									$sql2 = "SELECT debit FROM creditdebit WHERE customerID = '$cusID'";
									$result2 = mysqli_query($con, $sql2);
									if ($result2->num_rows > 0) {
											$grandtotal += $row["debit"];
									}
									?>
									<tr>
										<td><?php echo $row["ID"] ?></td>
										<td><?php echo $row["date"] ?></td>
										<td><?php echo $row["invoiceID"] ?></td>
										<td><?php echo $row["debit"] ?></td>
										<td><!--<?php echo $row["credit"] ?>--></td>
										<td><?php echo number_format ((float)$grandtotal, 2, '.', '') ?></td>
									</tr>
									<?php 
									}
								}
								else{
								echo "0 results";
								?>
								<tr>
									<td>Something crashed, everyone go home!</td>
								</tr><?php }?>
							</tbody>
						</table>
					</div>
				<?php
				}else{ ?>
					<h1>Customer ID not found!</h1>
					<hr>
					<p>How did you even get here?</p>
				<?php } ?>
				<center>
					<a href="creditdebit.php" class="btn btn-default"><span class="glyphicon glyphicon-backward"></span> Click here to return</a>
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
