<?php

class Api extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
		echo "hey";
	}

	public function rejectedProposals($status) {
        $this->load->model("capstone");
    }

}
