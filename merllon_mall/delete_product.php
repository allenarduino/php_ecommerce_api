<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
include('db.php');

$id=$_POST['id'];
$sql="DELETE FROM products WHERE id='".$id."'";
if (mysqli_query($db,$sql)){
    echo json_encode(array("message"=>"Product deleted"));
}



?>