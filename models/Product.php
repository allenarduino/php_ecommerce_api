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

  // Product  query
  $result = $product->fetch_products();
  // Get row count
  $num = $result->rowCount();

  // Check if any products
  if($num > 0) {
    // Products array
    $products_arr = array();
    // $products_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $product_item = array(
        'id' => $id,
        'name' => $name,
        'price' => $price,
        'description' => $description,
        'quantity'=>$quantity,

     
      );

      // Push to "data"
      array_push($products_arr, $product_item);
      // array_push($products_arr['data'], $product_item);
    }

    // Turn to JSON & output
    echo json_encode($products_arr);

  } else {
    // No Posts
    echo json_encode(
      array('message' => 'No Products Found')
    );
  }