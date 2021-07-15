<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
include('db.php');


$sql='SELECT* FROM categories';
$result=mysqli_query($db,$sql);

$count=mysqli_num_rows($result);

if($count>0){
    $row=mysqli_fetch_all($result,MYSQLI_ASSOC);
    echo json_encode($row);
}
else{
    json_encode(array("message"=>"No category found"));
}

?>

