<?php
$koneksi = mysqli_connect ('localhost','root','','db-serial-number');
include ('/phpqrcode/qrlib.php');

// Generate the new serial number
$prefix = "LST-0323-"; // Define the prefix
$serial_number = $prefix . sprintf('%04d', 1); // Set the initial serial number to LST-0323-0001

// Check if a record containing the last serial number exists in the database
$sql = "SELECT serial_number FROM identity ORDER BY id DESC LIMIT 1";
$result = mysqli_query($koneksi, $sql);

if (mysqli_num_rows($result) > 0) {
    // Read the last serial number from the database and increment it
    $row = mysqli_fetch_assoc($result);
    $last_serial_number = intval(substr($row["serial_number"], -4));
    $serial_number = $prefix . sprintf('%04d', $last_serial_number + 1);
}

// Insert the new serial number into the database
$sql = "INSERT INTO identity (serial_number) VALUES ('$serial_number')";
if (mysqli_query($koneksi, $sql)) {
    echo "New record created successfully. Serial number is $serial_number";
    echo "<script>alert('New record created successfully.');</script>";
    echo "<script>window.location.href='index.php';</script>";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
}

QRcode::png($serial_number, "qrcode.png");


// $qr_data = '';

// // Check if form was submitted
// if(isset($_POST['submit'])) {
// // Get QR code data from form input
//     $qr_data = $_POST['qr_data'];
// 	}

// 		// Generate QR code
// 	QRcode::png($qr_data, "qrcode.png");

// 		// Display QR code
// 	echo '<img src="qrcode.png" alt="QR Code">';
?>
