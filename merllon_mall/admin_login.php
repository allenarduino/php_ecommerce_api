<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
include('db.php');

require "vendor/autoload.php";
use \Firebase\JWT\JWT;
$key="xxxxxxxxkkkkkkllllllll";

$email=$_POST["email"];
$password=$_POST["password"];

//$email="email@gmail.com";
//$password="mypassword";
$sql="SELECT* FROM admin WHERE email='".$email."' AND password='".$password."'";

$result=mysqli_query($db,$sql);

$count=mysqli_num_rows($result);

if($count>0){
    $row=mysqli_fetch_all($result,MYSQLI_ASSOC);
    $payload=$row;
    $jwt=JWT::encode($payload,$key);
    echo json_encode($jwt);
}
else{
   echo json_encode(array("error"=>"Invalid email or password"));

}
?>