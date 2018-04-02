<?php

class test extends CI_Controller {

	public function index() {
		$this->load->model('User');
        echo json_encode($this->User->getUsername(3));
	}
}
