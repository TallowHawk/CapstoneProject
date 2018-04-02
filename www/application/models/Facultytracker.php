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

    /**
     * Removes the selected faculty member from the selected capstone's watchlist
     * @param $cap_id - the capstone id to add to the tracker
     * @param $fac_id - the faculty id that corresponds with the capstone id
     * @return mixed - rows affected
     */
    function removeFromTracker($cap_id,$fac_id){
        return DB::delete('faculty_tracker', "cap_id=%i AND fac_id=%i",$cap_id,$fac_id);
    }

    /**
     * Shows the faculty member all capstone projects they are currently tracking.
     * @param $fac_ID - the faculty member of which we are checking their projects
     * @return mixed - associative array of all the capstone_id's the faculty member is a part of
     */
    function showTrackedProjects($fac_ID) {
        return DB::query("SELECT cap_id FROM faculty_tracker WHERE fac_id = %i",$fac_ID);
    }
}