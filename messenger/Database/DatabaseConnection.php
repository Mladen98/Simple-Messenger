<?php

    class Database {
        
        public function connect() {
			
            $conn = new mysqli("localhost", "root", "", "messenger");

            if($conn->connect_error) {
                die ("<h1>Database Connection Failed</h1>");
            }
            //echo "Database Connected Successfully";
            return $this->conn = $conn;
        }
    }
	
?>