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

    /**
     * This will update the status of the a faculty member on the committee to accepted
     * @param $fac_id - the faculty to change the state of
     * @param $cap_id - the capstone in which we are changing the faculty's status
     * @return mixed - the number of rows affected
     */
    function updateAccepted($fac_id, $cap_id) {
        return DB::update('committee', array(
            "has_accepted" => 1
        ), "fac_id = %i AND cap_id = %i", $fac_id, $cap_id);
    }

    /**
     * Grabs all records from committee table based on student id and if accepted attribute in committee table is true.
     * @param $student_id - the student who's committee we are searching for
     * @return mixed - An associative array of the faculty id, faculty username, capstone id, and capstone title
     */
    function getAcceptedCommittee($student_id) {
        return DB::query("SELECT f.id \"fac_id\", u.username, c.id \"cap_id\", c.title
                        FROM committee JOIN capstone c ON committee.cap_id = c.id
                        JOIN faculty f ON committee.fac_id = f.id
                        JOIN user u ON f.uid = u.uid
                        JOIN student s ON c.student_id = s.id
                        WHERE student_id = %i AND has_accepted = 1;", $student_id);
    }


    /**
    * Deletes a faculty member from the committee table with a specific capstone project. Note that the hasAccepted
    * attribute is defaulted to 0 or false
    * @param $fac_id - the faculty to be deleted from the committee
    * @param $cap_id - the specific capstone that the faculty member is being removed from
    * @return mixed - the number of rows affected
    */
    function removeFromCommittee($fac_id, $cap_id){
        return DB::delete('committee', 'fac_id = %i AND cap_id = %i', $fac_id, $cap_id);
    }
}
