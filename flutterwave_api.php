<?php
if (isset($_GET['amount'])) {
    $event_id = $_GET['event_id'];
    $id = $_GET['user_id'];
    $email = $_GET['email'];
    $mobile = $_GET['mobile'];
    $amount = $_GET['amount'];
    $name = $_GET['name'];
    $country = $_GET['country'];
    $currency_code = $_GET['currency_code'];
    $cancel_url = "index.php";

    ?>
    <?php include('include-css.php'); ?>   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://checkout.flutterwave.com/v3.js"></script>
    <script>
        $(document).ready(function () {
            makePayment();
        });
        function makePayment() {
            FlutterwaveCheckout({
                //public_key: "FLWPUBK_TEST-60026fa8ae59bfcad45299524ba61a1c-X",
                public_key: "FLWPUBK-2a0eb0b3eeb79b06a4843b8c10a08ab7-X",
                tx_ref: "<?= rand(10, 100) ?>",
                amount: "<?= $amount ?>",
                currency: "<?= $currency_code ?>",
                country: "<?= $country ?>",
                payment_options: "card, mobilemoney",
                customer: {
                    id: "<?= $id ?>",
                    email: "<?= $email ?>",
                    phone_number: "<?= $mobile ?>",
                    name: "<?= $name ?>"
                },
                callback: function (data) { // specified callback function       
                    //console.log(data);
                    var item_number = <?= $event_id; ?>;
                    var tx = data.transaction_id;
                    var amt = data.amount;
                    var cc = data.currency;
                    var st = data.status;
    //                    window.location = "http://localhost/work1/Top_TEN_Web/flutterwave_success.php?item_number=" + item_number + "&tx=" + tx + "&amt=" + amt + "&cc=" + cc + "&st=" + st;
                    window.location = "https://jibunipesa.com/flutterwave_success.php?item_number=" + item_number + "&tx=" + tx + "&amt=" + amt + "&cc=" + cc + "&st=" + st;
                },
                onclose: function () {
                   window.history.go(-1);
    //                    window.location = "http://localhost/work1/Top_TEN_Web/<?= $cancel_url; ?>";
                    //window.location = "https://jibunipesa.com/<?= $cancel_url; //?>";
                },
                customizations: {
                    title: "My store",
                    description: "Payment for items in cart",
                    logo: "https://assets.piedpiper.com/logo.png",
                },
            });
        }
    </script>
    <?php
}
?>