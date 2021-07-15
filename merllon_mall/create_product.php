<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
$valid_extensions = array('jpeg', 'jpg', 'png',);
//$uploadDir = 'uploads/'; 

include('db.php');
 

    // Get the submitted form data 
    $name=$_POST['product_name'];
    $price=$_POST['price'];
    //$product_img=$_POST['product_img'];
    $category=$_POST['category'];
    $quantity=1;


   //$folderPath = "/uploads";
    
   $file_name = $_FILES['product_img']['name'];
   $file_tmp=$_FILES['product_img']['tmp_name'];
   $location='uploads/'.$file_name;
   move_uploaded_file($file_tmp,$location);

   $insert = $db->query("INSERT INTO products (name,price,product_img,category,quantity) VALUES ('".$name."','".$price."','".$location."','".$category."','".$quantity."')");


echo json_encode(
    array("message"=>"Product Created")
);


            
        
 