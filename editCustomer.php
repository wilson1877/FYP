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
	//$inputtedID = $_POST['INPUTTEDID'];
    $inputtedID = $_REQUEST['selectedID'];
}

/*Getting Existing Data*/
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fyp";
$con = new mysqli($servername, $username, $password, $dbname);

$sqlcheck = "SELECT customerID, customerName, companyName, contactNumber, faxNumber, emailAddress, address FROM customer WHERE customerID = '$inputtedID'";
$getquery = mysqli_query($con, $sqlcheck);

if (mysqli_num_rows($getquery) > 0){
	$resultArray = mysqli_fetch_assoc($getquery);

	$customerNameOld = $resultArray['customerName'];
	$companyNameOld = $resultArray['companyName'];
	$contactNumberOld = $resultArray['contactNumber'];
	$faxNumberOld = $resultArray['faxNumber'];
	$emailAddressOld = $resultArray['emailAddress'];
    $addressOld = $resultArray['address'];
}

if (isset($_POST['submitEdit'])) {

	$customerName = $_POST['customerName'];
    $companyName = $_POST['companyName'];
	$contactNumber = $_POST['contactNumber'];
	$faxNumber = $_POST['faxNumber'];
	$emailAddress = $_POST['emailAddress'];
    $address = $_POST['address'];

	// $sqlcheckidnumber = "SELECT customerID FROM customer WHERE customerName = '$customerName'"; //Checking for duplicates
	// $runquery = mysqli_query($con, $sqlcheckidnumber);
	// if ($runquery -> num_rows > 0) {
	// 	//Name found!
	// 	$resultArray = mysqli_fetch_assoc($runquery);
	// 	$customerID = $resultArray["customerID"];
    //
	// 	$sqledit = "UPDATE customer SET customerID = '$customerID', customerName = '$customerName', companyName = '$companyName', contactNumber = '$contactNumber', faxNumber = '$faxNumber', emailAddress = '$emailAddress', address = '$address' WHERE customerID = '$inputtedID'";
	// 	$con -> query($sqledit);
    //
	// 	echo
	// 	"<script>
	// 	location.href='customerData.php';
	// 	</script>";
	// }

    $customerID = $resultArray["customerID"];
    $sqledit = "UPDATE customer SET customerID = '$customerID', customerName = '$customerName', companyName = '$companyName', contactNumber = '$contactNumber', faxNumber = '$faxNumber', emailAddress = '$emailAddress', address = '$address' WHERE customerID = '$inputtedID'";
    $con -> query($sqledit);

    echo
    "<script>
    location.href='customerData.php';
    </script>";

}

?>
<!DOCTYPE html>
<html>
<head>
	<title>iBuzz - Edit Information</title>
	<link href="images/Icon.ico" rel="icon" type="image/x-icon">
	<meta content="width=device-width, initial-scale=1" name="viewport">
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type">

	<script type="application/x-javascript">
	addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); }
	</script><!-- Bootstrap Core CSS -->
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">

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
	   textarea {
			resize: none;
	   }
	   .invoice-padding{
			margin-top : 25px;
		}
	</style><!--//end-animate-->
	<!--==webfonts=-->
	<link href='//fonts.googleapis.com/css?family=Cabin:400,400italic,500,500italic,600,600italic,700,700italic' rel='stylesheet' type='text/css'><!---//webfonts=-->
	<!-- Meters graphs -->

	<script src="js/jquery-1.10.2.min.js">
	</script><!-- Placed js at the end of the document so the pages load faster -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>

	<script type="text/javascript">
		$('.selectpicker').selectpicker({
		});
	</script>

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
				<h3 class="blank1">Editing Customer #<?php echo $inputtedID ?> - <?php echo $customerNameOld ?> [<?php echo $companyNameOld ?>]</h3>
				<hr>
				<form action="" class="custom-form-horizontal" data-toggle="validator" method="post" role="form">
				<?php
				$servername = "localhost";
				$username = "root";
				$password = "";
				$dbname = "fyp";
				$con = new mysqli($servername, $username, $password, $dbname);

				$sql = "SELECT * FROM customer WHERE customerID = '$inputtedID'";

				$result = mysqli_query($con, $sql);

				if (mysqli_num_rows($result) > 0){
					$resultArray = mysqli_fetch_assoc($result);
				?>
					<div class="grid_3 grid_4">

					<label>Customer Name: </label>
					<input type="text" value="<?php echo $customerNameOld ?>" id="customerName" name="customerName" class="form-control1 control3">
					<br>
                    <label>Company Name: </label>
					<input type="text" value="<?php echo $companyNameOld ?>" id="companyName" name="companyName" class="form-control1 control3">
					<br>
                    <label>Contact Number: </label>
					<input type="text" value="<?php echo $contactNumberOld ?>" id="contactNumber" name="contactNumber" class="form-control1 control3">
					<br>
                    <label>Fax Number: </label>
					<input type="text" value="<?php echo $faxNumberOld ?>" id="faxNumber" name="faxNumber" class="form-control1 control3">
					<br>
                    <label>Email Address: </label>
					<input type="text" value="<?php echo $emailAddressOld ?>" id="emailAddress" name="emailAddress" class="form-control1 control3">
					<br>
                    <label>Delivery Address: </label>
					<input type="text" value="<?php echo $addressOld ?>" id="address" name="address" class="form-control1 control3">
					<br>

					<center>
						<input class="btn btn-success" name="submitEdit" type="submit" value="Submit"> <input class="btn btn-info" name="reset" type="reset" value="Reset">
						<br>
					</center>
					</div>
					</form>
				<?php
				}else{ ?>
					<h1>Customer not found!!</h1>
					<hr>
					<p>Ensure that you wrote the ID properly!</p>
				<?php } ?>
				<center>
					<a href="customerData.php" class="btn btn-default"><span class="glyphicon glyphicon-backward"></span> Click here to return</a>
				</center>
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
