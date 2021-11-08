<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Product.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate product object
  $product= new Product($db);

  // Get  posted data

  $product->name = $_POST["name"];
  $product->price = $_POST["price"];
  $product->category_id = $_POST["category_id"];
  $product->description = $_POST["description"];
  $product->quantity = 1;

  //Handle image upload
  //$folderPath = "/uploads";
  $file_name = $_FILES['product_img']['name'];
  $file_tmp=$_FILES['product_img']['tmp_name'];
  $location='uploads/'.$file_name;
  move_uploaded_file($file_tmp,$location);

  $product->product_img=$location;

  // Set ID to update
  $post->id = $data->id;

  // Update post
  if($post->update_product()) {
    echo json_encode(
      array('message' => 'Product Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'Product Not Updated')
    );
  }

