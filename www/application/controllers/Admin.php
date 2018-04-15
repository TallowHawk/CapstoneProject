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
        $this->load->view("header");
        $this->load->view("create_account");
        $this->load->view("footer");
    }

}
