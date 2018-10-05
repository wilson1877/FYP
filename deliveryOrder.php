<?php 
	include "config.php";
?>
<html>
<body>
<table border="solid">
    <theader>
        <tr><td colspan="2">Invoices to deliver</td></tr>
        <tr><td></td><td>Invoice ID</td><td>Address</td></tr>
    </theader>
    <tbody>
        <?php
		foreach ($_REQUEST["invoice"] as $key => $value) {
			$sql = "SELECT address FROM customer c INNER JOIN invoice i ON c.customerID=i.customerID WHERE invoiceID='$value'	";
			$result = mysqli_query($con, $sql);
			if ($result->num_rows > 0) {
				while ($row = mysqli_fetch_assoc($result)){
					$address = $row["address"];
				}
			}
			echo "<tr><td>$key</td><td>$value</td><td>$address</td></tr>\n";
		}?>
    </tbody>
</table>
</body>
</html>