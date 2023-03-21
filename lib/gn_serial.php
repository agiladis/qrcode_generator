<?php
include '../inc/koneksi.php';
include '../lib/phpqrcode/qrlib.php';

// Generate the new serial number
$prefix = "SN-"; // Define the prefix
$serial_number = $prefix . sprintf('%04d', 1); // Set the initial serial number to LST-0323-0001

// Check if a record containing the last serial number exists in the database
$sql = "SELECT * FROM product ORDER BY id_product DESC LIMIT 1";
$result = mysqli_query($koneksi, $sql);

if (mysqli_num_rows($result) > 0) {
    // Read the last serial number from the database and increment it
    $row = mysqli_fetch_assoc($result);
    $last_serial_number = intval(substr($row["serial_number"], -4));
    $serial_number = $prefix . sprintf('%04d', $last_serial_number + 1);
}

// Insert the new serial number into the database
$sql = "INSERT INTO product (serial_number, qr_image_path) VALUES ('$serial_number', 'qrimage/$serial_number.png')";
if (mysqli_query($koneksi, $sql)) {
    echo "New record created successfully. Serial number is $serial_number";
    echo "<script>alert('New record created successfully.');</script>";
    
    // if success store data to databse create image file
    QRcode::png($serial_number, dirname(__DIR__)."/qrimage/$serial_number.png");

    // redirect to other index page
    header("Location: ../index.php?");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
}



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
