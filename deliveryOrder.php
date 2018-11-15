<?php
//Invoice Function
include "config.php";
include "include/headers.php";
include "include/navbar.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>iBuzz - Delivery</title>
	<?php echo common_headers() ?>
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

			var nextItem = 1;
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
		<?php
        if ($userid == 1){
            echo navbar();
        }
        else {
            if ($isDriver == 0){
                echo navbar();
            }
            else {
                echo dribar();
            }
        }
        ?>
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
				<h3 class="blank1">Deliveries</h3>
				<hr>
				<div class="table-responsive">
					<div class="grid_3 grid_4">
                        <form id="actionSender" method="post">
                            <table id="myTable" class="table table-striped table-bordered">
                                <!-- Incoming Table -->
                                <thead class="thead-inverse">
                                    <tr>
                                        <th>#</th>
                                        <th>Invoice ID</th>
                                        <th>Customer</th>
                                        <th>Address</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    		$waypoints = "";
											$address = "";
											$name = "";
											foreach ($_REQUEST["invoice"] as $key => $value) {
												$sql = "SELECT customername, address FROM customer c INNER JOIN invoice i ON c.customerID=i.customerID WHERE invoiceID='$value'	";
												$result = mysqli_query($con, $sql);
												if ($result->num_rows > 0) {
													while ($row = mysqli_fetch_assoc($result)){
														if ($address != "") {
															$waypoints .= ($waypoints != "" ? "|" : "") . $address;
															//when first address comes comes, waypoints is empty, and should not put a | before A
														}
														$address = preg_replace('/\n+/', '', $row["address"]);
														$name = $row["customername"];
													}
												}
												echo "<tr><td>$key</td><td>$value</td><td>$name</td><td>$address</td></tr>\n";
											}?>

                                </tbody>
                            </table>
						</form>

						<center>
						<form action="http://maps.google.com/maps/dir/" method="get" target="_blank"> <!-- https://developers.google.com/maps/documentation/urls/guide#directions-action -->
							Enter your starting address:
							<input type="text" name="origin" placeholder="Current Location"/>
							<input type="hidden" name="api" value="1" />
							<input type="hidden" name="waypoints" value="<?php echo $waypoints; ?>" />
							<input type="hidden" name="destination" value="<?php echo $address; ?>" />
							<input type="submit" value="Get directions" />
						</form>
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
