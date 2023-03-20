<html lang="en">

<?php
    include './lib/phpqrcode/qrlib.php';
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scan qrcode</title>
    <script src="./lib/html5-qrcode.min.js"></script>
</head>
<body>
    <center>
        <div style="width: 500px" id="reader"></div>
        <p id="decodedTextElement">Hasil</p>
    </center>

    <script>
        // INITIALIZE
        function onScanSuccess(decodedText, decodedResult) {
            // Handle on success condition with the decoded text or result.
            console.log(`Scan result: ${decodedText}`, decodedResult);
            const decodedTextElement = document.querySelector('#decodedTextElement');
            decodedTextElement.innerHTML = decodedText;
        }

        var html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", { fps: 10, qrbox: 250 });
        html5QrcodeScanner.render(onScanSuccess);

        // STOP SCAN AFTER CODE SCANNED
        var html5QrcodeScanner = new Html5QrcodeScanner(
        "reader", { fps: 10, qrbox: 250 });
        /*
        function onScanSuccess(decodedText, decodedResult) {
            // Handle on success condition with the decoded text or result.
            console.log(`Scan result: ${decodedText}`, decodedResult);
            // ...
            // html5QrcodeScanner.clear();
            // ^ this will stop the scanner (video feed) and clear the scan area.
        }
        */

        // html5QrcodeScanner.render(onScanSuccess);
    </script>
</body>
</html>