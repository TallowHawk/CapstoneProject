<?php

class Login extends CI_Controller {

	public function index() {
        $this->load->model('user');
        session_start();
        if (isset($_SESSION["userType"])){
            header("location: " .  base_url() ."app/" . $_SESSION["userType"]);
        }

        /* This is the server validation. TODO: Display server validation
         * It takes and the user's username and password and makes sure it is okay. If it is then it it verifies that
         * the password is correct. If it's correct it starts the session and sends the user to the correct page.
         * If the password is incorrect then it displays an error message
         */
        $errorBol = 0;
        if (!empty($_POST)) {
            $errors = [];


            $username = $_POST["username"];
            $password = $_POST["password"];

            if (strlen($username) == 0) {
                $errors[] = "Please enter a username";
            }

            if (strlen($password) == 0) {
                $errors[] = "Please enter a password";
            }

            if (!empty($errors)) {
                foreach ($errors as $value){
                    echo $value . "<br/>";
                }
            }
            else {
                $hashedPass = $this->user->login($username);
                if (!empty($hashedPass) && password_verify($password,$hashedPass["password"])) {
                    $_SESSION["username"] = $username;
                    $_SESSION["userType"] = strtolower($this->user->getUserType($username));
                    $_SESSION["uid"] = $this->user->getUid($username);
                    header("Location: app/" . $_SESSION["userType"]);
                }
                else {
                    $errorBol = 1;
                }

            }

        }
        $data["errorBol"] = $errorBol;
        $this->load->view("header");
        $this->load->view("login",$data);
        $this->load->view("footer");

	}

	public function logout() {
	    session_start();
	    session_destroy();
	    header("Location: ". base_url() . "");
    }

}
