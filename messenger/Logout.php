<?php

    include_once "Database/DatabaseConnection.php";

    session_start();

    $db = new Database();

    $conn = $db->connect();
    $usr = $_SESSION["username"];

    $query = "UPDATE users SET status = 'offline' WHERE username = '$usr'";

    $result = mysqli_query($conn, $query);
    session_unset();
    session_destroy();

    header("location: Login.php");

?>