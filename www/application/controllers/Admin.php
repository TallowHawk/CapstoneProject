<?php

class Admin extends CI_Controller {

    function __construct() {
        parent::__construct();
        session_start();
    }

    public function index() {
        header("location: Admin/createAccount");
	}

	public function createAccount() {
        $this->load->model("user");

        if (!empty($_POST)){
            $errors = [];
            $fName = $_POST["fname"];
            $lName = $_POST["lname"];
            $username = $_POST["username"];
            $password = $_POST["password"];
            $phoneNum = $_POST["phone"];
            $userType = $_POST["userType"];

            if (strlen($fName) == 0){
                $errors[] = "Please add a first name";
            }
            if (strlen($lName) == 0){
                $errors[] = "Please add a last name";
            }
            if (strlen($username) == 0) {
                $errors[] = "Please include a username";
            }
            if (strlen($password) == 0) {
                $errors[] = "Please include a password";
            }
            if (strlen($phoneNum) == 0) {
                $errors[] = "Please add a phone number";
            }
            if (strlen($userType) == 0) {
                $errors[] = "Need a user type";
            }

            if (!empty($errors)) {
                foreach ($errors as $value) {
                    echo $value . "<br/>";
                }
            }
            else {
                if($this->user->createAccount($username,$password,$phoneNum,$userType,$fName,$lName)){
                    echo "DB success";
                }
                else {
                    echo "DB failure";
                }
            }
        }
        $this->load->view("header");
        $this->load->view("create_account");
        $this->load->view("footer");
    }

    public function massAccounts() {
        $this->load->view("header");
        $this->load->view("mass_accounts");
        $this->load->view("footer");
    }



}
