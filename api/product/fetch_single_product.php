<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Product.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate product object
  $product = new Product($db);

  // Get ID
  $product->id = isset($_GET['id']) ? $_GET['id'] : die();

  // Get singple product
  $post->fetch_single_product();

  // Create array
  $product_arr = array(
    'id' => $product->id,
    'name' => $product->name,
    'price' => $product->price,
    'product_img' => $product->product_img,
    'category_id' => $product->category_id,
    'description' => $product->description,
    'quantity'=>$product->quantity,
   
  );

  // Make JSON
  print_r(json_encode($product_arr));