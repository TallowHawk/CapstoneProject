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

    /**
     * this is for faculty and staff to see everything that is related to a student's capstone.
     * @return string - json that includes all required data for all the capstones. Notice that it does not have all
     *                  of the data for the the capstone statuses.
     */
    function getCapstoneAll() {
        return json_encode(DB::query("SELECT u.first_name , u.last_name, cs.title, cs.description, cs.plagerism_score, cs.grade, cs.type
                                      FROM capstone cs JOIN student s ON cs.student_id = s.id
                                      JOIN user u ON s.uid = u.uid;"));
    }

    function getCapstoneSpecific($first, $last){
        return json_encode(DB::query("SELECT u.first_name , u.last_name, cs.title, cs.description, cs.plagerism_score, cs.grade, cs.type
                                      FROM capstone cs JOIN student s ON cs.student_id = s.id
                                      JOIN user u ON s.uid = u.uid
                                      WHERE u.first_name = %s AND u.last_name = %s;",$first,$last));
    }

    /**
     * Sets the status of the capstone project. Only for staff.
     * @param $status - the status to set the project to
     * @param $capID - the specific capstone project id to add the status to
     * @return mixed - not sure if this returns anything yet. Have to test. TODO: test this method's return
     */
    function setStatus($status,$capID) {
        return DB::insert('status_history',array(
            'id' => DB::queryOneField("SELECT status_history_id FROM capstone WHERE capstone.id = %i", $capID),
            'status_id' => DB::queryOneField("SELECT id FROM status WHERE status_desc = %s", $status),
            'date' => DB::sqlEval("NOW()")
        ));
    }
}