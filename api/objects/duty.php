<?php
class Duty{ 
    // database connection and table name
    private $conn;
    
    // object properties
    public $id;
    public $Duty_ID;
    public $Duty_Description;
    public $Rank_ID;
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    
    //read product list
    function read(){
    // select all query
    $query = "SELECT * FROM tbl_duty ORDER BY Duty_Description ASC";
   
    // prepare query statement
    $stmt = $this->conn->prepare($query);
   
    // execute query
    $stmt->execute();
   
    return $stmt;
    }

    //read  list
    function readall(){
        // select all query
       $query = "SELECT * FROM tbl_duty ORDER BY Duty_ID ASC";
                 
       // prepare query statement
       $stmt = $this->conn->prepare($query);
    
       // execute query
       $stmt->execute();
    
       return $stmt;
   }

    // used when filling up the update product form
    function readOne(){ 
        // query to read single record
        $query = "SELECT * FROM tbl_duty WHERE Duty_ID = ?";
        
            
        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        // bind id to be updated
        $stmt->bindParam(1, $this->id);

        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->Duty_ID = $row['Duty_ID'];
        $this->Duty_Description = $row['Duty_Description'];
        $this->Rank_ID = $row['Rank_ID'];        
    }

        // create
    function create(){
        // query to insert record
        $query = "INSERT INTO
            tbl_duty
            SET
            Duty_ID=:code, 
            Duty_Description=:name, 
            Rank_ID=:desc";
                   

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->Duty_ID=htmlspecialchars(strip_tags($this->Duty_ID));
        $this->Duty_Description=htmlspecialchars(strip_tags($this->Duty_Description));
        $this->Rank_ID=htmlspecialchars(strip_tags($this->Rank_ID));
       
        // bind values
        $stmt->bindParam(":code", $this->Duty_ID);
        $stmt->bindParam(":name", $this->Duty_Description);
        $stmt->bindParam(":desc", $this->Rank_ID);
              
        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    function update(){ 
        // update query
        $query = "UPDATE
            tbl_duty
            SET            
            Duty_Description=:name, 
            Rank_ID=:desc       
            WHERE
            Duty_ID=:code";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
     
        // sanitize
        $this->Duty_Description=htmlspecialchars(strip_tags($this->Duty_Description));
        $this->Rank_ID=htmlspecialchars(strip_tags($this->Rank_ID));
        $this->Duty_ID=htmlspecialchars(strip_tags($this->Duty_ID));
       
    
        // bind values
        $stmt->bindParam(":code", $this->Duty_ID);
        $stmt->bindParam(":name", $this->Duty_Description);
        $stmt->bindParam(":desc", $this->Rank_ID);     
     
        // execute the query
        if($stmt->execute()){
            return true;
        }
     
        return false;
    }

      // delete the product
      function delete(){ 
        // delete query
        $query = "DELETE FROM tbl_duty WHERE Duty_ID = ?";
        
        // prepare query
        $stmt = $this->conn->prepare($query);
        
        // sanitize
        $this->Duty_ID=htmlspecialchars(strip_tags($this->Duty_ID));
        
        // bind id of record to delete
        $stmt->bindParam(1, $this->Duty_ID);
        
        // execute query
        if($stmt->execute()){
            return true;
        }
        
        return false;
    }  
        
      // read products with pagination
      public function readPaging($from_record_num, $records_per_page){ 
        // select query
        $query = "SELECT * FROM tbl_duty ORDER BY Duty_ID ASC LIMIT ?, ?";
    
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
        $query = "SELECT COUNT(*) as total_rows FROM tbl_duty";
    
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $row['total_rows'];
    }

    // search products
    function search($keywords){ 
        // select all query
        $query = "SELECT *  FROM tbl_duty WHERE Duty_ID LIKE ? OR Duty_Description LIKE ? OR Rank_ID LIKE ? ORDER BY Duty_ID ASC";
     
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

