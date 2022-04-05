<?php

    include "../Database/DatabaseConnection.php";
    include "../Classes/SignupClass.php";
    include "../Controllers/SignupController.php";

    if(isset($_POST['signupButton'])) {

        $firstName = $_POST['firstname'];
        $lastName = $_POST['lastname'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        $image = $_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];
        $target = "../Images/".basename($image);

        $extension = pathinfo($image, PATHINFO_EXTENSION);

        if(!in_array($extension, ['jpeg', 'jpg', 'png'])) {
           header("location: ../Signup.php?errorMessage=badPictureFormat");
           exit();
        }

        else if($_FILES['image']['size'] > 52428800) {
            header("location: ../Signup.php?errorMessage=largePicture");
            exit();
        }

        else {
            
            if(move_uploaded_file($tmp, $target)) {

                $signup = new SignupController($firstName, $lastName, $email, $username, $password, $image);

                $signup->signupUser();
                
            }
        }
    }

?>