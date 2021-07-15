<?php
require "vendor/autoload.php";
use \Firebase\JWT\JWT;

$key="xxxxxxxxkkkkkkllllllll";
$payload="Allennnnnnnnnnnnn";

$jwt=JWT::encode($payload,$key);

//$decoded = JWT::decode($jwt, $key, array('HS256'));

echo $decoded;
?>