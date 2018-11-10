<?php
if (isset($_POST['submitAdd'])) {
		$customerName = $_POST['customerName'];
		$companyName=$_POST['companyName'];
		$customerContactNo=$_POST['contactNumber'];
		$customerEmail=$_POST['emailAddress'];
		$customerAddress=$_POST['address'];
		$customerFaxNo=$_POST['customerFaxNo'];

		/*if (isset($_POST['myCheck'])) {
			//Checking the associated Customer with their ID via Name
			$sqlcheckidnumber = "SELECT customerID FROM customer WHERE customerName = '$customerName'"; //Checking for duplicates
			$runquery = mysqli_query($con, $sqlcheckidnumber);

			if ($runquery -> num_rows <= 0) {
				//It's a new customer! Adding to the DB!
				$companyName=$_POST['companyName'];
				$customerContactNo=$_POST['customerContactNo'];
				$customerEmail=$_POST['customerEmail'];
				$customerAddress=$_POST['customerAddress'];

				$sqlnewcustomerinsert = "INSERT INTO customer(customerName, companyName, contactNumber, emailAddress, address) VALUES ('$customerName', '$companyName', '$customerContactNo', '$customerEmail', '$customerAddress')";
				$con -> query($sqlnewcustomerinsert);
			}
		}*/

		$sqlcheckidnumber = "SELECT customerID FROM customer WHERE customerName = '$customerName'"; //Checking for duplicates
		$runquery = mysqli_query($con, $sqlcheckidnumber);

		if ($runquery -> num_rows <= 0) {
			//Customer not found, proceed with adding
			$resultArray = mysqli_fetch_assoc($runquery);
			$customerID = $resultArray["customerID"];

			$sqlnewcustomerinsert = "INSERT INTO customer(customerName, companyName, contactNumber, faxNumber, emailAddress, address) VALUES ('$customerName', '$companyName', '$customerContactNo', '$customerFaxNo', '$customerEmail', '$customerAddress')";
			$con -> query($sqlnewcustomerinsert);

			$file = 'userlog.log';
		    // The new person to add to the file
		    date_default_timezone_set("Asia/Kuala_Lumpur");
		    $log = "\n" . date("d-m-Y h:i:sa") . " - User " . $_SESSION['username'] . " successfully added customer " . $customerName . ".";
		    // Write the contents to the file,
		    // using the FILE_APPEND flag to append the content to the end of the file
		    // and the LOCK_EX flag to prevent anyone else writing to the file at the same time
		    file_put_contents($file, $log, FILE_APPEND | LOCK_EX);
		}else{
			//Customer found, throw error
		}
	}

if(isset($_POST['viewCustomer'])){
	$inputtedID = $_POST['inputtedID'];

	$_SESSION['INPUTTEDID'] = $inputtedID;
	header('location:viewCustomerData.php');
}
?>
