<?php

// PDO Database Class
// Connect to database
// Create prepared statment
// Bind values
// Return rows and results

class Database {
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;

    private $dbh; //database handler, use this when execute
    private $stmt;
    private $error;

    public function __construct(){
        //Set DSN
        $dsn = 'mysql:host' . $this->host . ';dbname=' . $this->dbname; 
        $options = array (
            PDO::ATTR_PERSISTENT => true, //persistent connection, it will increase performance
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        // Create PDO instance
        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        } catch(PDOException $e){
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }
}