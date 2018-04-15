<?php

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
        return DB::query("SELECT u.first_name , u.last_name, cs.title, cs.description, cs.plagerism_score, cs.grade, cs.type
                                      FROM capstone cs JOIN student s ON cs.student_id = s.id
                                      JOIN user u ON s.uid = u.uid;");
    }

    /**
     * This allows you to get a specific capstone project and all the data for it
     * @param $username - the username of the user's capstone to look up
     * @return string - json that includes all required data for all the capstones. Notice that it does not have all
     *                  of the data for the the capstone statuses.
     */
    function getCapstoneSpecific($username){
        return DB::query("SELECT u.first_name , u.last_name, cs.title, cs.description, cs.plagerism_score, cs.grade, cs.type
                                      FROM capstone cs JOIN student s ON cs.student_id = s.id
                                      JOIN user u ON s.uid = u.uid
                                      WHERE u.username = %s;",$username);
    }

    /**
     * Sets the status of the capstone project. Only for staff.
     * @param $status - the status to set the project to
     * @param $capID - the specific capstone project id to add the status to
     * @return mixed - returns if the rows affected
     */
    function setStatus($status,$capID) {
//        return DB::queryOneField('id',"SELECT id FROM status WHERE status_desc = %s;", $status);
        return DB::insert('status_history',array(
            'capstone_id' => $capID,
            'status_id' => DB::queryOneField('id',"SELECT id FROM status WHERE status_desc = %s", $status),
            'date' => DB::sqlEval("NOW()")
        ));
    }

    /**
     * This will create a new capstone record for the selected student
     * @param $student_id - the student who's capstone this is
     * @param $title - the title of the capstone
     * @param $description - the description of the capstone
     * @param $type - the type of capstone
     * @return mixed - returns the rows affected
     */
    function createCapstone($student_id,$title,$description,$type) {
        return DB::insert('capstone', array(
            'student_id' => $student_id,
            'title' => $title,
            'description' => $description,
            'plagerism_score' => null,
            'grade' => null,
            'type' => $type
        ));
    }
}