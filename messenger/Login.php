<?php session_start(); ?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Chat App </title>
        <link rel="stylesheet" href="CSS/Style.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    </head>

    <body>

        <div class="wrapper">
            <section class="form login">
                <header> Welcome to Chat App </header>

                <form action="Processes/LoginProcess.php" method="POST" enctype="multipart/form-data">
                    <?php

                    global $errorMsg;

                    if(isset($_GET['errorMessage'])) {
                        $errorMsg = $_GET['errorMessage'];

                        if($errorMsg == "none") {
                        ?>
                            <div class="alert alert-success" role="alert"> You successfully logged in! </div>
                        <?php
                        }

                        else if($errorMsg == "emptyInput") {
                        ?>
                            <div class="alert alert-danger" role="alert"> Empty input! </div>
                        <?php
                        }

                        else if($errorMsg == "userNotFound" || $errorMsg == "wrongPassword") {
                        ?>
                            <div class="alert alert-danger" role="alert"> Username or password is incorrect! </div>
                        <?php
                        }
                    }
                    ?>

                    <div class="field input">
                        <label for="username"> Username </label>
                        <input type="text" id="username" name="username" placeholder="Username">
                    </div>

                    <div class="field input">
                        <label for="password"> Password </label>
                        <input type="password" id="password" name="password" placeholder="Password">
                        <i class="fas fa-eye"> </i>
                    </div>

                    <div class="field button">
                        <input type="submit" id="submit" name="loginButton" value="Log In">
                    </div>
                
                </form>

                <div class="link"> Not yet signed up? <a href="../messenger/Signup.php"> Sign up now </a> </div>
            </section>
        </div>

    </body>

</html>

<script src="Javascript/Password.js"> </script>
<script src="https://kit.fontawesome.com/49ff4a7b2e.js" crossorigin="anonymous"> </script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>