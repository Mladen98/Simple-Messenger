<?php

    session_start();
    if(isset($_SESSION["username"])) {
        include_once "../Database/DatabaseConnection.php";

        $db = new Database;

        $conn = $db->connect();

        $messageFrom = mysqli_real_escape_string($conn, $_POST["messageFrom"]);
        $messageTo = mysqli_real_escape_string($conn, $_POST["messageTo"]);
        $message = mysqli_real_escape_string($conn, $_POST["message"]);

        if(!empty($message)) {
            $query = "INSERT INTO messages (messageFrom, messageTo, message) VALUES ('$messageFrom', '$messageTo', '$message')";

            $result = mysqli_query($conn, $query);

            if(!$result) {
                die();
            }

        }

    }
    else {
        header("location: Login.php");
    }

?>