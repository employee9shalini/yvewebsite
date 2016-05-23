<?php

/**
 * Created by PhpStorm.
 * User: Narendra
 * Date: 3/25/2015
 * Time: 3:47 PM
 */

class DbConnect {

    private $conn;

    function __construct() {        
    }

    /**
     * Establishing database connection
     * @return database connection handler
     */
    function connect() {
        include_once dirname(__FILE__) . '/Config.php';

        // Connecting to mysql database
        $this->conn = new mysqli(SERVER_DB_HOST, SERVER_DB_USERNAME, SERVER_DB_PASSWORD, SERVER_DB_NAME);

        // Check for database connection error
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }

        $q= "SET NAMES 'UTF8'";
        $stmt = $this->conn->prepare($q);
        $stmt->execute();

        // returning connection resource
        return $this->conn;
    }

}

?>
