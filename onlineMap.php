<?php
//Customer Function
include "config.php";
include "include/headers.php";
include "include/navbar.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>iBuzz - Delivery Map</title>
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
				#floating-panel{top: 432px !important;}
	        }

		#map {
        height: 100%;
		}

		#floating-panel {
        position: absolute;
        top: 321px;
        left: 25%;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
        text-align: center;
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        padding-left: 10px;
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
				<h3 class="blank1">Delivery Map</h3>
				<hr>
				<div class="table-responsive">
					<div class="grid_3 grid_4">
                        <!-- <iframe src="https://goo.gl/pSdScm" width="100%" height="500px" frameborder="0" style="border:0"
                        allowfullscreen></iframe> -->
						<?php
						$servername = "localhost";
						$username = "root";
						$password = "";
						$dbname = "fyp";
						$con = new mysqli($servername, $username, $password, $dbname);
						$sql = "SELECT b.address FROM invoice a, customer b WHERE a.customerID = b.customerID AND a.delivered = 0";
						$result = mysqli_query($con, $sql);
						if ($result->num_rows > 0) {
							while ($row = mysqli_fetch_assoc($result)){
						?>
						<div id="floating-panel">
							<!-- <input id="address" type="textbox" value=""> -->
							<input id="submit" type="button" value="Reload Map">
						</div>
						<div id="map"></div>
					<?php } ?>
                        <center style="padding-top: 25px;">
							<a href="delivery.php" onClick="" class="btn btn-warning" contenteditable="false"
                            name="deliveryBtn"><span class="glyphicon  glyphicon-user"></span> Make Delivery</a>
						</center>
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
	<script>
      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
			enter: {lat: 3.168660, lng: 101.648532},
  			zoom: 12
        });
        var geocoder = new google.maps.Geocoder();

        document.getElementById('submit').addEventListener('click', function() {
          geocodeAddress(geocoder, map);
        });
      }

      function geocodeAddress(geocoder, resultsMap) {
        var address = document.getElementById('address').value;
        geocoder.geocode({'address': address}, function(results, status) {
          if (status === 'OK') {
            resultsMap.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
              map: resultsMap,
              position: results[0].geometry.location
            });
          } else {
            alert('Geocode was not successful for the following reason: ' + status);
          }
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB06z0_vkU-VpoJg5be2C3iJwiscmMnQPg&callback=initMap">
    </script>
</body>
</html>
<!-- API key => AIzaSyB06z0_vkU-VpoJg5be2C3iJwiscmMnQPg -->
