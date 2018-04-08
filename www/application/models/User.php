<?php

class User extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /**
    *
    */
    function testing() {
        return json_encode( DB::query("SELECT * FROM Capstone"));
    }


    /**
    * createAccount sets a new record in the user table.
    * This method is available to students, faculty, and staff
    * @param $username - this is the username for the account
    * @param $password - password to be hashed and used to login
    * @param $phone - phone number associated with the account (must have a country code at the beginning)
    * @param $role - whether they are a student, staff, or faculty member
    * @param $fName - first name of the new user
    * @param $lName - last name of the new user
    * @return mixed - inserts a new user record into the respectful table
    *                 and hashes the password. inactive_date is set to null.
    *                 Returns true if record was successfully created
    */
    function createAccount($username, $password, $phone, $role, $fName, $lName){
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


    /**
    * This function returns most information about a specific user
    * @param $uid - used to retrieve user information based on the user's id#
    * @return string - json that includes most of the user's data that
    * is correlated with the $uid that was passed in
    */
    function getGeneralData($uid){
        return DB::query("SELECT u.username, u.phone, u.inactive_date, r.role_description, u.first_name, u.last_name FROM user u
        JOIN roles r ON r.id = u.role_id
        WHERE u.uid = %i", $uid);
    }


    /**
    * This retrievs the full name of the user based on user id#
    * @param $uid - the user's id#
    * @return string - json that includes the users full name
    */
    function getFullName($uid){
        return DB::query("SELECT CONCAT(first_name, ' ', last_name) FROM user
        WHERE uid = %i", $uid);
    }


    /**
    * This retrievs the full name of the user based on user id#
    * @param $uid - the user's id#
    * @return string - json that includes the users first name
    */
    function getFirstName($uid){
        return DB::query("SELECT first_name FROM user
        WHERE uid = %i", $uid);
    }


    /**
    * This retrievs the full name of the user based on user id#
    * @param $uid - the user's id#
    * @return string - json that includes the users last name
    */
    function getLastName($uid){
        return DB::query("SELECT last_name FROM user
        WHERE uid = %i", $uid);
    }


    /**
    * This function returns a specific user's username
    * @param - $uid - the user's id#
    * @return string - json that includes the user's username
    */
    function getUsername($uid){
        return DB::query("SELECT username FROM user
        WHERE uid = %i", $uid);
    }
}