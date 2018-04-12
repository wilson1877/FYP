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
}
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fyp";
$con = new mysqli($servername, $username, $password, $dbname);
if (isset($_POST['submitAdd'])) {
		$customerName = $_POST['customerName'];
		$purchaseOrderNo = $_POST['purchaseOrderNo'];
		$miscNotes = $_POST['miscNotes'];
		if (isset($_POST['myCheck'])) {
			//Checking the associated Customer with their ID via Name
			$sqlcheckidnumber = "SELECT customerID FROM customer WHERE customerName = '$customerName'"; //Checking for duplicates
			$runquery = mysqli_query($con, $sqlcheckidnumber);
			if ($runquery -> num_rows <= 0) {
				//It's a new customer! Adding to the DB!
				$companyName=$_POST['companyName'];
				$customerContactNo=$_POST['customerContactNo'];
				$customerFaxNo=$_POST['customerFaxNo'];
				$customerEmail=$_POST['customerEmail'];
				$customerAddress=$_POST['customerAddress'];
				$sqlnewcustomerinsert = "INSERT INTO customer(customerName, companyName, contactNumber, faxNumber, emailAddress, address) VALUES ('$customerName', '$companyName', '$customerContactNo', '$customerFaxNo', '$customerEmail', '$customerAddress')";
				$con -> query($sqlnewcustomerinsert);
			}
		}
		$sqlcheckidnumber = "SELECT customerID FROM customer WHERE customerName = '$customerName'"; //Checking for duplicates
		$runquery = mysqli_query($con, $sqlcheckidnumber);
		if ($runquery -> num_rows > 0) {
			//Name found!
			$resultArray = mysqli_fetch_assoc($runquery);
			$customerID = $resultArray["customerID"];
			$totalPrice = 0;
			//Adding New Customer
			$currentDate = date("Y/m/d");
			$sqlinsert = "INSERT INTO invoice(totalPrice, customerID, miscNotes, purchaseOrderNo, date) VALUES ('$totalPrice', '$customerID', '$miscNotes', '$purchaseOrderNo', '$currentDate')";
			$con -> query($sqlinsert);
			$invoiceID = $con->insert_id;
			foreach($_POST['itemName'] as $index => $itemName ) {
				if ($itemName){
					$sqlcheckItemName = "SELECT stockID, price FROM stock WHERE stockName = '$itemName'";
					$runquery2 = mysqli_query($con, $sqlcheckItemName);
					//if ($runquery2 -> num_rows > 0){
					if (mysqli_num_rows($runquery2) > 0){
						$resultArray = mysqli_fetch_assoc($runquery2);
						$stockID = $resultArray["stockID"];
						$price = $resultArray["price"];
						/*var_dump($stockID);
						var_dump($price);*/
						$itemQuantity = $_POST["itemQuantity"][$index];
						$totalPrice += $price * $itemQuantity;
						$sqlinsert2 = "INSERT INTO invoiceitemlist(invoiceID, stockID, itemQty) VALUES ('$invoiceID', '$stockID', '$itemQuantity')";
						$con -> query($sqlinsert2);
					}
				}
			}
			$sqlUpdate = "UPDATE invoice SET totalPrice= '$totalPrice' WHERE invoiceID = '$invoiceID'";
			$con -> query($sqlUpdate);
		}else{
		}
	}
	if(isset($_POST['invoiceView'])){
		$inputtedID = $_POST['inputtedID'];
		$_SESSION['INPUTTEDID'] = $inputtedID;
		header('location:invoiceview.php');
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
                document.getElementById("items").innerHTML += "<div class=\"row\" id=\"row"+(nextItem+1)+"\"> <div class=\"col-md-8 grid_box1\"> <label>Item Name:</label>" +
				 "<input type=\"text\" list=\"itemList\" name=\"itemName[]\" id=\"itemName[]\" class=\"form-control1 control3\" /> </div>" +
				 "<div class=\"col-md-2\"> <label>Item Quantity:</label>" +
				 "<input type=\"text\" name=\"itemQuantity[]\" id=\"itemQuantity[]\" class=\"form-control1 control3\"/> </div>" +
				 "<div class=\"col-md-2\"><div><div><button class=\"btn btn-danger invoice-padding\" onClick=\"return removeItemRow('row"+(nextItem+1)+"');\">Remove Row</button></div></div> </div>"+
				 "<div class=\"clearfix\"> </div></div>";
                nextItem += 1;
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
				<h3 class="blank1">Invoices</h3>
				<hr>
				<div class="table-responsive">
					<div class="grid_3 grid_4">
						<script>
							function selectInvoice(invoiceID){
								var selectedIDInput = document.getElementById("selectedID");
								var previously_selected = document.getElementById("Srow"+selectedIDInput.value);
								if (previously_selected != null ){
									previously_selected.style.backgroundColor = "";
//									previously_selected.classList.remove("table-selected");
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
									<th>Total Price</th><!--<th>Qty</th>-->
									<!--Show Stock Details when choosing more information
                                    <th>Stock Name</th>-->
									<th>Customer Name</th>
									<th>Purchase Order No</th>
									<th>Misc. Notes</th>
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
								$sql = "SELECT a.invoiceID, a.date, a.totalPrice, b.customerName, a.purchaseOrderNo, a.miscNotes FROM invoice a, customer b WHERE a.customerID = b.customerID ORDER BY a.invoiceID DESC";
								$result = mysqli_query($con, $sql);
								if ($result->num_rows > 0) {
									while ($row = mysqli_fetch_assoc($result)){
								?>
								<tr onclick="selectInvoice(<?php echo $row["invoiceID"]?>)" id="Srow<?php echo $row["invoiceID"]?>">
									<td><?php echo $row["invoiceID"] ?></td>
									<td><?php echo $row["date"] ?></td>
									<td><?php echo $row["totalPrice"] ?></td>

									<td><?php echo $row["customerName"] ?></td>
									<td><?php echo $row["purchaseOrderNo"] ?></td>
									<td><?php echo $row["miscNotes"] ?></td>
								</tr>
								<?php }
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
							<a href="#" onClick="editInvoice()" class="btn btn-warning" contenteditable="false" name="editInvoice"><span class="glyphicon glyphicon-wrench"></span> Edit Invoice</a>
							<a href="#" onClick="removeInvoice()" class="btn btn-danger" contenteditable="false" name="removeInvoice"><span class="glyphicon glyphicon-remove"></span> Delete Invoice</a>
							<!--<a class="btn btn-info" data-toggle="modal" href="#viewInvoice"><span class="glyphicon glyphicon-search"></span> View Invoice</a></p>-->
							<a href="#" onClick="viewInvoice()" class="btn btn-info" contenteditable="false" name="invoiceView"><span class="glyphicon glyphicon-search"></span> View Invoice</a></p>

							<script>
							function editInvoice(){
								if (document.getElementById("selectedID").value < 1 ){
									alert("No Invoice selected");
								}
								else {
									var theform = document.getElementById("actionSender");
									theform.action="invoiceedit.php";
									theform.submit()
								}
							}
							function removeInvoice(){
								if (document.getElementById("selectedID").value < 1 ){
									alert("No Invoice selected");
								}
								else {
									if (confirm('Deleting Invoice. Are you sure?')){
										var theform = document.getElementById("actionSender");
										theform.action="deleteInvoice.php";
										theform.submit()
									}
								}
							}
							function viewInvoice(){
								if (document.getElementById("selectedID").value < 1 ){
									alert("No Invoice selected");
								}
								else {
									var theform = document.getElementById("actionSender");
									theform.action="invoiceview.php";
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

												<form action="" method="post">
													<!--<div class="alert alert-danger">
														Blablabla Error Message
													</div>-->
													<label>Customer Name: </label>
													<?php
													$servername = "localhost";
													$username = "root";
													$password = "";
													$dbname = "fyp";
													$con = new mysqli($servername, $username, $password, $dbname);
													$sql = "SELECT * FROM customer";
													$result = mysqli_query($con, $sql);
													?>
													<datalist id="customerList">
														<?php while($row = mysqli_fetch_array($result)) { ?>
															<option value="<?php echo $row['customerName']; ?>"><?php echo $row['customerName']; ?></option>
														<?php } ?>
													</datalist>

													<input type="text" required id="customerName" name="customerName" list="customerList" placeholder="Click on the drop down button to select existing customer" class="form-control1 control3">
													<!-- Button to Add New Customer Here if doesn't exist-->
													<!--More Customer Details
													<label>Address: </label>
													<input type="text" class="form-control1 control3">
													-->
													<br>
													<label>Customer is New: <input type="checkbox" name="myCheck" id="myCheck" onclick="myFunction()"> </label>
													<br>
													<p class="well" id="text" style="display:none">
														<label>Company Name:</label>
														<input type="text" id="companyName" name="companyName" class="form-control1 control3">
														<label>Customer Contact No:</label>
														<input type="text" id="customerContactNo" name="customerContactNo" class="form-control1 control3">
														<label>Customer Fax No:</label>
														<input type="text" id="customerFaxNo" name="customerFaxNo" class="form-control1 control3">
														<label>E-Mail Address:</label>
														<input type="text" id="customerEmail" name="customerEmail" class="form-control1 control3">
														<label>Company Address:</label>
														<!--<input type="textarea" id="customerAddress" name="customerAddress" class="form-control1 control3">-->
														<textarea class="form-control" rows="2" name="customerAddress" id="customerAddress"></textarea>
													<br>
													</p>
													<script>
													function myFunction() {
														var checkBox = document.getElementById("myCheck");
														var text = document.getElementById("text");
														if (checkBox.checked == true){
															text.style.display = "block";
														} else {
														   text.style.display = "none";
														}
													}
													</script>


													<label>Purchase Order No:</label>
													<input type="text" id="purchaseOrderNo" required name="purchaseOrderNo" class="form-control1 control3">
													<label><b>Items</b></label>
													<div id="items" class="form-group">
														<!--
														<label>Item 1 Name:</label>
														<input type="text" id="itemName[]" name="itemName[]" list="itemList" class="form-control1 control3">
														<label>Item 1 Quantity:</label>
														<input type="text" id="itemQuantity[]" name="itemQuantity[]" class="form-control1 control3">-->
														<div class="row" id="row0">
															<datalist id="itemList">
															<?php
															$sql = "SELECT * FROM stock";
															$result = mysqli_query($con, $sql);
															while($row = mysqli_fetch_array($result)) { ?>
																<option value="<?php echo $row['stockName']; ?>"><?php echo $row['stockName']; ?></option>
															<?php } ?>
															</datalist>
															<div class="col-md-10 grid_box1">
																<label>Item Name</label>
																<!--<input type="text" class="form-control1" placeholder=".col-md-10">-->
																<input type="text" required id="itemName[]" name="itemName[]" list="itemList" placeholder="Click on the drop down button to select existing stock" class="form-control1 control3">
															</div>
															<div class="col-md-2">
																<label>Item Quantity</label>
																<!--<input type="text" class="form-control1" placeholder=".col-md-12">-->
																<input type="text" required id="itemQuantity[]" name="itemQuantity[]" class="form-control1 control3">
															</div>
															<!--<div class="col-md-2"><button class="btn btn-danger" onClick="removeItemRow('row0');">Remove Row</button></div>-->
															<div class="clearfix"> </div>
														</div>
													</div>
													<button class="btn btn-normal" onclick="return additem()">Add Item</button>
													<br>
													<label>Notes:</label>
													<textarea class="form-control" rows="5" name="miscNotes" id="miscNotes"></textarea>
													<br>
													<center>
														<input class="btn btn-success" name="submitAdd" type="submit" value="Submit"> <input class="btn btn-info" name="reset" type="reset" value="Reset">
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
						<div class="modal-footer">
							<button class="btn btn-default" data-dismiss="modal" type="button">Close</button>
						</div>
					</div>
				</div>
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
											<span class="glyphicon glyphicon-remove"></span><strong>&nbsp; Delete Invoice</strong>
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
		<!--
		<div class="modal fade" id="viewInvoice" role="dialog">
			<div class="modal-dialog modal-md">
				<div class="modal-content">
					<button class="close" data-dismiss="modal" type="button">&times;</button>
					<div class="modal-body">
						<div class="container" style="width: 100%">
							<form action="" class="custom-form-horizontal" data-toggle="validator" method="post" role="form">
								<div class="panel-group">
									<div class="panel panel-default">
										<div class="panel-heading text-center" style="color: #fff; background-color: #5bc0de;">
											<span class="glyphicon glyphicon-search"></span><strong>&nbsp; View Invoice</strong>
										</div>
										<div class="panel-body">
											<div class="row form-group">
												<form action="" method="post">
													<label>Invoice ID:</label>
													<input type="text" id="inputtedID" name="inputtedID" class="form-control1 control3">
													<button class="btn btn-success" contenteditable="false" name="invoiceView" style="margin-left: 43%;" type="submit">Submit</button>
												</form>
											</div>
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
		</div>-->
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
