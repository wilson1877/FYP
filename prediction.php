<?php
//Invoice Function
include "config.php";
include "include/headers.php";
include "include/navbar.php";

if (isset($_POST['submit'])) {
	$days = $_POST['daysField'];
	$sql = "UPDATE settings SET predictionsetting = '$days' WHERE ID = '1'";
	$con -> query($sql);

	echo
	"<script>
	location.href='prediction.php';
	</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>iBuzz - Prediction</title>
	<?php echo common_headers() ?>
	<!-- Bootstrap Select -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">

	<script src="js/wow.min.js">
	</script>
	<script>
	/*
	        new WOW().init();

			jQuery(document).ready(function($){
				$('.table tbody').paginathing({
				  perPage: 10,
				  insertAfter: '.table',
				  pageNumbers: true
				});
			});*/

			var nextItem = 1;
	</script>
	<style>
	<!--
		.pagination{
			display: flex;
			justify-content: center;

		}-->
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
	       background-color: #f8d5f8;
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
		.predictionSort{
			display: inline;
		}

		@media screen and (max-width: 768px) {
	            .menu-right{float: right !important;}
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
				<h3 class="blank1">Customer Pattern Prediction</h3>
				<hr>
				<form action="" class="custom-form-horizontal" data-toggle="validator" method="post" role="form">
					<!--<p>Current Date: <?php echo $currentDate ?></p>-->

					<?php
					$sqlDays = "SELECT predictionsetting FROM settings WHERE ID = '1'";
					$result2 = mysqli_query($con, $sqlDays);
					if ($result2->num_rows > 0) {
						while ($row2 = mysqli_fetch_assoc($result2)){
							$countDates = $row2["predictionsetting"];
						}
					}else{
						$countDates = 50;
					}
					$revisedDate = Date('Y-m-d', strtotime("+".$countDates." days")); ?>
					<!--<p>Revised Date: <?php echo $revisedDate ?></p>
					<p>Count Dates: <?php echo $countDates ?></p>-->
					<p>Show prediction for the next <input type="number" id="daysField" name="daysField" min="1" max="50" class="col-10 form-control3" value="<?php echo $countDates?>" onfocusout="numberVerify()"> day(s)
					<input class="btn btn-default" name="submit" type="submit" value="Submit"><!--<a href="#" onClick="predictionSort()" class="btn btn-default" contenteditable="false" name="predictionSort" id="predictionSort"> Submit</a>--></p>
				</form>
				<p>Show all data: <input type="checkbox" name="mycheckboxdiv" id="mycheckboxdiv" onclick="myFunction()"></p>
					<br>
				<script>
				function myFunction() {
					var checkBox = document.getElementById("mycheckboxdiv");
					var table = document.getElementById("table");
					var table2 = document.getElementById("table2");
					if (checkBox.checked == true){
						table.style.display = "block";
						table2.style.display = "none";
					}else {
					   table.style.display = "none";
					   table2.style.display = "block";
					}
				}

				function numberVerify(){
					if (document.getElementById("days").value < 1 ){
						document.getElementById('days').value='1';
					}else if (document.getElementById("days").value > 1 && document.getElementById("days").value > 50){
						document.getElementById('days').value='50';
					}
				}
				</script>
				<div class="table-responsive"> <!-- Show predictions past present date. Shows this div if checkbox is not ticked -->
					<div class="grid_3 grid_4">
						<div id="table" style="display:none">
						 <table id="myTable" class="table table-striped table-bordered">
                                <!-- Incoming Table -->
                                <thead class="thead-inverse">
                                    <tr>
                                        <th>#</th>
                                        <th>Client Name</th><!-- Replace with Client name? -->
                                        <th>Items</th> <!-- Replace with Item name? -->
										<th>Expected Quantity</th>
                                        <th>Average Buy Days</th>
                                        <th>Next Buy Date</th>
                                    </tr>
                                </thead>
                                <tbody>
									<?php
									$currentDate = date("Y-m-d");
									$rowNumber = 1;

									$sql = "SELECT a.averageDays, a.averageQuantity, a.nextPurchase, b.customerName, c.stockName FROM prediction a, customer b, stock c WHERE a.customerID = b.customerID AND a.stockID = c.stockID ORDER BY a.nextPurchase DESC";
									$result = mysqli_query($con, $sql);
									if ($result->num_rows > 0) {
										while ($row = mysqli_fetch_assoc($result)){
									?>
                                    <tr>
										<?php if ($currentDate < $row["nextPurchase"]){ ?>
                                        <td><?php echo $rowNumber ?></td>
                                        <td><?php echo $row["customerName"] ?></td>
                                        <td><?php echo $row["stockName"] ?></td>
										<td><?php echo $row["averageQuantity"] ?></td>
                                        <td><?php echo $row["averageDays"] ?></td>
                                        <td><?php echo $row["nextPurchase"] ?></td>
										<?php }else{ ?>
										<td style="color: red;"><?php echo $rowNumber ?></td>
                                        <td style="color: red;"><?php echo $row["customerName"] ?></td>
                                        <td style="color: red;"><?php echo $row["stockName"] ?></td>
										<td style="color: red;"><?php echo $row["averageQuantity"] ?></td>
                                        <td style="color: red;"><?php echo $row["averageDays"] ?></td>
                                        <td style="color: red;"><?php echo $row["nextPurchase"] ?></td>
										<?php } ?>
                                    </tr>
										<?php
										$rowNumber++;
										}
									}else{?>
										<tr>
										<td>No data found. Try pressing the button below!</td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										</tr>
									<?php
									}
									?>
                                </tbody>
                            </table>
						</div>
						<div id="table2">
						 <table id="myTable" class="table table-striped table-bordered">
                                <!-- Incoming Table -->
                                <thead class="thead-inverse">
                                    <tr>
                                        <th>#</th>
                                        <th>Client Name</th><!-- Replace with Client name? -->
                                        <th>Items</th> <!-- Replace with Item name? -->
										<th>Expected Quantity</th>
                                        <th>Average Buy Days</th>
                                        <th>Next Buy Date</th>
                                    </tr>
                                </thead>
                                <tbody>
									<?php
									$currentDate = date("Y-m-d");
									$rowNumber = 1;

									$sql = "SELECT a.averageDays, a.averageQuantity, a.nextPurchase, b.customerName, c.stockName FROM prediction a, customer b, stock c WHERE a.customerID = b.customerID AND a.stockID = c.stockID AND a.nextPurchase < '$revisedDate' ORDER BY a.nextPurchase DESC";
									$result = mysqli_query($con, $sql);
									if ($result->num_rows > 0) {
										while ($row = mysqli_fetch_assoc($result)){
									?>
                                    <tr>
										<?php if ($currentDate < $row["nextPurchase"]){ ?>
                                        <td><?php echo $rowNumber ?></td>
                                        <td><?php echo $row["customerName"] ?></td>
                                        <td><?php echo $row["stockName"] ?></td>
										<td><?php echo $row["averageQuantity"] ?></td>
                                        <td><?php echo $row["averageDays"] ?></td>
                                        <td><?php echo $row["nextPurchase"] ?></td>
										<?php }?>
                                    </tr>
										<?php
										$rowNumber++;
										}
									}else{?>
										<tr>
										<td>No data found. Try pressing the button below!</td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										</tr>
									<?php
									}
									?>
                                </tbody>
                            </table>
						</div>
							<center>
							<a href="predictioninner.php" class="btn btn-danger" contenteditable="false" name="editInvoice">Refresh Algorithm</a>
							<!--<p>(Algorithm generates every 0:00 system time)</p>-->
							<!--<p>Rows marked in red are past the current date</p>-->
							<hr>
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
