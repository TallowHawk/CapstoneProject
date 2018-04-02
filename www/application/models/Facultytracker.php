<?php

class Capstone extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    /**
     * Adds the faculty member to the watchlist for a particular capstone
     * @param $cap_id - the capstone id to add to the tracker
     * @param $fac_id - the faculty id that corresponds with the capstone id
     * @return mixed - rows affected
     */
    function addToTracker($cap_id,$fac_id) {
        return DB::insert('faculty_tracker', array(
            "cap_id" => $cap_id,
            "fac_id" => $fac_id
        ));
    }

    function removeFromTracker($cap_id,$fac_id){
        return DB::delete('faculty_tracker', "cap_id=%i AND fac_id=%i",$cap_id,$fac_id);
    }

    function showTrackedProjects($fac_ID) {
        return DB::query("SELECT cap_id FROM faculty_tracker WHERE fac_id = %i",$fac_ID);
    }
}