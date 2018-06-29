<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
</head>
<?php include('Crypto.php') ?>
<?php include('accessDetails.php') ?>
<?php
error_reporting(-1);

$workingKey = CCAVENUE_WORKING_KEY;        //Working Key should be provided here.
$encResponse = $_POST["encResp"];            //This is the response sent by the CCAvenue Server
$rcvdString = decrypt($encResponse, $workingKey);        //Crypto Decryption used as per the specified working key.
$order_status = "";
$decryptValues = explode('&', $rcvdString);
$dataSize = sizeof($decryptValues);

echo "<center>";
echo "<div style='background-color: gray()'>
        <br/>
        <img alt=\"world-congress-of-bioethics-logo\" src=\"http://ijme.in/nbc-20140321/custom/img/14-world-congress-of-bioethics-logo.jpg\" style=\"{float: left}\">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <img alt=\"NBC Logo\" src=\"http://ijme.in/nbc-20140321/custom/img/nbc-logo.jpg\">
        <br/>
    </div>";

for ($i = 0; $i < $dataSize; $i++) {
    $information = explode('=', $decryptValues[$i]);
    if ($i == 3)
        $order_status = $information[1];
}

if ($order_status === "Success") {
    echo "<br><b>Thank you for paying for the registration. Your credit/debit card has been charged and your transaction is successful.</b>";
    echo "<br/><br/><br/><p style='font-size: 30px'><a href='https://docs.google.com/forms/d/e/1FAIpQLSeSKFNF1suEnIW6iTv5NEB0m2KFNHhnB832ZenDbDAGME7esw/viewform?usp=sf_link' target='_blank'>Please fill up the registration form for Main Congress and FAB</a><br/>IMPORTANT: Please fill up the registration form (Main Congress and FAB form) to complete your registration.  
Please note that the registration will only be confirmed upon successful completion of this form.</p>";
} else if ($order_status === "Aborted") {
    echo "<br><b>Thank you for paying for the registration. We will keep you posted regarding the status of your order through e-mail</b>";
} else if ($order_status === "Failure") {
    echo "<br><b>Thank you for your payment request. However, the transaction has been declined.</b>";
} else {
    echo "<br><b>Security Error. Illegal access detected</b>";
}

echo "<br><br>";

if ($order_status === "Success") {
    echo '<p><b>You payment details</b></p>';
}

echo "<table cellspacing=4 cellpadding=4>";
for ($i = 0; $i < $dataSize; $i++) {
    $information = explode('=', $decryptValues[$i]);
    if ($information[0] === 'order_id' || $information[0] === 'tracking_id' || $information[0] === 'bank_ref_no')
        echo '<tr><td>' . $information[0] . '</td><td>' . $information[1] . '</td></tr>';
}

echo "</table><br>";


echo "</center>";
?>
</html>
