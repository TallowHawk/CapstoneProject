<?php

class Api extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
		echo "hey";
	}

    /**
     * This function will grab a list of Capstones based off of their status. To get this navigate to
     * http://serverroute/api/getCapstonesByStatus/{status}
     * @param $status - the status of the capstone to lookup
     */
	public function getCapstonesByStatus($status) {
        if (isset($status)) {
            $this->load->model("capstone");
            echo json_encode($this->capstone->getCapstonesByStatus($status));
        }
        else {
            echo "Error: Please Append Status";
        }
    }

    public function getCapstoneByUsername($username){
	    if (isset($username)){
	        $this->load->model("capstone");
	        echo json_encode($this->capstone->getCapstoneSpecific($username));
        }
    }

    public function getCapstoneStatus($username) {
	    if (isset($username)) {
	        $this->load->model("capstone");
	        echo json_encode($this->capstone->getCapstoneStatus($username));
        }
    }

}
