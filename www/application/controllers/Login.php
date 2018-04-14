<?php

class Login extends CI_Controller {

	public function index() {
        $this->load->model('user');
	    if (!empty($_POST)) {
            $errors = [];
            print_r($_POST);
            
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
                if (password_verify($password,$hashedPass[0]["password"])) {
                    session_start();
                    $_SESSION["username"] = $username;
                    $_SESSION["userType"] = strtolower($this->user->getUserType($username));
                    echo $_SESSION["username"];
                    header("Location: app/" . $_SESSION["userType"]);
                }
                else {
                    echo "Error Logging in";
                }

            }

        }
	    echo "Login Works";
        $this->load->view("login");
        
	}

}
