<?php

    class SignupController extends Signup {

        private $firstName;
        private $lastName;
        private $email;
        private $username;
        private $password;
        private $image;

        public function __construct($firstName, $lastName, $email, $username, $password, $image) {
            $this->firstName = $firstName;
            $this->lastName = $lastName;
            $this->email = $email;
            $this->username = $username;
            $this->password = $password;
            $this->image = $image;
            
        }

        public function signupUser() {

            if($this->emptyInput() == false) {
                //echo '<script>alert("Empty input")</script>';
                header("location: ../Signup.php?errorMessage=emptyInput");
                exit();
            }

            if($this->invalidUsername() == false) {
                //echo '<script>alert("Invalid Username")</script>';
                header("location: ../Signup.php?errorMessage=invalidUsername");
                exit();
            }

            if($this->invalidEmail() == false) {
                //echo '<script>alert("Invalid Email")</script>';
                header("location: ../Signup.php?errorMessage=invalidEmail");
                exit();
            }

            if($this->usernameTaken() == false) {
                //echo '<script>alert("Username already exists")</script>';
                header("location: ../Signup.php?errorMessage=usernameTaken");
                exit();
            }

            $this->setuser($this->firstName, $this->lastName, $this->email, $this->username, $this->password, $this->image);
            header("location: ../Signup.php?errorMessage=none");
        }


        private function emptyInput() {

            if(empty($this->firstName) ||empty($this->lastName) || empty($this->email) || empty($this->username) || empty($this->password) || empty($this->image)) {
                $result = false;
            }
            else {
                $result = true;
            }

            return $result;
        }

        private function invalidUsername() {

            if(!preg_match("/^[a-zA-Z0-9]*$/", $this->username)) {
                $result = false;
            }
            else {
                $result = true;
            }

            return $result;
        }

        private function invalidEmail() {

            if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                $result = false;
            }
            else {
                $result = true;
            }

            return $result;
        }

        private function usernameTaken() {

            if(!$this->checkUser($this->email, $this->username)) {
                $result = false;
            }
            else {
                $result = true;
            }

            return $result;
        }
    }

?>