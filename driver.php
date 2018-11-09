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
    	<?php echo dribar() ?>

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
											<p><p><?php echo $username ;?><span>
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
							<div class="activity-row">
								<!--<div class="col-xs-3 activity-img"><img src='images/1.png' class="img-responsive" alt=""/></div>-->
								<div class="col-xs-10 activity-desc">
									<h5><a href="#">Delivery #001</a></h5>
									<p>Klang - 11am</p>
								</div>
								<div class="col-xs-2 activity-desc1"><h6>Completed</h6></div>
								<div class="clearfix"> </div>
							</div>
							<div class="activity-row">
								<!--<div class="col-xs-3 activity-img"><img src='images/1.png' class="img-responsive" alt=""/></div>-->
								<div class="col-xs-10 activity-desc">
									<h5><a href="#">Delivery #002</a></h5>
									<p>Puchong - 2pm</p>
								</div>
								<div class="col-xs-2 activity-desc1"><h6>Pending</h6></div>
								<div class="clearfix"> </div>
							</div>
							<div class="activity-row">
								<!--<div class="col-xs-3 activity-img"><img src='images/1.png' class="img-responsive" alt=""/></div>-->
								<div class="col-xs-10 activity-desc">
									<h5><a href="#">Delivery #003</a></h5>
									<p>Shah Alam - 5pm</p>
								</div>
								<div class="col-xs-2 activity-desc1"><h6>Cancel</h6></div>
								<div class="clearfix"> </div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-3 col-lg-4">
					<div class="activity_box activity_box1">
						<h3>iBuzz News</h3>
							<div class="scrollbar" id="style-2">
								<div class="activity-row activity-row1">
									<b>2/10/18</b>
									<p>Customer request faster delivery</p>
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
