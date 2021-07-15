<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
include('db.php');


$sql='SELECT* FROM orders,customers WHERE customers.customer_id=orders.customer_id';
$result=mysqli_query($db,$sql);
$count=mysqli_num_rows($result);

if($count>0){
    
    $row=mysqli_fetch_all($result,MYSQLI_ASSOC);
    /*After changing the array into json,JSON_NUMERIC check will prevent 
    integers from turning into a string
    */
    echo json_encode($row,JSON_NUMERIC_CHECK);
}
else{
    json_encode(array("message"=>"No Order Found"));
}

?>
