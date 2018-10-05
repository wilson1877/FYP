<?php
//First, show a list of clients which show the grand total
//Option 1 = Select a row and choose 'Paid' (Give user option to choose if deduct from balance)
//Option 2 = Write amount of money paid

include "config.php";
include "invoiceinner.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>iBuzz - Debtor Listing</title>
	<link href="images/Icon.ico" rel="icon" type="image/x-icon">
	<meta content="width=device-width, initial-scale=1" name="viewport">
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type"><!--<meta name="keywords" content="Easy Admin Panel Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />-->

	<script type="application/x-javascript">
	addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); }
	</script><!-- Bootstrap Core CSS -->
	<!-- Latest compiled and minified CSS -->

	
	<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css'><!-- Custom CSS -->
	<link href="css/style.css" rel='stylesheet' type='text/css'><!-- Graph CSS -->
	<link href="css/font-awesome.css" rel="stylesheet"><!-- jQuery -->
	
	<script src="js/jquery-1.10.2.min.js">
	</script><!-- Placed js at the end of the document so the pages load faster -->
	<script type="text/javascript" src="js/paginathing.js"></script>
	<!-- lined-icons -->
	<link href="css/icon-font.min.css" rel="stylesheet" type='text/css'><!-- //lined-icons -->
	<!-- chart -->

	<script src="js/Chart.js">
	</script><!-- //chart -->
	<!--animate-->
	<link href="css/animate.css" media="all" rel="stylesheet" type="text/css">
	<!-- Bootstrap Select -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
	
	<script src="js/wow.min.js">
	</script>
	<script>
	        //new WOW().init();
			
			//Pagination
			jQuery(document).ready(function($){
				$('.table tbody').paginathing({
				  perPage: 10,
				  insertAfter: '.table',
				  pageNumbers: true
				});
			});

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

	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>

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
					<li><a href="delivery.php"><i class="fa fa-folder"></i> <span>View Deliveries</span></a></li>
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
				<h3 class="blank1">Debtor Listing</h3>
				<hr>
				<div class="table-responsive">
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
									<!--<th>Date</th>-->
									<th>Customer Name</th>
									<th>Company Name</th>
									<th>Contact Number</th>
									<th>Balance ($)</th>
								</tr>
							</thead>
							<form id="actionSender">
								<input type="hidden" id="selectedID" name="selectedID" value="0"/>
							</form>
							<tbody>
								<?php
								$oldCustomerID = "";
								$sql = "SELECT * FROM creditdebit ORDER BY customerID DESC";
								$result = mysqli_query($con, $sql);
								if ($result->num_rows > 0) {
									while ($row = mysqli_fetch_assoc($result)){
										
										if ($oldCustomerID != $row["customerID"]){ //If the ID is different, run function
											$oldCustomerID = $row["customerID"]; //Puts the existing Customer ID in
								
											//Calculating Total Balance
											$grandtotal = 0.00;
											$cusID = $row["customerID"];
											$sql2 = "SELECT debit, credit FROM creditdebit WHERE customerID = '$cusID'";
											$result2 = mysqli_query($con, $sql2);
											if ($result2->num_rows > 0) {
												while ($row2 = mysqli_fetch_assoc($result2)){
													if ($row2["debit"] > 0){
													$grandtotal += $row2["debit"];
													//$grandtotal += 0.01;
													}else{
														$grandtotal -= $row2["credit"];
													}
												}
											}
											
											//Retrieving Customer Details
											$sql3 = "SELECT customerName, companyName, contactNumber FROM customer WHERE customerID = '$cusID'";
											$result3 = mysqli_query($con, $sql3);
											if ($result3->num_rows > 0) {
												while ($row3 = mysqli_fetch_assoc($result3)){
													$customerName = $row3["customerName"];
													$companyName = $row3["companyName"];
													$contactNumber = $row3["contactNumber"];
												}
											}
									?>
										<?php if ($grandtotal > 0){ ?>	
											<tr onclick="selectInvoice(<?php echo $row["customerID"]?>)" id="Srow<?php echo $row["customerID"]?>">
												<td><?php echo $row["ID"] ?></td>
												<!--<td><?php echo $row["date"] ?></td>-->
												<td><?php echo $customerName ?></td>
												<td><?php echo $companyName ?></td>
												<td><?php echo $contactNumber ?></td>
												<td><?php echo number_format ((float)$grandtotal, 2, '.', '') ?></td>
											</tr>
										<?php } ?>
											
										<?php }
										}
								}
								else{
								echo "0 results";
								?>
								<tr>
									<td>Don't remove me nooo</td>
									<td>We have children to feed</td>
									<td>And people to see</td>
									<td>It's been a long time after all</td>
									<td>So cry while it's empty</td>
								</tr><?php }?>
							</tbody>
						</table>
						<center>
							<p><a href="#" onClick="editAudit()" class="btn btn-primary" contenteditable="false" name="editAudit">
							<span class="glyphicon glyphicon-user"></span> View Details</a>
							<script>
							function editAudit(){
								if (document.getElementById("selectedID").value < 1 ){
									alert("Please select a row!");
								}
								else {
									var theform = document.getElementById("actionSender");
									theform.action="creditdebitview.php";
									theform.submit()
								}
							}
							</script>

							<!--<button class="btn btn-success" contenteditable="false" name="invoiceView" style="margin-left: 43%;" type="submit">Submit</button>-->
						</center>
					</div>
				</div>
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

