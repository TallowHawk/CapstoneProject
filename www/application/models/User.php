<?php

class User extends CI_Model {

    function __construct() {
        parent::__construct();
    }


    function testing() {
        return json_encode( DB::query("SELECT * FROM Capstone"));
    }


    function createAccount($username, $password, $phone, $inactiveDate, $role, $fName, $lName){
        return DB::insert('user', array(
            'username'=>$username,
            'password'=>password_hash($password, PASSWORD_DEFAULT),
            'phone'=>$phone,
            'inactive_date'=>null,
            'role_id'=>$role,
            'first_name'=>$fName,
            'last_name'=>$lName
        ));
    }


    function getGeneralData($uid){
        return DB::query("SELECT u.username, u.phone, u.inactive_date, r.role_description, u.first_name, u.last_name FROM user u
        JOIN roles r ON r.id = u.role_id
        WHERE u.uid = %i", $uid);
    }


    function getName($uid){
        return DB::query("SELECT CONCAT(first_name, ' ', last_name) FROM user
        WHERE uid = %i", $uid);
    }


    function getUsername($uid){
        return DB::query("SELECT username FROM user
        WHERE uid = %i", $uid);
    }
}
