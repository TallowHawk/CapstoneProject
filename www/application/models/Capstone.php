<?php
/**
 * Created by PhpStorm.
 * User: todd
 * Date: 4/1/18
 * Time: 10:58 AM
 */

class Capstone extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    function testing() {
        return json_encode( DB::query("SELECT * FROM roles"));
    }
}