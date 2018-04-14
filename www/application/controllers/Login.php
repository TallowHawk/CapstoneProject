<?php

class Login extends CI_Controller {

	public function index() {
		echo "Login Works";
        $this->load->view("Login");
	}

}
