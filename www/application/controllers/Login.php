<?php

class Login extends CI_Controller {

	public function index() {
        $this->load->model('user');

        /* This is the server validation. TODO: Display server validation
         * It takes and the user's username and password and makes sure it is okay. If it is then it it verifies that
         * the password is correct. If it's correct it starts the session and sends the user to the correct page.
         * If the password is incorrect then it displays an error message
         */
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
                    $_SESSION["uid"] = $this->user->getUid($username);
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

	public function logout() {
	    session_start();
	    session_destroy();
	    header("Location: ". base_url() . "");
    }

}
