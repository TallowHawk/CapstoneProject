<?php

class App extends CI_Controller {

    function __construct() {
        parent::__construct();
        session_start();
    }

    public function index() {
		echo "hey";
	}

	public function student() {
	    $this->load->view("header");
        $this->load->view("student");
        $this->load->view("footer");
    }

    public function faculty() {
        $this->load->view("header");
        $this->load->view("faculty");
        $this->load->view("footer");
    }

    public function staff() {
        $this->load->view("header");
        $this->load->view("staff");
        $this->load->view("footer");
    }
}
