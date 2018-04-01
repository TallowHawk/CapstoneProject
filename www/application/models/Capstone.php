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

    function getCapstoneAll() {
        return json_encode(DB::query("SELECT u.first_name , u.last_name, cs.title, cs.description, cs.plagerism_score, cs.grade, cs.type
                                      FROM capstone cs JOIN student s ON cs.student_id = s.id
                                      JOIN user u ON s.uid = u.uid;"));
    }

    function getCapstoneStudent($student){

    }
}