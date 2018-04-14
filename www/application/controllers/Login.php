<?php

class Login extends CI_Controller {

	public function index() {
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


        }
	    echo "Login Works";
        $this->load->view("Login");
        
	}

}
