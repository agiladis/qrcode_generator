<?php
$koneksi = mysqli_connect ('localhost','root','','db-serial-number');

// Retrieve the serial number from the database
$sql = "SELECT serial_number FROM identity ORDER BY id DESC LIMIT 1";
$result = mysqli_query($koneksi, $sql);

if (mysqli_num_rows($result) > 0) {
    // Read the serial number from the database
    $row = mysqli_fetch_assoc($result);
    $serial_number = $row["serial_number"];
} else {
    echo "No records found in the database.";
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
	<form method="POST" action="\lib\gn_serial.php">
		<label for="qr_data">Serial number to be generated</label><br>
		<input type="text" id="qr_data" name="qr_data" value= "<?php echo $serial_number; ?>" readonly><br><br>
		<input type="submit" name="submit" value="Generate QR Code">
	</form>

	<?php echo '<img src="qrcode.png" alt="QR Code">'; ?>
</body>
</html>