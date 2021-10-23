<?php
class Shipping{ 
    // database connection and table name
    private $conn;
    
    // object properties
    public $id;
    public $Shipping_ID;
    public $Route_ID;
    public $Shipping_Destination;
    public $Shipping_Recipient;
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    
    //read product list
    function read(){
    // select all query
    $query = "SELECT * FROM tbl_shipping ORDER BY Shipping_ID ASC";
   
    // prepare query statement
    $stmt = $this->conn->prepare($query);
   
    // execute query
    $stmt->execute();
   
    return $stmt;
    }

    //read  list
    function readall(){
        // select all query
       $query = "SELECT * FROM tbl_shipping ORDER BY Shipping_ID ASC";
                 
       // prepare query statement
       $stmt = $this->conn->prepare($query);
    
       // execute query
       $stmt->execute();
    
       return $stmt;
   }

    // used when filling up the update product form
    function readOne(){ 
        // query to read single record
        $query = "SELECT * FROM tbl_shipping WHERE Shipping_ID = ?";
        
            
        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        // bind id to be updated
        $stmt->bindParam(1, $this->id);

        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->Shipping_ID = $row['Shipping_ID'];
        $this->Route_ID = $row['Route_ID'];
        $this->Shipping_Destination = $row['Shipping_Destination'];  
        $this->Shipping_Recipient = $row['Shipping_Recipient'];        
    }

        // create
    function create(){
        // query to insert record
        $query = "INSERT INTO
            tbl_shipping
            SET
            Shipping_ID=:Shipping_ID, 
            Route_ID=:Route_ID, 
            Shipping_Destination=:Shipping_Destination,
            Shipping_Recipient=:Shipping_Recipient";
                   

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->Shipping_ID=htmlspecialchars(strip_tags($this->Shipping_ID));
        $this->Route_ID=htmlspecialchars(strip_tags($this->Route_ID));
        $this->Shipping_Destination=htmlspecialchars(strip_tags($this->Shipping_Destination));
        $this->Shipping_Recipient=htmlspecialchars(strip_tags($this->Shipping_Recipient));
       
        // bind values
        $stmt->bindParam(":Shipping_ID", $this->Shipping_ID);
        $stmt->bindParam(":Route_ID", $this->Route_ID);
        $stmt->bindParam(":Shipping_Destination", $this->Shipping_Destination);
        $stmt->bindParam(":Shipping_Recipient", $this->Shipping_Recipient);
        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    function update(){ 
        // update query
        $query = "UPDATE
            tbl_shipping
            SET            
            Route_ID=:Route_ID, 
            Shipping_Destination=:Shipping_Destination,
            Shipping_Recipient=:Shipping_Recipient      
            WHERE
            Shipping_ID=:Shipping_ID";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
     
        // sanitize
        $this->Route_ID=htmlspecialchars(strip_tags($this->Route_ID));
        $this->Shipping_Destination=htmlspecialchars(strip_tags($this->Shipping_Destination));
        $this->Shipping_Recipient=htmlspecialchars(strip_tags($this->Shipping_Recipient));
        $this->Shipping_ID=htmlspecialchars(strip_tags($this->Shipping_ID));
       
    
        // bind values
        $stmt->bindParam(":Shipping_ID", $this->Shipping_ID);
        $stmt->bindParam(":Route_ID", $this->Route_ID);
        $stmt->bindParam(":Shipping_Destination", $this->Shipping_Destination);    
        $stmt->bindParam(":Shipping_Recipient", $this->Shipping_Recipient);     
     
        // execute the query
        if($stmt->execute()){
            return true;
        }
     
        return false;
    }

      // delete the product
      function delete(){ 
        // delete query
        $query = "DELETE FROM tbl_shipping WHERE Shipping_ID = ?";
        
        // prepare query
        $stmt = $this->conn->prepare($query);
        
        // sanitize
        $this->Shipping_ID=htmlspecialchars(strip_tags($this->Shipping_ID));
        
        // bind id of record to delete
        $stmt->bindParam(1, $this->Shipping_ID);
        
        // execute query
        if($stmt->execute()){
            return true;
        }
        
        return false;
    }  
        
      // read products with pagination
      public function readPaging($from_record_num, $records_per_page){ 
        // select query
        $query = "SELECT * FROM tbl_shipping ORDER BY Shipping_ID ASC LIMIT ?, ?";
    
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
    
        // bind variable values
        $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
        $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);
    
        // execute query
        $stmt->execute();
    
        // return values from database
        return $stmt;
    }

    // used for paging products
    public function count(){
        $query = "SELECT COUNT(*) as total_rows FROM tbl_shipping";
    
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $row['total_rows'];
    }

    // search products
    function search($keywords){ 
        // select all query
        $query = "SELECT *  FROM tbl_shipping WHERE Shipping_ID LIKE ? OR Route_ID LIKE ? OR Shipping_Destination LIKE ? ORDER BY Shipping_ID ASC";
     
        // prepare query statement
        $stmt = $this->conn->prepare($query);
     
        // sanitize
        $keywords=htmlspecialchars(strip_tags($keywords));
        $keywords = "%{$keywords}%";
     
        // bind
        $stmt->bindParam(1, $keywords);
        $stmt->bindParam(2, $keywords);
        $stmt->bindParam(3, $keywords);
     
        // execute query
        $stmt->execute();
     
        return $stmt;
    }

    function getCount(){ 
        // query to read single record
        $query = "SELECT * FROM tbl_id  WHERE id ='3'";
            
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
                
        // execute query
        $stmt->execute();
    
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // set values to object properties
        $this->Count = $row['Count'];          
    }


    function updateCount(){ 
        // update query
        $query = "UPDATE
                tbl_id
                SET
                Count=:count
                WHERE
                id='3'";
     
        // prepare query statement
        $stmt = $this->conn->prepare($query);
     
        // sanitize
        $this->Count=htmlspecialchars(strip_tags($this->Count));
      
    
        // bind values
        $stmt->bindParam(":count", $this->Count);
           
        // execute the query
        if($stmt->execute()){
            return true;
        }
     
        return false;
        }
}
?>

