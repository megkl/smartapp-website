<?php

include_once('jwt.php');

define('JWT_SECRET_KEY','9604b46148d3b7c56217b8d25d0e91a1');

function generate_token() {
    $jwt = new JWT();
    $payload = [
        'iat' => time(), /* issued at time */
        'iss' => 'top10',
        'exp' => time() + (30*60*60*24), /* expires after 1 minute */
        'sub' => 'top10 Authentication'
    ];
    $token = $jwt::encode($payload, JWT_SECRET_KEY);
    print_r(json_encode($token));
}
// generate_token();
$token = generate_token();
echo $token;

?>