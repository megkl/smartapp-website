<?php
//define('PAYPAL_ID', 'sb-fpxn62300563@business.example.com');

define('PAYPAL_ID', 'tellarideke@gmail.com'); 
define('PAYPAL_SANDBOX', FALSE); //TRUE or FALSE 
//define('PAYPAL_SANDBOX', TRUE); //TRUE or FALSE 
// 
define('PAYPAL_RETURN_URL', 'http://top10contest.com/success.php'); 
define('PAYPAL_CANCEL_URL', 'http://top10contest.com/main-event.php'); 
define('PAYPAL_NOTIFY_URL', 'http://top10contest.com/inp.php'); 

// Change not required 
define('PAYPAL_URL', (PAYPAL_SANDBOX == true)?"https://www.sandbox.paypal.com/cgi-bin/webscr":"https://www.paypal.com/cgi-bin/webscr");