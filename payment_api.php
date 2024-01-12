<?php
// Include configuration file 
include_once './paypal_config.php';

if (isset($_GET['amount'])) {
    $title = $_GET['title'];
    $id = $_GET['id'];
    $amount = $_GET['amount'];

    $currencyUrl = "https://quiz.jibunipesa.com/api-v2.php?access_key=6808&get_currency_rate=1";
    $currencyDetails = file_get_contents($currencyUrl);
    $data = json_decode($currencyDetails);
    $rate = ($data->{'data'});
    //echo $rate;
    //$rate = 0.009246;
    $total_converted_currency_amount = $amount * $rate;
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#paypal-form").submit();
        });
    </script>
    <div class="container">

        <div class="pro-box">
            <div class="body">

                <!-- PayPal payment form for displaying the buy button -->
                <form action="<?php echo PAYPAL_URL; ?>" method="post" id='paypal-form'>
                    <!-- Identify your business so that you can collect the payments. -->
                    <input type="hidden" name="business" value="<?php echo PAYPAL_ID; ?>">

                    <!-- Specify a Buy Now button. -->
                    <input type="hidden" name="cmd" value="_xclick">

                    <!-- Specify details about the item that buyers will purchase. -->
                    <input type="hidden" name="item_name" id='item_name'  value="<?php echo $title; ?>">
                    <input type="hidden" name="item_number" id='item_id' value="<?php echo $id; ?>">
                    <input type="hidden" name="amount" id='amount' value="<?php echo $total_converted_currency_amount; ?>">
                    <input type="hidden" name="currency_code" id='currency' value="USD">

                    <!-- Specify URLs -->
                    <input type="hidden" name="return" id='return_url' value="<?php echo PAYPAL_RETURN_URL; ?>">
                    <input type="hidden" name="notify_url" value="<?php echo PAYPAL_NOTIFY_URL; ?>">
                    <input type="hidden" name="cancel_return" value="<?php echo PAYPAL_CANCEL_URL; ?>">

                </form>
            </div>
        </div>

    </div>

<?php } ?>