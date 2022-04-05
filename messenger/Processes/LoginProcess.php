<?php

    include "../Database/DatabaseConnection.php";
    include "../Classes/LoginClass.php";
    include "../Controllers/LoginController.php";

    if(isset($_POST['loginButton'])) {

        $username = $_POST['username'];
        $password = $_POST['password'];

        $login = new LoginController($username, $password);

        $login->loginUser();

    }

?>