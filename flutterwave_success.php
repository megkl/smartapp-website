<?php
// Include configuration file 

if(isset($_GET['tx'])){       
    $curl = curl_init();
    $tx_id = $_GET['tx'];
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.flutterwave.com/v3/transactions/$tx_id/verify",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json",
           //"Authorization: Bearer FLWSECK_TEST-40ef06d1cb4b962b530402b3842d42f9-X"
            "Authorization: Bearer FLWSECK-386156c6375a0c9ed4905077949f6777-X"
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $result = json_decode($response);
    //print_r($result);
    $payment_method = $result->data->payment_type;
    $paymment_status = $result->status;
    if ($paymment_status == 'success') {
        $pstatus = 'sucess';
    } elseif ($paymment_status == 'error') {
        $pstatus = 'fail';
    }
    $amount = $_GET['amt'];
}

// If transaction data is available in the URL 
if (!empty($_GET['item_number']) && !empty($_GET['tx']) && !empty($_GET['amt']) && !empty($_GET['cc']) && !empty($_GET['st'])) {
    // Get transaction information from URL 
    $item_number = $_GET['item_number'];
    $txn_id = $_GET['tx'];
    $payment_gross = $_GET['amt'];
    $currency_code = $_GET['cc'];
    $payment_status = $_GET['st'];
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Success</title>  
        <?php include('include-css.php'); ?>   
    </head>
    <body class="bg-content-color">
        <div class="container container-bg-set">
            <div class="row text-white top-margin">
                <div class="col-12 text-center">               
                    <h1 class="success">Your Payment has been <?php echo $payment_status; ?></h1>
                    <h4 class="pt-4">Payment Information</h4>
                    <p><b>Reference Number:</b> <?php echo $item_number; ?></p>
                    <p><b>Transaction ID:</b> <?php echo $txn_id; ?></p>
                    <p><b>Paid Amount:</b> <?php echo $payment_gross; ?></p>
                    <p><b>Payment Status:</b> <?php echo $payment_status; ?></p>                
                </div>
            </div>
        </div>
    </body>
</html>
<?php
if ($pstatus == 'fail') {
    header("Location: index.php");
} 
?>