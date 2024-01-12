<?php
session_start();
if (!isset($_SESSION['name']) && !isset($_SESSION['email']) && !isset($_SESSION['id'])) {
    header("location:home.php");
    return false;
}
// Include configuration file 
include_once 'paypal_config.php';

$payment_type = $_SESSION['payment_type'];
if ($payment_type == 'card') {
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
            "Authorization: FLWSECK_TEST-ec5858caa4e66f7d126f2e8ee51baaa2-X"
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $result = json_decode($response);
    $payment_method = $result->data->payment_type;
    $paymment_status = $result->status;
    if ($paymment_status == 'success') {
        $pstatus = 'sucess';
    } elseif ($paymment_status == 'error') {
        $pstatus = 'fail';
    }
    $amount = $_GET['amt'];
} else {
    $payment_method = 'paypal';
    $paymment_status = $_GET['st'];
    if ($paymment_status == 'Completed') {
        $pstatus = 'sucess';
    } elseif ($paymment_status == 'Failed') {
        $pstatus = 'fail';
    }
    $amount = $_SESSION['paypal_amount'];
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
$event_type = $_SESSION['event_type'];
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
    if ($event_type == "daily") {
        header("Location: daily-contest.php");
    } elseif ($event_type == "group") {
        header("Location: group-event.php");
    } elseif ($event_type == "one") {
        header("Location: one-on-one.php");
    } else {
        header("Location: main-event.php");
    }
} else {
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>
    //        var base_url = 'https://topweb.thewrteam.in/';
        var base_url = 'http://localhost/work1/Top_TEN_Web/';
        var session_user_id = "<?= $_SESSION['id'] ?>";
        var payment_method = "<?= $payment_method ?>";
        var transaction_id = "<?= $_GET['tx'] ?>";
        var user_id = <?= htmlspecialchars($_SESSION['id']) ?>;
        var amount = "<?= htmlspecialchars($amount) ?>";
        var event_id =<?= htmlspecialchars($item_number) ?>;
    <?php if ($event_type == "daily") { ?>
            var timer = setTimeout(function () {
                window.location = base_url + 'daily-contest.php';
//                var url = base_url + 'daily-contest-quiz.php';
//                var form = $('<form action="' + url + '" method="post">' +
//                        '<input type="hidden" name="main_event_id" value="' + event_id + '" />' +
//                        '<input type="hidden" name="amount" value="' + amount + '" />' +
//                        '</form>');
//                $('body').append(form);
//                form.submit();
            }, 3000);
    <?php } elseif ($event_type == "group") { ?>
            var timer = setTimeout(function () {
                window.location = base_url + 'group-event.php';
//                var url = base_url + 'group-event-quiz.php';
//                var form = $('<form action="' + url + '" method="post">' +
//                        '<input type="hidden" name="group_event_id" value="' + event_id + '" />' +
//                        '<input type="hidden" name="amount" value="' + amount + '" />' +
//                        '</form>');
//                $('body').append(form);
//                form.submit();
            }, 3000);
    <?php } elseif ($event_type == "one") { ?>
            var timer = setTimeout(function () {
                var url = base_url + 'one-on-one.php';
                var form = $('<form action="' + url + '" method="post">' +
                        '<input type="hidden" name="event_id" value="' + event_id + '" />' +
                        '<input type="hidden" name="amount" value="' + amount + '" />' +
                        '<input type="hidden" name="transaction_id" value="' + transaction_id + '" />' +
                        '<input type="hidden" name="transaction_type" value="' + payment_method + '" />' +
                        '</form>');
                $('body').append(form);
                form.submit();
            }, 3000);
    <?php } else { ?>
            var timer = setTimeout(function () {
                 //window.location = base_url + 'main-event.php';
//                var url = base_url + 'main-event-quiz.php';
//                var form = $('<form action="' + url + '" method="post">' +
//                        '<input type="hidden" name="event_id" value="' + event_id + '" />' +
//                        '<input type="hidden" name="amount" value="' + amount + '" />' +
//                        '</form>');
//                $('body').append(form);
//                form.submit();
            }, 3000);
    <?php } ?>

    </script>

    <script src="assets/js/pages/payment.js"></script>

    <script>
    <?php if ($event_type == "daily") { ?>
            dailyContestPayment();
    <?php } elseif ($event_type == "group") { ?>
            groupEventPayment();
    <?php } elseif ($event_type == "one") { ?>
            oneEventPayment();
    <?php } else { ?>
            mainEventPayment();
        <?php
    }
}
?>
</script>