<?php
if (isset($_POST['submitAdd'])) {
	
	//Check if the checkbox is checked
	if (isset($_POST['myCheck'])) {
	$customerName = $_POST['customerName'];
	}else{
		$customerName = $_POST['customerNameDrop'];
	}
	
	//Getting fields
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

		//Looking through the array now!
		foreach($_POST['itemName'] as $index => $itemName ) {
			if ($itemName){
				$sqlcheckItemName = "SELECT stockID, price, totalStock FROM stock WHERE stockName = '$itemName'";
				$runquery2 = mysqli_query($con, $sqlcheckItemName);

				if (mysqli_num_rows($runquery2) > 0){
					$resultArray = mysqli_fetch_assoc($runquery2);

					$stockID = $resultArray["stockID"];
					$price = $resultArray["price"];
					$totalStock = $resultArray["totalStock"];

					//Debugging stuff
					/*var_dump($stockID);
					var_dump($price);*/

					$itemQuantity = $_POST["itemQuantity"][$index];
					
					$updatedStock = $totalStock - $itemQuantity;
					
					$sqledit = "UPDATE stock SET totalStock = '$updatedStock' WHERE stockID = '$stockID'";
					$con -> query($sqledit);

					$totalPrice += $price * $itemQuantity;

					$sqlinsert2 = "INSERT INTO invoiceitemlist(invoiceID, stockID, itemQty) VALUES ('$invoiceID', '$stockID', '$itemQuantity')";
					$con -> query($sqlinsert2);
					
					
				}
			}
		}
		$sqlUpdate = "UPDATE invoice SET totalPrice= '$totalPrice' WHERE invoiceID = '$invoiceID'";
		$con -> query($sqlUpdate);
		
		//Adding into Debit Section for Audit Recording
		//Debit = Add more money, Credit = Remove money
		
		$sqlAudit = "INSERT INTO creditdebit(invoiceID, customerID, debit, date) VALUES ('$invoiceID', '$customerID', '$totalPrice', '$currentDate')";
		$con -> query($sqlAudit);

	}
}

//Invoice View Function, gets the selected ID and moves to invoiceview
if(isset($_POST['invoiceView'])){
	$inputtedID = $_POST['inputtedID'];

	$_SESSION['INPUTTEDID'] = $inputtedID;
	header('location:invoiceview.php');
}
?>