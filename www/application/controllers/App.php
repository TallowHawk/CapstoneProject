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
        if (!isset($_SESSION["uid"])){
            header("location: " .  base_url());
        }
        $this->load->model("capstone");
        $this->load->model("user");
        $this->load->model("committee");
        $this->load->view("header");
        /*
         * functionality to send a user to create a capstone if they don't yet have a capstone yet. If they do
         * have a capstone then it navigates them to their app page.
         */
        $studentRoleId = 1;
        $staffRoleId = 2;
        $facultyRoleId = 3;
        $studentId = $this->user->getStudentId($_SESSION["uid"]);
        $capstone = $this->capstone->getCapstoneSpecific($_SESSION["username"]);
        if(!empty($capstone)){
            $data['userData'] = $this->user->getGeneralData($_SESSION["uid"]);
            $data['capstone'] = $capstone;
            $data['capStatus'] = $this->capstone->getCapstoneStatus($_SESSION["username"]);
            $data['studentCommittee'] = $this->committee->getAcceptedCommittee($studentId);
            $data['facultyMembers'] = $this->user->getUsersByRole($facultyRoleId);
            $this->load->view("student", $data);
            //$this->load->view("student", $capstone);
        }
        else {
            $this->load->view("create_capstone");
        }


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

    public function addToCommittee($uid, $cap_id){
        if(isset($uid) && isset($cap_id)){
            $this->load->model("user");
            $this->load->model("committee");
            $fac_id = $this->user->getFacIdByUid($uid);
            echo json_encode($this->committee->addToCommittee($fac_id[0]["id"], $cap_id));
        }
        else{
            echo "Error: Please Enter Valid fac_id and/or cap_id";
        }
    }


    public function removeFromCommittee($fac_id, $cap_id){
        if(isset($fac_id) && isset($cap_id)){
            $this->load->model("committee");
            echo json_encode($this->committee->removeFromCommittee($fac_id, $cap_id));
        }
        else{
            echo "Error: Please Enter Valid fac_id and/or cap_id";
        }
    }
}
