<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php
include "config.php";
include "include/navbar.php";
?>
<!DOCTYPE HTML>
<html>
<head>
<title>iBuzz - Main Page</title>
<link rel="icon" href="images/Icon.ico" type="image/x-icon">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--<meta name="keywords" content="Easy Admin Panel Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />-->
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
 <!-- Bootstrap Core CSS -->
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<!-- Graph CSS -->
<link href="css/font-awesome.css" rel="stylesheet">
<!-- jQuery -->
<!-- lined-icons -->
<link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
<!-- //lined-icons -->
<!-- chart -->
<script src="js/Chart.js"></script>
<!-- //chart -->
<!--animate-->
<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="js/wow.min.js"></script>
	<script>
		 //new WOW().init();
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

	@media screen and (max-width: 768px) {
            .menu-right{float: right !important;}
        }

	</style>
<!--//end-animate-->
<!----webfonts--->
<link href='//fonts.googleapis.com/css?family=Cabin:400,400italic,500,500italic,600,600italic,700,700italic' rel='stylesheet' type='text/css'>
<!---//webfonts--->
 <!-- Meters graphs -->
<script src="js/jquery-1.10.2.min.js"></script>
<!-- Placed js at the end of the document so the pages load faster -->

</head>

 <body class="sticky-header left-side-collapsed"  onload="initMap()">
    <section>
		<?php echo navbar() ?>

		<!-- main content start-->
		<div class="main-content">
			<!-- header-starts -->
			<div class="header-section">
			<!--toggle button start-->
			<a class="toggle-btn  menu-collapsed"><i class="fa fa-bars"></i></a>
			<!--toggle button end-->
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
									<li> <a href="profile.php"><i class="fa fa-user"></i>Profile</a> </li>
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
			  </div>
			<!--notification menu end -->
			</div>
		<!-- //header-ends -->
			<div id="page-wrapper">
				<h3 class="blank1">Dashboard</h3>
				<hr>
				<div class="graphs">
					<!--
					Can't think of anything
					<div class="col_3">
						<div class="col-md-3 widget widget1">
							<div class="r3_counter_box">
								<i class="fa fa-mail-forward"></i>
								<div class="stats">
								  <h5>45 <span>%</span></h5>
								  <div class="grow">
									<p>Growth</p>
								  </div>
								</div>
							</div>
						</div>
						<div class="col-md-3 widget widget1">
							<div class="r3_counter_box">
								<i class="fa fa-users"></i>
								<div class="stats">
								  <h5>[Current Balance]<span>%</span></h5>
								  <div class="grow grow1">
									<p>Balance</p>
								  </div>
								</div>
							</div>
						</div>
						<div class="col-md-3 widget widget1">
							<div class="r3_counter_box">
								<i class="fa fa-eye"></i>
								<div class="stats">
								  <h5>70 <span>%</span></h5>
								  <div class="grow grow3">
									<p>Amount owned</p>
								  </div>
								</div>
							</div>
						 </div>
						 <div class="col-md-3 widget">
							<div class="r3_counter_box">
								<i class="fa fa-usd"></i>
								  <h5>70 <span>%</span></h5>
								<div class="stats">
								  <div class="grow grow2">
									<p>Profit</p>
								  </div>
								</div>
							</div>
						</div>
						<div class="clearfix"> </div>
					</div>-->

						<div class="clearfix"> </div>
					</div>
					<br>
				<div class="col-md-9 col-lg-8">
					<div class="activity_box">
						<h3>Pending Deliveries</h3>
						<div class="scrollbar scrollbar1" id="style-2">
						<!-- Start of Row-->
						<?php //Show only delivered invoices where delivered = 0. If it's 1, that means delivered already.
						$sql = "SELECT a.invoiceID, b.address, a.date, b.customerName, b.companyName, a.purchaseOrderNo FROM invoice a, customer b WHERE a.customerID = b.customerID AND a.delivered = '0' ORDER BY a.invoiceID DESC";
						$result = mysqli_query($con, $sql);
						if ($result->num_rows > 0) {
							while ($row = mysqli_fetch_assoc($result)){ ?>
							<div class="activity-row">

								<!--<div class="col-xs-3 activity-img"><img src='images/1.png' class="img-responsive" alt=""/></div>-->
								<div class="col-xs-10 activity-desc">
									<h5><a href="#"><?php echo $row["invoiceID"] ?> - <?php echo $row["companyName"] ?> (<?php echo $row["customerName"] ?>)</a></h5>
									<p><b>Location:</b> <?php echo $row["address"] ?></p>
									<!--
									<h5><a href="#">[Invoice No] - [Company Name] (Customer Name)</a></h5>
									<p>Location: </p>-->
								</div>
								<div class="col-xs-2 activity-desc1"><h6><?php echo $row["date"] ?></h6></div>
								<div class="clearfix"> </div>
							</div>
							<?php }
								}?>
							<!-- End of Row-->
						</div>
					</div>
				</div>
				<div class="col-md-3 col-lg-4">
					<div class="activity_box activity_box1">
						<h3>iBuzz News</h3>
							<div class="scrollbar" id="style-2">
							<div class="activity-row activity-row1">
									<b>16/11/18</b>
									<p>IBuzz version 1 created!</p>
									<div class="clearfix"> </div>
								</div>
								<div class="activity-row activity-row1">
									<b>8/3/18</b>
									<p>Launch of iBuzz! Pleasure to meet everyone!</p>
								</div>
							</div>
					</div>
				</div>
				<div class="clearfix"> </div>
				<br>
				<!--
				<div class="grid_3 grid_5">
					<h3>iBuzz News</h3>
					<hr>
					<p><h4>First launch of the web-based system! (8/3/18)</h4></p>
					<p><h5>By: xxx</h5></p>
					<p>Just getting things started up! Please look around and give any comments if there are any!</p>
				</div>-->
				<div class="switches">
			<div class="col-4">
				<div class="col-md-4 switch-right">
					<div class="switch-right-grid">
						<div class="switch-right-grid1">
							<h3>TODAY'S STATS</h3>
							<ul>
								<li>Earning: $400</li>
								<li>Items Sold: 20 Items</li>
								<li>Last Hour Sales: $34</li>
							</ul>
						</div>
					</div>
					<div class="sparkline">
						<canvas id="line" height="150" width="480" style="width: 480px; height: 150px;"></canvas>
							<script>
									var lineChartData = {
										labels : ["Mon","Tue","Wed","Thu","Fri","Sat","Mon"],
										datasets : [
											{
												fillColor : "#fff",
												strokeColor : "#F44336",
												pointColor : "#fbfbfb",
												pointStrokeColor : "#F44336",
												data : [20,35,45,30,10,65,40]
											}
										]

									};
									new Chart(document.getElementById("line").getContext("2d")).Line(lineChartData);
							</script>
					</div>
				</div>
				<div class="col-md-4 switch-right">
					<div class="switch-right-grid">
						<div class="switch-right-grid1">
							<h3>MONTHLY STATS</h3>
							<ul>
								<li>Earning: $5,000</li>
								<li>Items Sold: 400 Items</li>
								<li>Last Hour Sales: $2,434</li>
							</ul>
						</div>
					</div>
					<div class="sparkline">
						<canvas id="bar" height="150" width="480" style="width: 480px; height: 150px;"></canvas>
							<script>
								var barChartData = {
									labels : ["Mon","Tue","Wed","Thu","Fri","Sat","Mon","Tue","Wed","Thu"],
									datasets : [
										{
											fillColor : "#8BC34A",
											strokeColor : "#8BC34A",
											data : [25,40,50,65,55,30,20,10,6,4]
										},
										{
											fillColor : "#8BC34A",
											strokeColor : "#8BC34A",
											data : [30,45,55,70,40,25,15,8,5,2]
										}
									]

								};
									new Chart(document.getElementById("bar").getContext("2d")).Bar(barChartData);
							</script>
					</div>
				</div>
				<div class="col-md-4 switch-right">
					<div class="switch-right-grid">
						<div class="switch-right-grid1">
							<h3>ALLTIME STATS</h3>
							<ul>
								<li>Earning: $80,000</li>
								<li>Items Sold: 8,000 Items</li>
								<li>Last Hour Sales: $75,434</li>
							</ul>
						</div>
					</div>
					<div class="sparkline">
						<!--graph-->
						<link rel="stylesheet" href="css/graph.css">
						<script src="js/jquery.flot.min.js"></script>
					<!--//graph-->
							<script>
								$(document).ready(function () {

									// Graph Data ##############################################
									var graphData = [{
											// Returning Visits
											data: [ [4, 4500], [5,3500], [6, 6550], [7, 7600],[8, 4500], [9,3500], [10, 6550], ],
											color: '#FFCA28',
											points: { radius: 7, fillColor: '#fff' }
										}
									];

									// Lines Graph #############################################
									$.plot($('#graph-lines'), graphData, {
										series: {
											points: {
												show: true,
												radius: 1
											},
											lines: {
												show: true
											},
											shadowSize: 0
										},
										grid: {
											color: '#fff',
											borderColor: 'transparent',
											borderWidth: 10,
											hoverable: true
										},
										xaxis: {
											tickColor: 'transparent',
											tickDecimals: false
										},
										yaxis: {
											tickSize: 1200
										}
									});

									// Graph Toggle ############################################
									$('#graph-bars').hide();

									$('#lines').on('click', function (e) {
										$('#bars').removeClass('active');
										$('#graph-bars').fadeOut();
										$(this).addClass('active');
										$('#graph-lines').fadeIn();
										e.preventDefault();
									});

									$('#bars').on('click', function (e) {
										$('#lines').removeClass('active');
										$('#graph-lines').fadeOut();
										$(this).addClass('active');
										$('#graph-bars').fadeIn().removeClass('hidden');
										e.preventDefault();
									});

								});
							</script>
							<div id="graph-wrapper">
								<div class="graph-container">
									<div id="graph-lines"> </div>
									<div id="graph-bars"> </div>
								</div>
							</div>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
			</div>
		</div>
		<!-- //switches -->
		<div class="col_1">
			<div class="clearfix"> </div>
		</div>
				</div>
			<!--body wrapper start-->
			</div>
			 <!--body wrapper end-->
		</div>
        <!--footer section start-->
			<footer>
			   <p>Copyright © iBuzz 2018</p>
			</footer>
        <!--footer section end-->

      <!-- main content end-->
   </section>

<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>
<!-- Bootstrap Core JavaScript -->
   <script src="js/bootstrap.min.js"></script>
</body>
</html>
