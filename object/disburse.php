<?php
class Disburse{
 
    // database connection and table name
    private $conn;
    private $table_name = "disburse";
 
    // object properties
    public $id;
    public $time_served;
    public $receipt;
    public $status;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    
function read(){
 
    // select all query
    $query = "SELECT
                 id, time_served, receipt, status
            FROM
                " . $this->table_name . ""
             ;
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // execute query
    $stmt->execute();
 
    return $stmt;
}

function create(){
 
    // query to insert record
    $query = "INSERT INTO
                " . $this->table_name . "
            SET
                time_served=:time_served, receipt=:receipt, status=:status";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->time_served=htmlspecialchars(strip_tags($this->time_served));
    $this->receipt=htmlspecialchars(strip_tags($this->receipt));
    $this->status=htmlspecialchars(strip_tags($this->status));
 
    // bind values
    $stmt->bindParam(":time_served", $this->time_served);
    $stmt->bindParam(":receipt", $this->receipt);
    $stmt->bindParam(":status", $this->status);
 
    // execute query
    if($stmt->execute()){
        return true;
    }
 
    return false;
     
}

function readOne(){
 
    // query to read single record
    $query = "SELECT
                *
            FROM
                " . $this->table_name . "
            
            WHERE
                id = ?
            LIMIT
                0,1";
 
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
 
    // bind id of product to be updated
    $stmt->bindParam(1, $this->id);
 
    // execute query
    $stmt->execute();
 
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    // set values to object properties
    $this->time_served = $row['time_served'];
    $this->receipt = $row['receipt'];
    $this->status = $row['status'];
}

function update(){
 
    // update query
    $query = "UPDATE
                " . $this->table_name . "
            SET
                time_served = :time_served,
                receipt = :receipt,
                status = :status
            WHERE
                id = :id";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->time_served=htmlspecialchars(strip_tags($this->time_served));
    $this->receipt=htmlspecialchars(strip_tags($this->receipt));
    $this->status=htmlspecialchars(strip_tags($this->status));
    $this->id=htmlspecialchars(strip_tags($this->id));
 
    // bind new values
    $stmt->bindParam(':time_served', $this->time_served);
    $stmt->bindParam(':receipt', $this->receipt);
    $stmt->bindParam(':status', $this->status);
    $stmt->bindParam(':id', $this->id);
 
    // execute the query
    if($stmt->execute()){
        return true;
    }
 
    return false;
}

function delete(){
 
    // delete query
    $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->id=htmlspecialchars(strip_tags($this->id));
 
    // bind id of record to delete
    $stmt->bindParam(1, $this->id);
 
    // execute query
    if($stmt->execute()){
        return true;
    }
 
    return false;
     
}

}
?>