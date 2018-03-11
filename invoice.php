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
    $username=$_SESSION['username'];
    $firstName=$_SESSION['firstName'];
    $isDriver = $_SESSION['isDriver'];
    $firstname = $_SESSION['firstName'];
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>iBuzz - Main Page</title>
	<link href="images/Icon.ico" rel="icon" type="image/x-icon">
	<meta content="width=device-width, initial-scale=1" name="viewport">
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type"><!--<meta name="keywords" content="Easy Admin Panel Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />-->

	<script type="application/x-javascript">
	addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } 
	</script><!-- Bootstrap Core CSS -->
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
					<li class="menu-list">
						<a href="#"><i class="lnr lnr-user"></i> <span>User Accounts</span></a>
						<ul class="sub-menu-list">
							<li><a href="#">View Accounts</a></li>
							<li><a href="#">Add New Account</a></li>
							<li><a href="#">Edit Account</a></li>
							<li><a href="#">Delete Account</a></li>
						</ul>
					</li>
					<li class="menu-list">
						<a href="#"><i class="fa fa-users"></i> <span>Customer Data</span></a>
						<ul class="sub-menu-list">
							<li><a href="#">View Data</a></li>
							<li><a href="#">Add New Customer</a></li>
							<li><a href="#">Edit Customer</a></li>
							<li><a href="#">Delete Customer</a></li>
						</ul>
					</li>
					<li class="menu-list">
						<a href="#"><i class="lnr lnr-book"></i> <span>Invoices</span></a>
						<ul class="sub-menu-list">
							<li><a href="invoice.php">View Invoices</a></li>
							<li><a href="#">Add New Invoice</a></li>
							<li><a href="#">Edit Invoice</a></li>
							<li><a href="#">Delete Invoice</a></li>
						</ul>
					</li>
					<li><a href="#"><i class="lnr lnr-envelope"></i> <span>View Delivery Orders</span></a></li>
					<li><a href="#"><i class="fa fa-clipboard"></i> <span>View Debtor List</span></a></li>
					<li class="menu-list">
						<a href="#"><i class="fa fa-inbox"></i> <span>Inventory</span></a>
						<ul class="sub-menu-list">
							<li><a href="#">View Inventory</a></li>
							<li><a href="#">Add New Item</a></li>
							<li><a href="#">Edit Item</a></li>
							<li><a href="#">Remove Item</a></li>
						</ul>
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
									<a aria-expanded="false" class="dropdown-toggle" data-toggle="dropdown" href="#"></a>
									<div class="profile_img">
										<span style="background:url(images/1.jpg) no-repeat center"></span>
										<div class="user-name">
											<p></p>
											<p><?php echo $username ;?> <span><?php
											                                            if ($userid == 5){
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
										</div><i class="lnr lnr-chevron-down"></i> <i class="lnr lnr-chevron-up"></i>
										<div class="clearfix"></div>
									</div>
									<ul class="dropdown-menu drp-mnu">
										<li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
										<li><a href="#"><i class="fa fa-user"></i>Profile</a></li>
										<li><a href="sign-out.php"><i class="fa fa-sign-out"></i> Logout</a></li>
									</ul>
								</li>
								<li style="list-style: none; display: inline">
									<div class="clearfix"></div>
								</li>
							</ul>
						</div>
						<div class="social_icons"></div>
						<div class="clearfix"></div>
					</div>
				</div><!--notification menu end -->
			</div><!-- //header-ends -->
			<div id="page-wrapper">
				<h3 class="blank1">Invoices</h3>
				<hr>
				<div class="table-responsive">
					<div class="grid_3 grid_4">
						<table class="table table-striped table-bordered">
							<!-- Incoming Table -->
							<thead class="thead-inverse">
								<tr>
									<th>#</th>
									<th>Date</th>
									<th>Total Price</th><!--<th>Qty</th>-->
									<!--Show Stock Details when choosing more information
                                    <th>Stock Name</th>-->
									<th>Customer Name</th>
								</tr>
							</thead>
							<tbody>
								<?php
								                                        $servername = "localhost";
								                                        $username = "root";
								                                        $password = "";
								                                        $dbname = "fyp";
								                                        $con = new mysqli($servername, $username, $password, $dbname);

								                                        $sql = "SELECT a.invoiceID, a.date, a.totalPrice, b.customerName FROM invoice a, customer b WHERE a.customerID = b.customerID";
								                                        $result = mysqli_query($con, $sql);

								                                        if ($result->num_rows > 0) {
								                                            while ($row = mysqli_fetch_assoc($result)){

								                                            ?>
								<tr>
									<td><?php echo $row["invoiceID"] ?></td>
									<td><?php echo $row["date"] ?></td>
									<td><?php echo $row["totalPrice"] ?></td><!--<td><?php echo $row["itemQuantity01"] ?></td>-->
									<!--<td><?php echo $row["stockName"] ?></td>-->
									<td><?php echo $row["customerName"] ?></td>
								</tr><?php }
								                                      }
								                                  else{
								                                  echo "0 results";
								                                  ?>
								<tr>
									<td>Nope</td>
									<td>Didn't work</td>
									<td>Sorry Lol</td>
									<td>K bye</td>
								</tr><?php }?>
							</tbody>
						</table>
						<center>
							<p><a class="btn btn-primary" data-toggle="modal" href="#addInvoice">
							<span class="glyphicon glyphicon-user"></span> Add Invoice</a>
							<a class="btn btn-warning" data-toggle="modal" href="#editInvoice"><span class="glyphicon glyphicon-wrench"></span> Edit Invoice</a>
							<a class="btn btn-danger" data-toggle="modal" href="#removeInvoice"><span class="glyphicon glyphicon-remove"></span> Remove Invoice</a>
							<a class="btn btn-info" data-toggle="modal" href="#viewInvoice"><span class="glyphicon glyphicon-search"></span> View Invoice</a></p>
						</center>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-sm-12 col-lg-12" style="height:10px"></div><!--Add Invoice Modal-->
		<div class="container">
			<!-- Trigger the modal with a button -->
			<!-- Modal -->
			<div class="modal fade" id="addInvoice" role="dialog">
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
												<span class="glyphicon glyphicon-user"></span><strong>&nbsp; Add Invoice</strong>
											</div>
											<div class="panel-body">
												<center>
													<input class="btn btn-success" name="submitAdd" type="submit" value="Submit"> <input class="btn btn-info" name="reset" type="reset" value="Reset">
												</center>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-default" data-dismiss="modal" type="button">Close</button>
			</div>
		</div>
		<div class="col-xs-12 col-sm-12 col-lg-12" style="height:10px"></div><!--Edit Invoice Modal-->
		<div class="container">
			<!-- Trigger the modal with a button -->
			<!-- Modal -->
			<div class="modal fade" id="editInvoice" role="dialog">
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
												<span class="glyphicon glyphicon-wrench"></span><strong>&nbsp; Edit Invoice</strong>
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
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-default" data-dismiss="modal" type="button">Close</button>
			</div>
		</div>
		<div class="modal fade" id="removeInvoice" role="dialog">
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
											<span class="glyphicon glyphicon-remove"></span><strong>&nbsp; Remove Invoice</strong>
										</div>
										<div class="panel-body">
											<div class="row form-group">
												<!--Remove Invoice-->
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
		<div class="modal fade" id="viewInvoice" role="dialog">
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
										<div class="panel-heading text-center" style="color: #fff; background-color: #5bc0de;">
											<span class="glyphicon glyphicon-search"></span><strong>&nbsp; View Invoice</strong>
										</div>
										<div class="panel-body">
											<div class="row form-group">
											
											</div>
											<button class="btn btn-success" contenteditable="false" name="submitRemove" style="margin-left: 43%;" type="submit">Submit</button>
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