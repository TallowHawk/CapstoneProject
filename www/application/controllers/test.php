<?php

class test extends CI_Controller {

	public function index() {
		$this->load->model('User');
        echo $this->User->testing();
	}
}
