<?php
class Database {    
    public function dbConnect() {        
        static $DBH = null;      
        if (is_null($DBH)) {              
			$connection = new mysqli(HOST, USER, PASSWORD, DATABASE);			
			if($connection->connect_error){
				die("Error failed to connect to MySQL: " . $connection->connect_error);
			} else {
				$DBH = $connection;
			}         
        }
        return $DBH;    
    }     
}