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
        return DB::query("SELECT cs.id, u.first_name , u.last_name, u.username, cs.title, cs.description, cs.defense_date, cs.plagerism_score, cs.grade, cs.type
                                      FROM capstone cs JOIN student s ON cs.student_id = s.id
                                      JOIN user u ON s.uid = u.uid
                                      ORDER BY cs.defense_date;");
    }

    /**
     * This allows you to get a specific capstone project and all the data for it
     * @param $username - the username of the user's capstone to look up
     * @return string - json that includes all required data for all the capstones. Notice that it does not have all
     *                  of the data for the the capstone statuses.
     */
    function getCapstoneSpecific($username){
        return DB::queryFirstRow("SELECT u.first_name , u.last_name, u.username, cs.id, cs.title, cs.description, cs.plagerism_score, cs.grade, cs.type, cs.defense_date
                                      FROM capstone cs JOIN student s ON cs.student_id = s.id
                                      JOIN user u ON s.uid = u.uid
                                      WHERE u.username = %s;",$username);
    }

    /**
     * This allows you to get all the
     * @param $status - the status of the projects to look for
     * @return mixed
     */
    function getCapstonesByStatus($status) {
        return DB::query("SELECT u.username, c.title, c.description, c.type
            FROM capstone c JOIN student s ON c.student_id = s.id
            JOIN user u ON s.uid = u.uid
            JOIN status_history h ON c.id = h.capstone_id
            JOIN status s2 ON h.status_id = s2.id
            WHERE status_desc = %s;", $status);
    }

    /**
     * Gets all the capstone ordered by the closest defensedate
     * @return mixed - associative array of all the capstones sorted by defense date
     */
    function getCapstoneDefenseDates() {
        return DB::query("SELECT c.defense_date, c.title, u.username, u.first_name, u.last_name, c.type, c.plagerism_score
            FROM capstone c JOIN student s ON c.student_id = s.id
            JOIN user u ON s.uid = u.uid
            ORDER BY defense_date ASC;");
    }

    /**
     * This allows you to get all the
     * @param $username - the username that is associated with the capstone
     * @return string - the status of the capstone
     */
    function getCapstoneStatus($username){
        return DB::queryFirstRow("SELECT s.status_code, s.status_desc
            FROM status s JOIN status_history sh ON s.id = sh.status_id
            JOIN capstone c ON sh.capstone_id = c.id
            JOIN student stu ON c.student_id = stu.id
            JOIN user u ON u.uid = stu.uid
            WHERE username = %s", $username);
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


    /**
     * This will update a capstone record's grade attribute
     * @param $grade - the grade to be given to the capstone
     * @param $cap_id - the id of the capstone that needs the grade
     * @return mixed - returns the rows affected
     */
    function updateCapstoneGrade($grade, $cap_id){
        return DB::update('capstone', array(
            'grade' => $grade
        ), "id = %s",$cap_id);
    }
}
