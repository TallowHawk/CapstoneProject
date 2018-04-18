<?php

class App extends CI_Controller {


    function __construct() {
        parent::__construct();
        session_start();
        $this->load->model("user");
    }

    public function index() {
		echo "hey";
	}

	public function student() {
        if (!isset($_SESSION["uid"])){
            header("location: " .  base_url());
        }

        if ($_SESSION["userType"] != "student"){
            header("Location: " . base_url() . "app/" . $_SESSION["userType"]);
        }

        $this->load->model("capstone");
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
        if (!isset($_SESSION["uid"])){
            header("location: " .  base_url());
        }
        if ($_SESSION["userType"] != "faculty"){
            header("Location: " . base_url() . "app/" . $_SESSION["userType"]);
        }
        $this->load->model("committee");
        $this->load->model("facultytracker");
        $this->load->model("capstone");

        $fac_id = $this->user->getFacIdByUid($_SESSION["uid"]);
        $data['committeeList'] = $this->committee->viewAcceptedCommittee($fac_id);
        $data['invitationData'] = $this->committee->viewInvitations($fac_id);
        $data['userData'] = $this->user->getGeneralData($_SESSION["uid"]);
        $data['trackedInfo'] = $this->facultytracker->showTrackedProjects($fac_id);
        $data['allCapstones'] = $this->capstone->getCapstoneAll();
        $this->load->view("header");
        $this->load->view("faculty", $data);
        $this->load->view("footer");
    }



    public function staff() {
        if (!isset($_SESSION["uid"])){
            header("location: " .  base_url());
        }
        if ($_SESSION["userType"] != "staff"){
            header("Location: " . base_url() . "app/" . $_SESSION["userType"]);
        }
        $data['userData'] = $this->user->getGeneralData($_SESSION["uid"]);
        $this->load->view("header");
        $this->load->view("staff", $data);
        $this->load->view("footer");
    }



    public function addToCommittee($uid, $cap_id){
        if(isset($uid) && isset($cap_id)){
            $this->load->model("user");
            $this->load->model("committee");
            $fac_id = $this->user->getFacIdByUid($uid);
            echo json_encode($this->committee->addToCommittee($fac_id, $cap_id));
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

    public function updateAccepted($fac_id, $cap_id){
        if(isset($fac_id) && isset($cap_id)){
            $this->load->model("committee");
            echo json_encode($this->committee->updateAccepted($fac_id, $cap_id));
        }
        else{
            echo "Error: Please Enter Valid fac_id and/or cap_id";
        }
    }

    public function getTrackedProjectsInfo($fac_id){
        if(isset($fac_id)){
            $this->load->model("facultytracker");
            echo json_encode($this->facultytracker->showTrackedProjects($fac_id));
        }
        else{
            echo "Error: Please Enter Valid fac_id";
        }
    }

    public function removeFromTracker($fac_id,$cap_id){
        if(isset($fac_id) && isset($cap_id)){
            $this->load->model("facultytracker");
            echo json_encode($this->facultytracker->removeFromTracker($fac_id, $cap_id));
        }
        else{
            echo "Error: Please Enter Valid fac_id and/or cap_id";
        }
    }
}
