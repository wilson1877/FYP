<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php
include "config.php";
//include "creditdebitviewinner.php";

if(isset($_SESSION["userID"]) && !empty($_SESSION["userID"])) {
	$inputtedID = $_REQUEST['selectedID'];
    $_SESSION['inputtedID'] = $_REQUEST['selectedID'];
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>iBuzz - Debtor View</title>
	<link href="images/Icon.ico" rel="icon" type="image/x-icon">
	<meta content="width=device-width, initial-scale=1" name="viewport">

	<script type="application/x-javascript">
	addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); }
	</script><!-- Bootstrap Core CSS -->
	
	<script src="js/jquery-1.10.2.min.js">
	</script>
	
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
	
	<script type="text/javascript">
		//new WOW().init();
		$(document).ready(function(){
			$("#btn_submit").click(function(){ //Submit button
				//alert("lol");
				var creditAmt = $("#txt_creditAmt").val().trim();
				var notes = $("#txt_notes").val().trim();
				var inputtedID = $("#inputtedID").val().trim();
		
				if(creditAmt != "" && notes != "" ){
					
					$.ajax({ //Validation without requiring to refresh
						url:'creditdebitviewinner.php',
						type:'post',
						data:{creditAmt:creditAmt,notes:notes,inputtedID:inputtedID},
						success:function(response){
							var msg = "";
							if(response == 1){ //Success! Refresh the page with the Selected ID!
								//window.location = "creditdebitview.php";
								
								document.getElementById("selectedID").value = inputtedID;
								
								var theform = document.getElementById("actionSender");
								theform.action="creditdebitview.php";
								theform.submit()
							}else{
								msg = "Something went wrong, oops!";
							}
							$("#message").html(msg); //Sends message to screen
						}
					});
				}else{
					msg = "Please fill the required fields!";
					$("#message").html(msg);
				}
			});
			
			//Don't allow Negative on Number Input
			var number = document.getElementById('txt_creditAmt');

			// Listen for input event on numInput.
			number.onkeydown = function(e) {
				if(!((e.keyCode > 95 && e.keyCode < 106)
				  || (e.keyCode > 47 && e.keyCode < 58) 
				  || e.keyCode == 8)) {
					return false;
				}
			}
			});
		
		
	</script>

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
		#message{
			width:100%;
			text-align:center;
			color:red;
			padding-bottom:10px;
		}
	</style><!--//end-animate-->
	<!--==webfonts=-->
	<link href='//fonts.googleapis.com/css?family=Cabin:400,400italic,500,500italic,600,600italic,700,700italic' rel='stylesheet' type='text/css'><!---//webfonts=-->
	<!-- Meters graphs -->

	
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
				<h3 class="blank1">Customer Debt Record: <?php 
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
									<th>Notes</th>
								</tr>
							</thead>
								<form id="actionSender">
								<input type="hidden" id="selectedID" name="selectedID" value="<?php echo $inputtedID ?>"/>
								</form>
									<input type="hidden" id="inputtedID" name="inputtedID" value="<?php echo $inputtedID ?>"/>
								
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
										if ($row["debit"] > 0){
											$grandtotal += $row["debit"];
										}else{
											$grandtotal -= $row["credit"];
										}
									}
									?>

										<?php if ($row["debit"] > 0){?>
										<tr>
											<td><?php echo $row["ID"] ?></td>
											<td><?php echo $row["date"] ?></td>							
											<td><?php echo $row["invoiceID"] ?></td>
											<td><?php echo $row["debit"] ?></td>
											<td></td>
											<td><?php echo number_format ((float)$grandtotal, 2, '.', '') ?></td>
											<td><?php echo $row["notes"] ?></td>
										<?php }else if ($row["credit"] > 0){?>
										<tr onclick="selectInvoice(<?php echo $row["ID"]?>)" id="Srow<?php echo $row["ID"]?>">
											<td style="font-weight: bold;color:#0cb514"><?php echo $row["ID"] ?></td>
											<td style="font-weight: bold;color:#0cb514"><?php echo $row["date"] ?></td>
											<td style="font-weight: bold;color:#0cb514"></td>
											<td style="font-weight: bold;color:#0cb514"></td>
											<td style="font-weight: bold;color:#0cb514"><?php echo $row["credit"] ?></td>
											<td style="font-weight: bold;color:#0cb514"><?php echo number_format ((float)$grandtotal, 2, '.', '') ?></td>
											<td style="font-weight: bold;color:#0cb514"><?php echo $row["notes"] ?></td>
										<?php }?>
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
					<a class="btn btn-primary" data-toggle="modal" href="#addCredit">
					<span class="glyphicon glyphicon-user"></span> Add Credit</a>
					<a href="#" onClick="removeInvoice()" class="btn btn-danger" contenteditable="false" name="removeInvoice"><span class="glyphicon glyphicon-remove"></span> Delete Credit</a>
					<a href="creditdebit.php" class="btn btn-default"><span class="glyphicon glyphicon-backward"></span> Click here to return</a>
				</center>
				<script>
				function removeInvoice(){
					if (document.getElementById("selectedID").value < 1 ){
						alert("No Invoice selected");
					}
					else {
						if (confirm('Deleting Credit Row. Are you sure?')){
							var theform = document.getElementById("actionSender");
							theform.action="deletecreditdebit.php";
							theform.submit()
						}
					}
				}
				</script>
			</div>
		</div>
		<!-- //switches -->
		<div class="col_1">
			<div class="clearfix"></div>
		</div><!--body wrapper start-->
		<!--body wrapper end-->
		<div class="container">
			<!-- Trigger the modal with a button -->
			<!-- Modal -->
			<div class="modal fade" id="addCredit" role="dialog">
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
											<span class="glyphicon glyphicon-user"></span><strong>&nbsp; Add Credit</strong>
										</div>
										<div class="panel-body">
										<div id="message"></div>
										<form action="" method="post">
											<label>Credit Amount:</label>
											<input type="number" min="0" step="0.01" required name="txt_creditAmt" id="txt_creditAmt" class="form-control1 control3">
											<label>Notes:</label>
											<input type="text" required name="txt_notes" id="txt_notes" class="form-control1 control3">
											<div class="clearfix"> </div>
												<span id="row1" />
											</div>
											<center>
												<!--<input class="btn btn-success" name="submitAdd" type="submit" value="Submit">-->
												<a class="btn btn-success" name="btn_submit" id="btn_submit" type="button" value="Submit">Submit</a>
												<input class="btn btn-info" name="reset" type="reset" value="Reset">
											</center>
										</form>
										</div>
									
								</div>
						</div>
						</form>
						<div class="modal-footer">
							<button class="btn btn-default" data-dismiss="modal" type="button">Close</button>
						</div>
					</div>
				</div>
		</div>
	</div>
		</div>
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
