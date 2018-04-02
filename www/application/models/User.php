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
}
