<?php

class Category {

    // database connection and table name
    private $conn;
    private $table_name = "categories";
    
// object properties
    public $id;
    public $name;
    public $description;
    public $created;


    // constructor with $db as database connection
    public function __construct($db) {
        $this->conn = $db;
    }

    // read products
    public function read() {

        // select all query
        $query = "SELECT *
            FROM
                " . $this->table_name . " c
             
            ORDER BY
                c.created DESC";

        
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

}
