<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
include('db.php');

$cat_name=$_POST['cat_name'];
$sql="DELETE FROM categories WHERE cat_name='".$cat_name."'";
if (mysqli_query($db,$sql)){
    echo json_encode(array("message"=>"Category deleted"));
}



?>