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
		$stockName = $_POST['stockName'];
    $stockImage = $_POST['stockImage'];
		$price = $_POST['price'];
		$totalStock = $_POST['totalStock'];

		$sqlcheckidnumber = "SELECT stockID FROM stock WHERE stockName = '$stockName'"; //Checking for duplicates
		$runquery = mysqli_query($con, $sqlcheckidnumber);

		if ($runquery -> num_rows <= 0) {
			//Customer not found, proceed with adding
			$resultArray = mysqli_fetch_assoc($runquery);
			$stockID = $resultArray["stockID"];

			$sqlnewstockinsert = "INSERT INTO stock(stockName, stockImage, price, totalStock) VALUES ('$stockName', '$stockImage', '$price', '$totalStock')";
			$con -> query($sqlnewstockinsert);

            $file = 'userlog.log';
            // The new person to add to the file
            date_default_timezone_set("Asia/Kuala_Lumpur");
            $log = "\n" . date("d-m-Y h:i:sa") . " - User " . $_SESSION['username'] . " successfully added stock " . $stockName . ".";
            // Write the contents to the file,
            // using the FILE_APPEND flag to append the content to the end of the file
            // and the LOCK_EX flag to prevent anyone else writing to the file at the same time
            file_put_contents($file, $log, FILE_APPEND | LOCK_EX);
		}else{
			//Stock found, throw error
		}
	}

if(isset($_POST['viewStock'])){
	$inputtedID = $_POST['inputtedID'];

	$_SESSION['INPUTTEDID'] = $inputtedID;
	header('location:viewStock.php');
}

include "include/headers.php";
include "include/navbar.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>iBuzz - Inventory</title>
	<?php echo common_headers() ?>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>

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
	       background-color: #fff6c6;
	   }
	   .btn-info {
	       padding: 6px 12px;
	   }
	   textarea {
			resize: none;
	   }

       @media screen and (max-width: 768px) {
               .menu-right{float: right !important;}
           }
           
	</style><!--//end-animate-->
	<!--==webfonts=-->
	<link href='//fonts.googleapis.com/css?family=Cabin:400,400italic,500,500italic,600,600italic,700,700italic' rel='stylesheet' type='text/css'><!---//webfonts=-->
	<!-- Meters graphs -->

</head>
<body class="sticky-header left-side-collapsed" onload="initMap()">
	<section>
		<?php echo navbar() ?>
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
				<h3 class="blank1">Inventory</h3>
				<hr>
				<div class="table-responsive">
					<div class="grid_3 grid_4">
						<table class="table table-striped table-bordered">
							<!-- Incoming Table -->
							<thead class="thead-inverse">
								<tr>
									<th>Stock ID</th>
									<th>Stock Image</th>
									<th>Stock Name</th>
									<th>Price</th>
									<th>Quantity</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$servername = "localhost";
								$username = "root";
								$password = "";
								$dbname = "fyp";
								$con = new mysqli($servername, $username, $password, $dbname);
								$sql = "SELECT * FROM stock ORDER BY stockID DESC";
								$result = mysqli_query($con, $sql);
								if ($result->num_rows > 0) {
									while ($row = mysqli_fetch_assoc($result)){
								?>
								<tr>
									<td><?php echo $row["stockID"] ?></td>
									<td><?php echo $row["stockImage"] ?></td>
									<td><?php echo $row["stockName"] ?></td>
									<td><?php echo $row["price"] ?></td>
									<td><?php echo $row["totalStock"] ?></td>
								</tr><?php }
								}
								else{
								echo "No results";
								?>
								<tr>
									<td>No data</td>
									<td>No data</td>
									<td>No data</td>
									<td>No data</td>
                  <td>No data</td>
								</tr><?php }?>
							</tbody>
						</table>
						<center>
							<p><a class="btn btn-primary" data-toggle="modal" href="#addStock"><span class="glyphicon glyphicon-user"></span> Add Stock</a>
							<a class="btn btn-info" data-toggle="modal" href="#viewStock"><span class="glyphicon glyphicon-wrench"></span> Edit Stock Info</a></p>
						</center>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-sm-12 col-lg-12" style="height:10px"></div><!--Add Customer Modal-->
		<div class="container">
			<!-- Trigger the modal with a button -->
			<!-- Modal -->
			<div class="modal fade" id="addStock" role="dialog">
				<div class="modal-dialog modal-lg">
					<!-- Modal content-->
					<div class="modal-content">
						<button class="close" data-dismiss="modal" type="button">&times;</button>
							<div class="modal-body">
								<!--Content-->
								<div class="container" style="width: 100%">
									<form action="addStock.php" class="custom-form-horizontal" data-toggle="validator" method="post" role="form" enctype="multipart/form-data">
										<div class="panel-group">
											<div class="panel panel-default">
												<div class="panel-heading text-center" style="color: #fff; background-color: rgb(51, 122, 183);">
													<span class="glyphicon glyphicon-user"></span><strong>&nbsp; Add Stock</strong>
												</div>
												<div class="panel-body">
												<form action="" method="post">
                          <?php
													$servername = "localhost";
													$username = "root";
													$password = "";
													$dbname = "fyp";
													$con = new mysqli($servername, $username, $password, $dbname);

													$sql = "SELECT * FROM stock";
													$result = mysqli_query($con, $sql);
													?>
													<label>Stock Name: </label>
													<input type="text" id="stockName" name="stockName" class="form-control1 control3">
													<label>Price: </label>
													<input type="text" id="price" name="price" class="form-control1 control3">
                          <label>Quantity: </label>
													<input type="text" id="totalStock" name="totalStock" class="form-control1 control3">
                          <label>Stock Image: </label>
													<!--<input type="file" id="stockImage" name="stockImage" id="fileToUpload" class="form-control1 control3">-->
													<input type="file" id="stockImage" name="stockImage" class="form-control1 control3">
													<br>
													<center>
														<!--<input class="btn btn-success" name="submitAdd" type="submit" value="Submit">-->
														<input class="btn btn-success" name="submit" type="submit" value="Submit">
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
		<div class="modal fade" id="viewStock" role="dialog">
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
											<span class="glyphicon glyphicon-wrench"></span><strong>&nbsp; Edit Stock Info</strong>
										</div>
										<div class="panel-body">
											<div class="row form-group">
												<form action="" method="post">
													<label>Stock ID:</label>
													<input type="text" id="inputtedID" name="inputtedID" class="form-control1 control3">

													<button class="btn btn-success" contenteditable="false" name="viewStock" style="margin-left: 43%;" type="submit">Submit</button>
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
