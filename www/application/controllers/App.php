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
            header("location: login/");
        }
        $this->load->model("capstone");
        $this->load->model("user");
        $this->load->view("header");
        /*
         * functionality to send a user to create a capstone if they don't yet have a capstone yet. If they do
         * have a capstone then it navigates them to their app page.
         */
        $capstone = $this->capstone->getCapstoneSpecific($_SESSION["username"]);
        if(!empty($capstone)){
            $data['userData'] = $this->user->getGeneralData($_SESSION["uid"]);
            $data['capstone'] = $capstone;
            $this->load->view("student", $data, $capstone);
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
}
