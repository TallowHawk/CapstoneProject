<?php

class test extends CI_Controller {

	public function index() {
		$this->load->model('User');
        echo $this->User->createAccount('test1234', 'testPwd', '15851230987', '2018-09-25 15:30:00', 1, 'John', 'Smith');
	}
}
