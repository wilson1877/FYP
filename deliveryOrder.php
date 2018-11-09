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

<form action="http://maps.google.com/maps" method="get" target="_blank">
	Enter your starting address:
	<input type="text" name="saddr" />
	<input type="hidden" name="daddr" value="23, Jalan Anggerik Aranda C 31/C, Kota Kemuning, 40460 Shah Alam, Selangor" />
	<input type="submit" value="Get directions" />
</form>

</body>
</html>
