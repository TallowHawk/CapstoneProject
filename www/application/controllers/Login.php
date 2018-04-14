<?php

class Login extends CI_Controller {

	public function index() {
        $this->load->model("user");
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
                $password = password_hash($password, PASSWORD_DEFAULT);
                $login = $this->user->login($username,$password);
                if ($login(0)["username"] == $username && $login(0)["password"] == $password) {
                    session_start();
                    $_SESSION["username"] = $username;
                    $_SESSION["userType"] = $this->user->getUserType($username);
                    echo $_SESSION["username"];
                    header("Location: app/student");
                }

            }

        }
	    echo "Login Works";
        $this->load->view("login");
        
	}

}
