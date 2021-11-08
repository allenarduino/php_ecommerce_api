<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Customer.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();


  // Instantiate customer object
  $customer = new Customer($db);


  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  $customer->name = $data->name;
  $customer->email = $data->email;
  $customer->password = $data->password;

  
  //Hashing password
  $customer->password=password_hash($customer->password,PASSWORD_BCRYPT);




  // Sign customer up
  if($customer->signup()) {
    echo json_encode(
      array('message' => 'You are registered successfully')
    );
  } else {
    echo json_encode(
      array('message' => 'Customer with email already exists')
    );
  }

