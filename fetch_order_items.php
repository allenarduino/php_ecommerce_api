<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
include('db.php');

$id=$_GET['id'];
$sql="SELECT* FROM products,order_items,orders WHERE products.id=order_items.product_id
AND order_items.order_id='".$id."' ";

$result=mysqli_query($db,$sql);

$count=mysqli_num_rows($result);

if($count>0){
    $row=mysqli_fetch_all($result,MYSQLI_ASSOC);
    echo json_encode($row);
}
else{
    json_encode(array("message"=>"No product Found"));
}


?>