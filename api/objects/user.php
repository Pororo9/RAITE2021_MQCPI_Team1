<?php
class User{ 
    // database connection and table name
    private $conn;
    
    // object properties
    public $id;
    public $User_ID;
    public $User_Name;
    public $Last_Name;
    public $First_Name;
    public $Middle_Name;
    public $Gender;
    public $Email_Address;
    public $Password;
    public $Type_Name;
    public $Type_ID;
    public $Count;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    //read  list
    function readall(){
        // select all query
       $query = "SELECT
       usr.id, User_ID, User_Name, Last_Name, First_Name, Middle_Name, Gender, Email_Address, Type_Name, usr.Type_ID
       FROM
       tbl_user usr
       LEFT JOIN
       tbl_user_type typ
       ON usr.Type_ID = typ.Type_ID
       ORDER BY
       Last_Name ASC";
    
       // prepare query statement
       $stmt = $this->conn->prepare($query);
    
       // execute query
       $stmt->execute();
    
       return $stmt;
   }

       // used when filling up the update product form
    function readOne(){ 
        // query to read single record
        $query = "SELECT
        usr.id, User_ID, User_Name, Last_Name, First_Name, Middle_Name, Gender, Email_Address, Type_Name, usr.Type_ID
        FROM
        tbl_user usr
        LEFT JOIN
        tbl_user_type typ
        ON usr.Type_ID = typ.Type_ID
        WHERE
        User_ID = ?";
            
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
    
        // bind id to be updated
        $stmt->bindParam(1, $this->id);
    
        // execute query
        $stmt->execute();
    
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // set values to object properties
        $this->User_ID = $row['User_ID'];
        $this->User_Name = $row['User_Name'];
        $this->Last_Name = $row['Last_Name'];
        $this->First_Name = $row['First_Name'];
        $this->Middle_Name = $row['Middle_Name'];
        $this->Gender = $row['Gender'];
        $this->Email_Address = $row['Email_Address'];      
        $this->Type_ID = $row['Type_ID']; 
        $this->Type_Name = $row['Type_Name'];
        }
    
    // create
    function create(){
        // query to insert record
        $query = "INSERT INTO
                    tbl_user
                    SET
                    User_ID=:uid,
                    User_Name=:uname, 
                    Last_Name=:lname, 
                    First_Name=:fname, 
                    Middle_Name=:mname, 
                    Gender=:gender,
                    Email_Address=:email,
                    Password=:pass,
                    Type_ID=:code";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->User_ID=htmlspecialchars(strip_tags($this->User_ID));
        $this->User_Name=htmlspecialchars(strip_tags($this->User_Name));
        $this->Last_Name=htmlspecialchars(strip_tags($this->Last_Name));
        $this->First_Name=htmlspecialchars(strip_tags($this->First_Name));
        $this->Middle_Name=htmlspecialchars(strip_tags($this->Middle_Name));
        $this->Gender=htmlspecialchars(strip_tags($this->Gender));
        $this->Email_Address=htmlspecialchars(strip_tags($this->Email_Address));
        $this->Type_ID=htmlspecialchars(strip_tags($this->Type_ID));

        // bind values
        $stmt->bindParam(":uid", $this->User_ID);
        $stmt->bindParam(":uname", $this->User_Name);
        $stmt->bindParam(":lname", $this->Last_Name);
        $stmt->bindParam(":fname", $this->First_Name);
        $stmt->bindParam(":mname", $this->Middle_Name);
        $stmt->bindParam(":gender", $this->Gender);
        $stmt->bindParam(":email", $this->Email_Address);
        $stmt->bindParam(":pass", $this->Password);
        $stmt->bindParam(":code", $this->Type_ID);
        
        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    // update the product
function update(){ 
    // update query
    $query = "UPDATE
            tbl_user
            SET             
            Last_Name=:lname, 
            First_Name=:fname, 
            Middle_Name=:mname, 
            Gender=:gender,
            Email_Address=:email,
            User_Name=:uname,
            Password=:pass,
            Type_ID=:code
            WHERE
            User_ID=:uid";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->User_ID=htmlspecialchars(strip_tags($this->User_ID));
    $this->User_Name=htmlspecialchars(strip_tags($this->User_Name));
    $this->Last_Name=htmlspecialchars(strip_tags($this->Last_Name));
    $this->First_Name=htmlspecialchars(strip_tags($this->First_Name));
    $this->Middle_Name=htmlspecialchars(strip_tags($this->Middle_Name));
    $this->Gender=htmlspecialchars(strip_tags($this->Gender));
    $this->Email_Address=htmlspecialchars(strip_tags($this->Email_Address));
    $this->Type_ID=htmlspecialchars(strip_tags($this->Type_ID));

    // bind values
    $stmt->bindParam(":uid", $this->User_ID);
    $stmt->bindParam(":uname", $this->User_Name);
    $stmt->bindParam(":lname", $this->Last_Name);
    $stmt->bindParam(":fname", $this->First_Name);
    $stmt->bindParam(":mname", $this->Middle_Name);
    $stmt->bindParam(":gender", $this->Gender);
    $stmt->bindParam(":email", $this->Email_Address);
    $stmt->bindParam(":pass", $this->Password);
    $stmt->bindParam(":code", $this->Type_ID);
 
    // execute the query
    if($stmt->execute()){
        return true;
    }
 
    return false;
    }

      // delete the product
    function delete(){ 
        // delete query
        $query = "DELETE FROM tbl_user WHERE User_ID = ?";
        
        // prepare query
        $stmt = $this->conn->prepare($query);
        
        // sanitize
        $this->User_ID=htmlspecialchars(strip_tags($this->User_ID));
        
        // bind id of record to delete
        $stmt->bindParam(1, $this->User_ID);
        
        // execute query
        if($stmt->execute()){
            return true;
        }
        
        return false;
            
        }

    // read products with pagination
    public function readPaging($from_record_num, $records_per_page){ 
        // select query
        $query = "SELECT
                usr.id, User_ID, User_Name, Last_Name, First_Name, Middle_Name, Gender, Email_Address, Type_Name, usr.Type_ID
                FROM
                tbl_user usr
                LEFT JOIN
                tbl_user_type typ
                ON usr.Type_ID = typ.Type_ID
                ORDER BY User_ID ASC
                LIMIT ?, ?";
    
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
        $query = "SELECT COUNT(*) as total_rows FROM tbl_user";
    
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
          // set values to object properties
        $this->total_rows = $row['total_rows'];    
        return $row['total_rows'];
    }

    // search products
    function search($keywords){ 
    // select all query
    $query = "SELECT
        usr.id, User_ID, User_Name, Last_Name, First_Name, Middle_Name, Gender, Email_Address, Type_Name, usr.Type_ID
        FROM
        tbl_user usr
        LEFT JOIN
        tbl_user_type typ
        ON usr.Type_ID = typ.Type_ID
        WHERE
        User_Name LIKE ? OR Last_Name LIKE ? OR User_ID LIKE ?
        ORDER BY
        User_Name ASC";
 
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
        $query = "SELECT * FROM tbl_id  WHERE id ='1'";
            
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
                id='1'";
     
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
