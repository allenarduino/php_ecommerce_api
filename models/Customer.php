<?php
class Customer{
      //DB stuff
      private $conn;
      private $table="customers";
  
      //Customer properties
      public $customer_id;
      public $name;
      public $email;
      public $password;
      public $payload;
  
      //Constructor with DB
      public function __construct($db){
          $this->conn=$db;
      }
  
      //Sign customer up
      public function signup(){
          //Create query
         $query='SELECT* FROM '.$this->table.' WHERE email=:email' ;
  
           // Prepare statement
           $stmt = $this->conn->prepare($query);

           // Bind email
           $stmt->bindParam(':email', $this->email);

           // Execute query
           $stmt->execute();
 
          $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
          if($stmt->rowCount()>0){
              return false;
          }
          else{ 
               // Create query
          $query = 'INSERT INTO
          '.$this->table.'
          SET name = :name, 
          email = :email, 
          password= :password, 
          ';

         // Prepare statement
         $stmt = $this->conn->prepare($query);

         // Clean data
         $this->name = htmlspecialchars(strip_tags($this->name));
         $this->email= htmlspecialchars(strip_tags($this->email));
         $this->password = htmlspecialchars(strip_tags($this->password));

         // Bind data
         $stmt->bindParam(':name', $this->name);
         $stmt->bindParam(':email', $this->email);
         $stmt->bindParam(':password', $this->password);

         if($stmt->execute()){
             return true;
         }
            
          }

        
      }
  
      //log customer in
      public function login(){
       $query='SELECT* FROM customers WHERE email='.$this->email.'';
       //prepare statement
       $stmt=$this->conn->prepare($query);
   
       $stmt->execute();
       $userRow=$stmt->fetch(PD0::FETCH_ASSOC);
       //if email or user already exists:
if($userRow>0){
    //Authenticate the user
   
    $encrypted_password=$userRow["password"];
    //checking hash password
    if(password_verify($password,$encrypted_password)){
        $this->payload=$userRow["customer_id"];
        return true;
    }
    else{
      return false;
    }

}
      }
}
?>