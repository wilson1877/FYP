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
						<script>
							function selectInvoice(invoiceID){
                                var chkInvoice = document.getElementById("chkInvoice"+invoiceID)
                                chkInvoice.checked = !chkInvoice.checked
								if (chkInvoice.checked ){
                                    document.getElementById("Srow"+invoiceID).style.backgroundColor = "lightcyan";
								}
								else {
                                    document.getElementById("Srow"+invoiceID).style.backgroundColor = "";
                                }
							}
                        </script>
                        <form id="actionSender" method="post">
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
                                <tbody>
                                    <?php
                                    $servername = "localhost";
                                    $username = "root";
                                    $password = "";
                                    $dbname = "fyp";
                                    $con = new mysqli($servername, $username, $password, $dbname);
                                    $sql = "SELECT a.invoiceID, a.date, a.totalPrice, b.customerName, a.purchaseOrderNo, a.miscNotes FROM invoice a, customer b WHERE a.customerID = b.customerID AND a.delivered = 0 ORDER BY a.invoiceID DESC";
                                    $result = mysqli_query($con, $sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = mysqli_fetch_assoc($result)){
                                    ?>
                                    <tr onclick="selectInvoice(<?php echo $row["invoiceID"]?>)" id="Srow<?php echo $row["invoiceID"]?>">
                                        <td><input type="checkbox" name="invoice[]" id="chkInvoice<?php echo $row["invoiceID"] ?>" value="<?php echo $row["invoiceID"] ?>" style="display: none" /><?php echo $row["invoiceID"] ?></td>
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
                                        <td>Nothing here, try registering an invoice first?</td>
                                    </tr><?php }?>
                                </tbody>
                            </table>
						</form>

						<center>
							<p>
							<a href="#" onClick="addDelivery()" class="btn btn-warning" contenteditable="false" name="addDelivery"><span class="lnr lnr-car"></span> Make Delivery</a>

							<script>
							function addDelivery(){
									var theform = document.getElementById("actionSender");
									theform.action="deliveryOrder.php";
									theform.submit()
							}
							</script>

							<a href="#" onClick="markDelivered()" class="btn btn-warning" contenteditable="false" name="markDelivered"><span class="glyphicon  glyphicon-ok"></span> Mark as Delivered</a>
							<script>
							function markDelivered(){
								if(confirm("Are you sure you want to mark these invoices as delivered?\nThis process can't be undone!")){
									var theform = document.getElementById("actionSender");
									theform.action="deliveredOrder.php";
									theform.method="post";
									theform.submit()
								}
							}
							</script>
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
