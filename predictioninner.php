<?php
include "config.php"; 
/*
TABLE GENERATION SQL
CREATE TABLE `fyp`.`prediction` ( `customerID` INT NOT NULL , `stockID` INT NOT NULL , `averageDays` INT NOT NULL , `averageQuantity` INT NOT NULL , `nextPurchase` DATE NOT NULL , PRIMARY KEY (`customerID`, `stockID`)) ENGINE = InnoDB;
*/
//if (isset($_POST['submitPrediction'])){

$stockID = "";
$customerID = "";
$totalItemQty = array();

//Total Quantity of each item per user + Total purchases of each item by user
//Calculating each item of each customer, on how much has been bought how many times

  //Getting invoice items list ordered by customer in order to loop both
  $sqlGetTotalQuantity = "SELECT IIL.stockID, I.customerID, IIL.itemQty FROM invoiceitemlist IIL INNER JOIN invoice I ON IIL.invoiceID = I.invoiceID ORDER BY IIL.stockID DESC, I.customerID DESC";
  $result = mysqli_query($con, $sqlGetTotalQuantity);
	while ($quantityRow = mysqli_fetch_assoc($result)){
    if ($stockID != $quantityRow["stockID"]){ //Duplicate check
      $stockID = $quantityRow["stockID"];
      $customerID = 0; //Since changed the stock item, we need to clear the customerID so we don't have dirty data
      $totalItemQty[$stockID] = array();
    }

    if ($customerID != $quantityRow["customerID"]) {
      $customerID = $quantityRow["customerID"];
      $totalItemQty[$stockID][$customerID] = array("quantity" => 0, "totalInvoices" => 0);
    }
    $totalItemQty[$stockID][$customerID]["quantity"] += $quantityRow["itemQty"];
    $totalItemQty[$stockID][$customerID]["totalInvoices"]++;
	}
//}

//Getting average date between invoice sales

  //https://stackoverflow.com/questions/9994862/date-difference-between-consecutive-rows
  //For each product the user has ever bought, get the sum of the days between sales of the item
   $sqlDaysBetweenInvoices = "SELECT stockID, customerID, MAX(date) AS lastPurchase, sum(totalDaysDiff) AS totalDaysDiff
   FROM (SELECT IIL1.stockID, 
           T1.customerID,
      T1.date,
           DATEDIFF(MIN(T2.Date),T1.date) AS totalDaysDiff
       FROM (invoice T1 INNER JOIN invoiceitemlist IIL1 ON T1.invoiceID=IIL1.invoiceID)
           LEFT JOIN (invoice T2 INNER JOIN invoiceitemlist IIL2 ON T2.invoiceID=IIL2.invoiceID)
           ON T1.customerID = T2.customerID
           AND IIL1.stockID = IIL2.stockID
           AND T2.Date > T1.Date
       GROUP BY IIL1.stockID, T1.customerID, t1.date) as diffdate
   GROUP BY stockID, customerID"; //totalDays SUM
    //Query inside query
	
  $result = mysqli_query($con, $sqlDaysBetweenInvoices);

  while ($row = mysqli_fetch_assoc($result)){
    $stockID = $row["stockID"];
    $customerID = $row["customerID"];
    if (isset($totalItemQty[$stockID][$customerID])) {
      $amountofPurchases = $totalItemQty[$stockID][$customerID]["totalInvoices"];
      if ($amountofPurchases > 1) {
        $totalQuantity = $totalItemQty[$stockID][$customerID]["quantity"]; 

        $averageDays = $row["totalDaysDiff"] / ($amountofPurchases - 1); //averageDays = totalDays/(amountofPurchases - 1)
        $averageDays = floor($averageDays); //Round down the day thing
        $averageQuantity = floor($totalQuantity / $amountofPurchases);
        $nextPurchase = date_format(date_add(new DateTime($row["lastPurchase"]), new DateInterval('P'.$averageDays.'D')), 'Y-m-d H:i:s'); //End returns the last item on an array and DateInterval turns a string into something that can be added toa date. 'P1D' means '1 day'

        //All calculated, now inserting to table
        $sqlUpdateItems = "INSERT INTO prediction VALUES($customerID, $stockID, $averageDays, $averageQuantity, '$nextPurchase') ON DUPLICATE KEY UPDATE averageDays=$averageDays, averageQuantity=$averageQuantity, nextPurchase='$nextPurchase'"; 
        $con -> query($sqlUpdateItems);
      }
  }

  }
  
  header('location:prediction.php');
?>