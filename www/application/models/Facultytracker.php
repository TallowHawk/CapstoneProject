<?php

class Capstone extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    function addToTracker($cap_id,$fac_id) {
        return DB::insert('faculty_tracker', array(
            "cap_id" => $cap_id,
            "fac_id" => $fac_id
        ));
    }

    function removeFromTracker($cap_id,$fac_id){
        return DB::delete('faculty_tracker', "cap_id=%i AND fac_id=%i",$cap_id,$fac_id);
    }
}