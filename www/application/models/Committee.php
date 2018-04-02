<?php

class Committee extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    /**
     * Adds a faculty member to the committee table with a specific capstone project. Note that the hasAccepted
     * attribute is defaulted to 0 or false
     * @param $fac_id - the faculty to be added to the committee
     * @param $cap_id - the specific capstone that the faculty is being added to the committee of
     * @return mixed - the number of rows affected
     */
    function addToCommittee($fac_id, $cap_id) {
        return DB::insert('committee', array(
            "fac_id" => $fac_id,
            "cap_id" => $cap_id,
        ));
    }
}