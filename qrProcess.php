<?php

//exit;
// Include qrcode.php file.
include "qr.php";
//exit;
// Create object
$qc = new QRCODE();
// Create Text Code
//$qc->TEXT("Knowband");

$qc->URL("https://truecarenow.com/PCR.php?id=234");

//$qc->PHONE("01156377326");

// Save QR Code
//$qc->QRCODE(550,"Knowband_url.png");

$qc->QRCODEnow(177, "");
