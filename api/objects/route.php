<?php
class Route{ 
    // database connection and table name
    private $conn;
    
    // object properties
    public $id;
    public $Route_ID;
    public $Destination;
    public $Latitude;
    public $Longitude;
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    
    //read product list
    function read(){
    // select all query
    $query = "SELECT * FROM tbl_route ORDER BY Route_ID ASC";
   
    // prepare query statement
    $stmt = $this->conn->prepare($query);
   
    // execute query
    $stmt->execute();
   
    return $stmt;
    }

    //read  list
    function readall(){
        // select all query
       $query = "SELECT * FROM tbl_route ORDER BY Route_ID ASC";
                 
       // prepare query statement
       $stmt = $this->conn->prepare($query);
    
       // execute query
       $stmt->execute();
    
       return $stmt;
   }

    // used when filling up the update product form
    function readOne(){ 
        // query to read single record
        $query = "SELECT * FROM tbl_route WHERE Route_ID = ?";
        
            
        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        // bind id to be updated
        $stmt->bindParam(1, $this->id);

        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->Route_ID = $row['Route_ID'];
        $this->Destination = $row['Destination'];
        $this->Latitude = $row['Latitude'];  
        $this->Longitude = $row['Longitude'];        
    }

        // create
    function create(){
        // query to insert record
        $query = "INSERT INTO
            tbl_route
            SET
            Route_ID=:Route_ID, 
            Destination=:Destination, 
            Latitude=:Latitude,
            Longitude=:Longitude";
                   

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->Route_ID=htmlspecialchars(strip_tags($this->Route_ID));
        $this->Destination=htmlspecialchars(strip_tags($this->Destination));
        $this->Latitude=htmlspecialchars(strip_tags($this->Latitude));
        $this->Longitude=htmlspecialchars(strip_tags($this->Longitude));
       
        // bind values
        $stmt->bindParam(":Route_ID", $this->Route_ID);
        $stmt->bindParam(":Destination", $this->Destination);
        $stmt->bindParam(":Latitude", $this->Latitude);
        $stmt->bindParam(":Longitude", $this->Longitude);
        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    function update(){ 
        // update query
        $query = "UPDATE
            tbl_route
            SET            
            Destination=:Destination, 
            Latitude=:Latitude,
            Longitude=:Longitude      
            WHERE
            Route_ID=:Route_ID";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
     
        // sanitize
        $this->Destination=htmlspecialchars(strip_tags($this->Destination));
        $this->Latitude=htmlspecialchars(strip_tags($this->Latitude));
        $this->Longitude=htmlspecialchars(strip_tags($this->Longitude));
        $this->Route_ID=htmlspecialchars(strip_tags($this->Route_ID));
       
    
        // bind values
        $stmt->bindParam(":Route_ID", $this->Route_ID);
        $stmt->bindParam(":Destination", $this->Destination);
        $stmt->bindParam(":Latitude", $this->Latitude);    
        $stmt->bindParam(":Longitude", $this->Longitude);     
     
        // execute the query
        if($stmt->execute()){
            return true;
        }
     
        return false;
    }

      // delete the product
      function delete(){ 
        // delete query
        $query = "DELETE FROM tbl_route WHERE Route_ID = ?";
        
        // prepare query
        $stmt = $this->conn->prepare($query);
        
        // sanitize
        $this->Route_ID=htmlspecialchars(strip_tags($this->Route_ID));
        
        // bind id of record to delete
        $stmt->bindParam(1, $this->Route_ID);
        
        // execute query
        if($stmt->execute()){
            return true;
        }
        
        return false;
    }  
        
      // read products with pagination
      public function readPaging($from_record_num, $records_per_page){ 
        // select query
        $query = "SELECT * FROM tbl_route ORDER BY Route_ID ASC LIMIT ?, ?";
    
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
        $query = "SELECT COUNT(*) as total_rows FROM tbl_route";
    
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $row['total_rows'];
    }

    // search products
    function search($keywords){ 
        // select all query
        $query = "SELECT *  FROM tbl_route WHERE Route_ID LIKE ? OR Destination LIKE ? OR Latitude LIKE ? ORDER BY Route_ID ASC";
     
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

