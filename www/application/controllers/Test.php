<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

    function __construct() {
        parent::__construct();

    }

    public function index() {
        $this->load->model('capstone');
        print_r( $this->capstone->testing());
    }
}