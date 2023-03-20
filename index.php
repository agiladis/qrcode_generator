<?php
include './inc/koneksi.php';

// Retrieve the serial number from the database
$result = mysqli_query($koneksi, "SELECT * FROM product ORDER BY id_product DESC LIMIT 1");
$data_exist = true;

if (mysqli_num_rows($result) > 0) {
    // Read the serial number from the database
    $row = mysqli_fetch_assoc($result);
	
	// Get last registered serial number
	$prefix = "SN-";
	$last_digit_serial_number = intval(substr($row["serial_number"], -4));
    $serial_number = $prefix . sprintf('%04d', $last_digit_serial_number + 1);
    $last_serial_number = $prefix . sprintf('%04d', $last_digit_serial_number);
} else {
	$serial_number = "SN-0001";
	$data_exist = false;
    // echo "No records found in the database.";
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>QR Code Generator</title>
</head>
<body>
	<h1>QR Code Generator</h1>
    <!-- <form  method="POST">
		<input type="submit" name="run_button" value="Generate New SN">
	</form> -->
    <br>
    <br>
	<form method="POST" action="lib/gn_serial.php">
		<label for="qr_data">Serial number to be generated</label><br>
		<input type="text" id="qr_data" name="qr_data" value= "<?php echo $serial_number; ?>" readonly><br><br>
		<input type="submit" name="submit" value="Generate QR Code">
	</form>
	<?php if ($data_exist) : ?>
		<?php echo '<img src="./qrimage/'.$last_serial_number.'.png" alt="QR Code">'; ?>
		<!-- <?php echo '<img src="asik.png" alt="QR Code">'; ?> -->
		<p>Last Serial Number : <?php echo $last_serial_number ?></p>
	<?php endif ?>

</body>
</html>