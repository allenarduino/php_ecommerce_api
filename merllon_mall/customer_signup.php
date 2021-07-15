<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
include('db.php');

require "vendor/autoload.php";
use \Firebase\JWT\JWT;
$key="xxxxxxxxkkkkkkllllllll";

$name=$_POST["name"];
$email=$_POST["email"];
$password=$_POST["password"];
//Hashing of password
$encrypted_password=password_hash($password,PASSWORD_BCRYPT);

//$email="email@gmail.com";
//$password="mypassword";
$sql="SELECT* FROM admin WHERE email='".$email."'";

$result=mysqli_query($db,$sql);

$count=mysqli_num_rows($result);

//If email already exists?
if($count>0){
    
    echo json_encode(array("error"=>"Customer with email already exists"));
}
else{
   
    //insert form data in the database
$insert = $db->query("INSERT INTO customers (name,email,password) VALUES ('".$name."','".$email."','".$encrypted_password."')");

echo json_encode(array("message"=>"You're registered sucessfully"));

}
?>