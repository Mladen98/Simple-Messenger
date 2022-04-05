<?php

    class Login extends Database {

        protected function getUser($username, $password) {

            $conn = $this->connect();

            $query = "SELECT password FROM users WHERE username = '$username'";

            $result = mysqli_query($conn, $query);

            if(!$result) {
                $query = null;
                header("location: ../Login.php?errorMessage=somethingWentWrong");
                exit();
            }

            if($result->num_rows == 0) {
                $query = null;
                header("location: ../Login.php?errorMessage=userNotFound");
                exit();
            }

            $pswHashed = $result->fetch_assoc();
            $checkPsw = password_verify($password, $pswHashed["password"]);

            if($checkPsw == false) {
                $query = null;
                header("location: ../Login.php?errorMessage=wrongPassword");
                exit();
            }

            else {
                //$conn = $this->connect();

                $query = "SELECT * FROM users WHERE username = '$username'";
                $query1 = "UPDATE users SET status = 'online' WHERE username = '$username'";
                
                $result = mysqli_query($conn, $query);
                $result1 = mysqli_query($conn, $query1);

                if(!$result || !$result1) {
                    $query = null;
                    header("location: ../Login.php?errorMessage=somethingWentWrong");
                    exit();
                }

                if($result->num_rows == 0) {
                    $query = null;
                    header("location: ../Login.php?errorMessage=userNotFound");
                    exit();
                }

                $user = $result->fetch_assoc();

                session_start();
                $_SESSION['userID'] = $user["userID"];
                $_SESSION["firstName"] = $user["firstname"];
                $_SESSION["lastName"] = $user["lastname"];
                $_SESSION["username"] = $user["username"];
                $_SESSION["password"] = $user["password"];
                $_SESSION["status"] = $user["status"];

                header("location: ../Homepage.php");

                $query = null;

            }

            $query = null;
        }
    }

?>