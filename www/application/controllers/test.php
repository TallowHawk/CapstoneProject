<?php

class test extends CI_Controller {

	public function index() {
		$this->load->view("header");
		$this->load->view("staff");
		$this->load->view("footer");
	}
}
