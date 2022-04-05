<?php

    class Signup extends Database {

        protected function setUser($firstName, $lastName, $email, $username, $password, $image) {

            $conn = $this->connect();

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $query = "INSERT INTO users (firstname, lastname, email, username, password, image)
            VALUES ('$firstName', '$lastName', '$email', '$username', '$hashedPassword', '$image')";

            $result = mysqli_query($conn, $query);

            if(!$result) {
                $query = null;
                header("location: ../Signup.php?errorMessage=queryFailed");
                exit();
            }
        }

        protected function checkUser($email, $username) {
            
            $conn = $this->connect();

            $query = "SELECT username FROM users WHERE email = '$email' OR username = '$username'";

            $result = mysqli_query($conn, $query);

            if(!$result) {
                $query = null;
                header("location: ../Signup.php?errorMessage=queryFailed");
                exit();
            }

            if($result->num_rows > 0) {
                $check = false;
            }
            else {
                $check = true;
            }

            return $check;
        }
    }
    
?>