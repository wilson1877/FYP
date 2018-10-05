<?php
//Customer Function
include "config.php";
include "customerInner.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>iBuzz - Customer Data</title>
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
	<link href="css/font-awesome.css" rel="stylesheet">

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
	        new WOW().init();

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
				<h3 class="blank1">Customer Data</h3>
				<hr>
				<div class="table-responsive">
					<div class="grid_3 grid_4">
						<script>
							function selectCustomer(customerID){
								var selectedIDInput = document.getElementById("selectedID");
								var previously_selected = document.getElementById("Srow"+selectedIDInput.value);
								if (previously_selected != null ){
									previously_selected.style.backgroundColor = "";
//									previously_selected.classList.remove("table-selected");
								}
								selectedIDInput.value = customerID;
								document.getElementById("Srow"+customerID).style.backgroundColor = "lightcyan";
							}
						</script>
						<table id="myTable" class="table table-striped table-bordered">
							<!-- Incoming Table -->
							<thead class="thead-inverse">
								<tr>
									<th>#</th>
									<th>Customer Name</th>
									<th>Company Name</th>
									<th>Contact Number</th>
                                    <th>Fax Number</th>
									<th>Email Address</th>
									<th>Delivery Address</th>
								</tr>
							</thead>
							<form id="actionSender">
								<input type="hidden" id="selectedID" name="selectedID" value="0"/>
							</form>
							<tbody>
								<?php
								$servername = "localhost";
								$username = "root";
								$password = "";
								$dbname = "fyp";
								$con = new mysqli($servername, $username, $password, $dbname);
								$sql = "SELECT customerID, customerName, companyName, contactNumber, faxNumber, emailAddress, address FROM customer ORDER BY customerID DESC";
								$result = mysqli_query($con, $sql);
								if ($result->num_rows > 0) {
									while ($row = mysqli_fetch_assoc($result)){
								?>
								<tr onclick="selectCustomer(<?php echo $row["customerID"]?>)" id="Srow<?php echo $row["customerID"]?>">
									<td><?php echo $row["customerID"] ?></td>
									<td><?php echo $row["customerName"] ?></td>
									<td><?php echo $row["companyName"] ?></td>
                                    <td><?php echo $row["contactNumber"] ?></td>
									<td><?php echo $row["faxNumber"] ?></td>
									<td><?php echo $row["emailAddress"] ?></td>
									<td><?php echo $row["address"] ?></td>
								</tr>
								<?php }
								}
								else{
								echo "0 results";
								?>
								<tr>
                                    <td>No data</td>
									<td>No data</td>
									<td>No data</td>
									<td>No data</td>
                                    <td>No data</td>
									<td>No data</td>
									<td>No data</td>
								</tr><?php }?>
							</tbody>
						</table>
						<center>
							<p><a class="btn btn-primary" data-toggle="modal" href="#addCustomer">
							<span class="glyphicon glyphicon-user"></span> Add Customer</a>
							<a href="#" onClick="editCustomer()" class="btn btn-warning" contenteditable="false" name="editCustomer"><span class="glyphicon glyphicon-wrench"></span> Edit Customer</a>
							<a href="#" onClick="removeCustomer()" class="btn btn-danger" contenteditable="false" name="removeCustomer"><span class="glyphicon glyphicon-remove"></span> Delete Customer</a>
							<!--<a class="btn btn-info" data-toggle="modal" href="#viewInvoice"><span class="glyphicon glyphicon-search"></span> View Invoice</a></p>-->
							<a href="#" onClick="viewCustomer()" class="btn btn-info" contenteditable="false" name="customerView"><span class="glyphicon glyphicon-search"></span> View Customer</a></p>

							<script>
							function editCustomer(){
								if (document.getElementById("selectedID").value < 1 ){
									alert("No customer selected");
								}
								else {
									var theform = document.getElementById("actionSender");
									theform.action="editCustomer.php";
									theform.submit()
								}
							}

							function removeCustomer(){
								if (document.getElementById("selectedID").value < 1 ){
									alert("No customer selected");
								}
								else {
									if (confirm('Deleting Customer Record. Are you sure?')){
										var theform = document.getElementById("actionSender");
										theform.action="deleteCustomer.php";
										theform.submit()
									}
								}
							}

							function viewCustomer(){
								if (document.getElementById("selectedID").value < 1 ){
									alert("No customer selected");
								}
								else {
									var theform = document.getElementById("actionSender");
									theform.action="viewCustomerData.php";
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
		<div class="col-xs-12 col-sm-12 col-lg-12" style="height:10px"></div><!--Add Invoice Modal-->
		<div class="container">
			<!-- Trigger the modal with a button -->
			<!-- Modal -->
			<div class="modal fade" id="addCustomer" role="dialog">
				<div class="modal-dialog modal-lg">
					<!-- Modal content-->
					<div class="modal-content">
						<button class="close" data-dismiss="modal" type="button">&times;</button>
							<div class="modal-body">
								<!--Content-->
								<div class="container" style="width: 100%">
									<form action="" class="custom-form-horizontal" data-toggle="validator" method="post" role="form">
										<div class="panel-group">
											<div class="panel panel-default">
												<div class="panel-heading text-center" style="color: #fff; background-color: rgb(51, 122, 183);">
													<span class="glyphicon glyphicon-user"></span><strong>&nbsp; Add Customer</strong>
												</div>
                                                <div class="panel-body">
												<form action="" method="post">
                          <?php
													$servername = "localhost";
													$username = "root";
													$password = "";
													$dbname = "fyp";
													$con = new mysqli($servername, $username, $password, $dbname);

													$sql = "SELECT * FROM customer";
													$result = mysqli_query($con, $sql);
													?>
													<label>Customer Name: </label>
													<input type="text" id="customerName" name="customerName" class="form-control1 control3">
													<label>Company Name: </label>
													<input type="text" id="companyName" name="companyName" class="form-control1 control3">
                          <label>Contact Number: </label>
													<input type="text" id="contactNumber" name="contactNumber" class="form-control1 control3">
													<label>Customer Fax No:</label>
													<input type="text" id="customerFaxNo" name="customerFaxNo" class="form-control1 control3">
                          <label>Email Address: </label>
													<input type="text" id="emailAddress" name="emailAddress" class="form-control1 control3">
                          <label>Delivery Address: </label>
													<!--<input type="text" id="address" name="address" class="form-control1 control3">-->
													<textarea class="form-control" rows="2" name="address" id="address"></textarea>
													<br>
													<center>
														<input class="btn btn-success" name="submitAdd" type="submit" value="Submit">
                            <input class="btn btn-info" name="reset" type="reset" value="Reset">
													</center>
												</form>
												</div>
											</div>
										</div>


									</form>
								</div>
							</div>
						<div class="modal-footer">
							<button class="btn btn-default" data-dismiss="modal" type="button">Close</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-sm-12 col-lg-12" style="height:10px"></div><!--Edit Customer Modal-->
		<div class="container">
			<!-- Trigger the modal with a button -->
			<!-- Modal -->
			<div class="modal fade" id="editCustomer" role="dialog">
				<div class="modal-dialog modal-lg">
					<!-- Modal content-->
					<div class="modal-content">
						<button class="close" data-dismiss="modal" type="button">&times;</button>
						<div class="modal-body">
							<!--Content-->
							<div class="container" style="width: 100%">
								<form action="" class="custom-form-horizontal" data-toggle="validator" method="post" role="form">
									<div class="panel-group">
										<div class="panel panel-default">
											<div class="panel-heading text-center" style="color: #fff; background-color: #06d995;">
												<span class="glyphicon glyphicon-wrench"></span><strong>&nbsp; Edit Customer</strong>
											</div>
											<div class="panel-body">
												<center>
													<input class="btn btn-success" name="submitEdit" type="submit" value="Submit"> <input class="btn btn-info" name="reset" type="reset" value="Reset">
												</center>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
						<div class="modal-footer">
							<button class="btn btn-default" data-dismiss="modal" type="button">Close</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="removeCustomer" role="dialog">
			<div class="modal-dialog modal-md">
				<!-- Modal content-->
				<div class="modal-content">
					<button class="close" data-dismiss="modal" type="button">&times;</button>
					<div class="modal-body">
						<!--Content-->
						<div class="container" style="width: 100%">
							<form action="" class="custom-form-horizontal" data-toggle="validator" method="post" role="form">
								<div class="panel-group">
									<div class="panel panel-default">
										<div class="panel-heading text-center" style="color: #fff; background-color: #d9534f;">
											<span class="glyphicon glyphicon-remove"></span><strong>&nbsp; Delete Customer</strong>
										</div>
										<div class="panel-body">
											<div class="row form-group">
												<!--Remove Customer-->
											</div><!--Remove Submit Button-->
											<button class="btn btn-danger" contenteditable="false" name="submitRemove" style="margin-left: 43%;" type="submit">Submit</button>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
					<div class="modal-footer">
						<button class="btn btn-default" data-dismiss="modal" type="button">Close</button>
					</div>
				</div>
			</div>
		</div>
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
