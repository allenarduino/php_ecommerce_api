<?php 
  class Post {
    // DB stuff
    private $conn;
    private $table = 'products';

    // Product Properties
    public $id;
    public $name;
    public $price;
    public $product_img;
    public $category_id;
    public $description;
    public $quantity;
    public $created_at;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

     

    // Fetch Products
    public function fetch_products() {
      // Create query
      $query = 'SELECT* FROM '.$this->table.' ';
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
     $stmt->execute();

      return $stmt;
    }  

    // Fetch Single Product
    public function fetch_single_product() {
          // Create query
          $query = 'SELECT* FROM '.$this->table.' WHERE id=? ';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Bind ID
          $stmt->bindParam(1, $this->id);

          // Execute query
          $stmt->execute();

          $row = $stmt->fetch(PDO::FETCH_ASSOC);

          // Set properties
          $this->name = $row['name'];
          $this->price = $row['price'];
          $this->product_img = $row['product_img'];
          $this->category_id = $row['category_id'];
          $this->description = $row['description'];
          $this->quantity = $row['quantity'];
        
    }

    // Create Product
    public function create_product() {
          // Create query
          $query = 'INSERT INTO
           ' . $this->table . '
           SET name = :name, 
           price = :price, 
           product_img = :product_img, 
           description=:description,
           quantity=:quantity,
           category_id = :category_id';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->title = htmlspecialchars(strip_tags($this->title));
          $this->body = htmlspecialchars(strip_tags($this->body));
          $this->author = htmlspecialchars(strip_tags($this->author));
          $this->category_id = htmlspecialchars(strip_tags($this->category_id));

          // Bind data
          $stmt->bindParam(':name', $this->name);
          $stmt->bindParam(':price', $this->price);
          $stmt->bindParam(':product_img', $this->product_img);
          $stmt->bindParam(':category_id', $this->category_id);
          $stmt->bindParam(':description', $this->description);
          $stmt->bindParam(':quantity', $this->quantity);



          // Execute query
          if($stmt->execute()) {
            return true;
      }

      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
    }

    // Update Product
    public function update_product() {
          // Create query
          $query = 'UPDATE ' . $this->table . '
                                SET name = :name, price = :price, 
                                product_img = :product_img, category_id = :category_id,
                                description=:description,
                                quantity=:quantity,
                                WHERE id = :id';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->name = htmlspecialchars(strip_tags($this->name));
          $this->price = htmlspecialchars(strip_tags($this->price));
          $this->product_img = htmlspecialchars(strip_tags($this->product_img));
          $this->category_id = htmlspecialchars(strip_tags($this->category_id));
          $this->description = htmlspecialchars(strip_tags($this->description));
          $this->quantity = htmlspecialchars(strip_tags($this->quantity));
          $this->id = htmlspecialchars(strip_tags($this->id));

          // Bind data
          $stmt->bindParam(':name', $this->name);
          $stmt->bindParam(':price', $this->price);
          $stmt->bindParam(':product_img', $this->product_img);
          $stmt->bindParam(':category_id', $this->category_id);
          $stmt->bindParam(':description', $this->description);
          $stmt->bindParam(':quantity', $this->quantity);
          $stmt->bindParam(':id', $this->id);

          // Execute query
          if($stmt->execute()) {
            return true;
          }

          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);

          return false;
    }

    // Delete Product
    public function delete_product() {
          // Create query
          $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->id = htmlspecialchars(strip_tags($this->id));

          // Bind data
          $stmt->bindParam(':id', $this->id);

          // Execute query
          if($stmt->execute()) {
            return true;
          }

          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);

          return false;
    }
    
  }