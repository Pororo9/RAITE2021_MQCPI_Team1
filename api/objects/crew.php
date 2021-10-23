<?php
class Crew{ 
    // database connection and table name
    private $conn;
    
    // object properties
    public $id;
    public $Crew_ID;
    public $Last_Name;
    public $First_Name;
    public $Middle_Name;
    public $Birthday;
    public $Age;
    public $Email_Address;
    public $Home_Address;
    public $Mobile_Number;
    public $Rank_ID;
    public $Count;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    //read  list
    function readall(){
        // select all query
       $query = "SELECT
       crw.id, Crew_ID, Last_Name, First_Name, Middle_Name, Birthday, Age, Email_Address, Home_Address, Mobile_Number, crw.Rank_ID
       FROM
       tbl_crew crw
       LEFT JOIN
       tbl_rank rnk
       ON crw.Rank_ID = rnk.Rank_ID
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
        crw.id, Crew_ID, Last_Name, First_Name, Middle_Name, Birthday, Age, Email_Address, Home_Address, Mobile_Number, crw.Rank_ID
        FROM
        tbl_crew crw
        LEFT JOIN
        tbl_rank rnk
        ON crw.Rank_ID = rnk.Rank_ID
        WHERE
        Crew_ID = ?";
            
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
    
        // bind id to be updated
        $stmt->bindParam(1, $this->id);
    
        // execute query
        $stmt->execute();
    
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // set values to object properties
        $this->Crew_ID = $row['Crew_ID'];
        $this->Last_Name = $row['Last_Name'];
        $this->First_Name = $row['First_Name'];
        $this->Middle_Name = $row['Middle_Name'];
        $this->Birthday = $row['Birthday'];
        $this->Age = $row['Age'];     
        $this->Email_Address = $row['Email_Address'];     
        $this->Mobile_Number = $row['Mobile_Number']; 
        $this->Rank_ID = $row['Rank_ID'];
        }
    
    // create
    function create(){
        // query to insert record
        $query = "INSERT INTO
                    tbl_user
                    SET
                    Crew_ID=:uid,
                    User_Name=:uname, 
                    Last_Name=:lname, 
                    First_Name=:fname, 
                    Middle_Name=:mname, 
                    Birthday=:Birthday,
                    Age=:email,
                    Email_Address=:pass,
                    Mobile_Number=:code";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->Crew_ID=htmlspecialchars(strip_tags($this->Crew_ID));
        $this->User_Name=htmlspecialchars(strip_tags($this->User_Name));
        $this->Last_Name=htmlspecialchars(strip_tags($this->Last_Name));
        $this->First_Name=htmlspecialchars(strip_tags($this->First_Name));
        $this->Middle_Name=htmlspecialchars(strip_tags($this->Middle_Name));
        $this->Birthday=htmlspecialchars(strip_tags($this->Birthday));
        $this->Age=htmlspecialchars(strip_tags($this->Age));
        $this->Mobile_Number=htmlspecialchars(strip_tags($this->Mobile_Number));

        // bind values
        $stmt->bindParam(":uid", $this->Crew_ID);
        $stmt->bindParam(":uname", $this->User_Name);
        $stmt->bindParam(":lname", $this->Last_Name);
        $stmt->bindParam(":fname", $this->First_Name);
        $stmt->bindParam(":mname", $this->Middle_Name);
        $stmt->bindParam(":Birthday", $this->Birthday);
        $stmt->bindParam(":email", $this->Age);
        $stmt->bindParam(":pass", $this->Email_Address);
        $stmt->bindParam(":code", $this->Mobile_Number);
        
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
            Birthday=:Birthday,
            Age=:email,
            User_Name=:uname,
            Email_Address=:pass,
            Mobile_Number=:code
            WHERE
            Crew_ID=:uid";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->Crew_ID=htmlspecialchars(strip_tags($this->Crew_ID));
    $this->User_Name=htmlspecialchars(strip_tags($this->User_Name));
    $this->Last_Name=htmlspecialchars(strip_tags($this->Last_Name));
    $this->First_Name=htmlspecialchars(strip_tags($this->First_Name));
    $this->Middle_Name=htmlspecialchars(strip_tags($this->Middle_Name));
    $this->Birthday=htmlspecialchars(strip_tags($this->Birthday));
    $this->Age=htmlspecialchars(strip_tags($this->Age));
    $this->Mobile_Number=htmlspecialchars(strip_tags($this->Mobile_Number));

    // bind values
    $stmt->bindParam(":uid", $this->Crew_ID);
    $stmt->bindParam(":uname", $this->User_Name);
    $stmt->bindParam(":lname", $this->Last_Name);
    $stmt->bindParam(":fname", $this->First_Name);
    $stmt->bindParam(":mname", $this->Middle_Name);
    $stmt->bindParam(":Birthday", $this->Birthday);
    $stmt->bindParam(":email", $this->Age);
    $stmt->bindParam(":pass", $this->Email_Address);
    $stmt->bindParam(":code", $this->Mobile_Number);
 
    // execute the query
    if($stmt->execute()){
        return true;
    }
 
    return false;
    }

      // delete the product
    function delete(){ 
        // delete query
        $query = "DELETE FROM tbl_user WHERE Crew_ID = ?";
        
        // prepare query
        $stmt = $this->conn->prepare($query);
        
        // sanitize
        $this->Crew_ID=htmlspecialchars(strip_tags($this->Crew_ID));
        
        // bind id of record to delete
        $stmt->bindParam(1, $this->Crew_ID);
        
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
                usr.id, Crew_ID, User_Name, Last_Name, First_Name, Middle_Name, Birthday, Age, Home_Address, usr.Mobile_Number
                FROM
                tbl_user usr
                LEFT JOIN
                tbl_user_type typ
                ON usr.Mobile_Number = typ.Mobile_Number
                ORDER BY Crew_ID ASC
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
    public function Rank_ID(){
        $query = "SELECT Rank_ID(*) as total_rows FROM tbl_user";
    
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
        usr.id, Crew_ID, User_Name, Last_Name, First_Name, Middle_Name, Birthday, Age, Home_Address, usr.Mobile_Number
        FROM
        tbl_user usr
        LEFT JOIN
        tbl_user_type typ
        ON usr.Mobile_Number = typ.Mobile_Number
        WHERE
        User_Name LIKE ? OR Last_Name LIKE ? OR Crew_ID LIKE ?
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

    function getRank_ID(){ 
        // query to read single record
        $query = "SELECT * FROM tbl_id  WHERE id ='1'";
            
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
                
        // execute query
        $stmt->execute();
    
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // set values to object properties
        $this->Rank_ID = $row['Rank_ID'];          
    }


    function updateRank_ID(){ 
        // update query
        $query = "UPDATE
                tbl_id
                SET
                Rank_ID=:Rank_ID
                WHERE
                id='1'";
     
        // prepare query statement
        $stmt = $this->conn->prepare($query);
     
        // sanitize
        $this->Rank_ID=htmlspecialchars(strip_tags($this->Rank_ID));
      
    
        // bind values
        $stmt->bindParam(":Rank_ID", $this->Rank_ID);
           
        // execute the query
        if($stmt->execute()){
            return true;
        }
     
        return false;
        }
    



}
?>
