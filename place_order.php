<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
include('db.php');


require "vendor/autoload.php";
use \Firebase\JWT\JWT;
$key="xxxxxxxxkkkkkkllllllll";

//Get submitted form data from client
$customer_token=$_POST["customer_token"];
$address=$_POST["address"];
$telephone_number=$_POST["telephone_number"];

$cart_items=$_POST["cart_items"];
$cart_items=json_decode($cart_items,true);

$decoded_customer_token=JWT::decode($customer_token,$key,array('HS256'));
$customer_id=json_decode($decoded_customer_token);

$insert = $db->query("INSERT INTO orders (customer_id,address,telephone_number) VALUES ('".$customer_id."','".$address."','".$telephone_number."')");


//$insert=$db->query("INSERT INTO orders(customer_id,address,telephone_number)VALUES ('".$customer_token."','".$address."','".$telephone_number."'");



//This if statement below is for handling order_items

    $order_id=$db->insert_id;
    foreach($cart_items as $item){
        $sql="INSERT INTO order_items(order_id,product_id,quantity) VALUES ('".$order_id."','".$item['id']."','".$item['quantity']."')
        ";

        //insert order items into database
        $insertOrderItems=$db->multi_query($sql);
}

echo json_encode(
    array("message"=>"Order Placed Successfully")
);

?>