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

    public function getCapstoneDefenseDates() {
	    $this->load->model("capstone");
	    echo json_encode($this->capstone->getCapstoneDefenseDates());
    }


    public function getCapstoneHistory($cap_id){
        if(isset($cap_id)){
            $this->load->model("capstone");
            echo json_encode($this->capstone->getCapstoneHistory($cap_id));
        }
        else{
            echo "Error: function viewCapstoneHistory failed in Api.php";
        }
    }


    public function getInvitations($fac_id){
        if(isset($fac_id)){
            $this->load->model("committee");
            echo json_encode($this->committee->viewInvitations($fac_id));
        }
        else{
            echo "Error: function getInvitations failed in Api.php";
        }
    }


    public function getCommitteeList($fac_id){
        if(isset($fac_id)){
            $this->load->model("committee");
            echo json_encode($this->committee->viewAcceptedCommittee($fac_id));
        }
        else{
            echo "Error: function getInvitations failed in Api.php";
        }
    }


    public function getTrackingList($fac_id){
        if(isset($fac_id)){
            $this->load->model("facultytracker");
            echo json_encode($this->facultytracker->showTrackedProjects($fac_id));
        }
        else{
            echo "Error: function getInvitations failed in Api.php";
        }
    }

    public function getAllCapstones($fac_id){
        $this->load->model("capstone");
        echo json_encode($this->capstone->getCapstoneAll($fac_id));
    }
}
