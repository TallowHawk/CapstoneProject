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
		if ($_POST)
		{
			$errors = [];
			if(strlen( $_POST["fName"] ) <= 1 )
			{
				$errors[] = "Please enter a first name.<br/>";
			}
			if(strlen( $_POST["lName"] ) <= 1 )
			{
				$errors[] = "Please enter a last name.<br/>";
			}
			if(strlen( $_POST["defenceDate"] ) != 19 )
			{
				$errors[] = "Please enter a valid date.<br/>";
			}
			if(strlen( $_POST["title"] ) <= 1 )
			{
				$errors[] = "Please enter a first name.<br/>";
			}
			if(strlen( $_POST["description"] ) <= 1 )
			{
				$errors[] = "Please enter a last name.<br/>";
			}
			
			if(count($errors)>0)
			{
				$message .= "The Following fields are invalid:<br/>";
			  
				for ( $i = 0; $i < count( $errors ); $i++ ) 
				{
					$message .= $errors[$i];
				}
			}
			else
			{
				//pass data in to make a new capstone
				$this->load->model("capstone");
				$this->load->model("user");
				//get the studentID from the current session
				//echo($_SESSION["uid"]);
				$studentID = $this->user->getStudentId($_SESSION["uid"]);
				//echo($studentID);
				//create a capstone project in the database
				//echo("capstone created with the following information: " + $studentID +", " + $_POST["title"] +", " + $_POST["description"] +", " + $_POST[type].value +", " + $_POST["defenceDate"]);
				$this->capstone->createCapstone($studentID,$_POST["title"],$_POST["description"],$_POST["type"], $_POST["defenceDate"]);
				$cap_ID = $this->capstone->getCapstoneId($_SESSION["username"]);
				$this->capstone->setStatus("Pending",$cap_ID);
				//header("Location: app/" . $_SESSION["userType"]);
			}
		}
		
		//------------------------------------------
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
        $data['facID'] = $fac_id;
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
        $data['username'] = $_SESSION["username"];
        $this->load->view("header");
        $this->load->view("staff", $data);
        $this->load->view("footer");
    }


    // Faculty Functions

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


    public function addToTracker($fac_id,$cap_id){
        if(isset($fac_id) && isset($cap_id)){
            $this->load->model("facultytracker");
            echo json_encode($this->facultytracker->addToTracker($fac_id, $cap_id));
        }
        else{
            echo "Error: Please Enter Valid fac_id and/or cap_id";
        }
    }


    public function updateCapstoneGrade($grade, $cap_id){
        if(isset($grade) && isset($cap_id)){
            $this->load->model("capstone");
            echo json_encode($this->capstone->updateCapstoneGrade($grade, $cap_id));
        }
        else{
            echo "Error: function updateCapstoneGrade failed in App.php";
        }
    }

    ///////////////End faculty functions//////////////////

    //////////////Start Staff Functions///////////////////

    public function updateStatus($status,$cap_id)
    {
        if (isset($status, $cap_id)) {
            $this->load->model("capstone");
            $this->capstone->setStatus($status, $cap_id);
        }
    }


    public function updateCapstoneStatus($status, $cap_id){
        if(isset($status) && isset($cap_id)){
            $this->load->model("capstone");
            echo json_encode($this->capstone->setStatus($status, $cap_id));
        }
        else{
            echo "Error: function updateCapstoneGrade failed in App.php";

        }
    }

    public function setPlagScore($plag_score,$cap_id) {
        if (isset($plag_score,$cap_id)) {
            $this->load->model("capstone");
            echo json_encode($this->capstone->setPlagScore($plag_score,$cap_id));
        }
    }
}
