<?php

require "config.php";

    // Login access
    function login_access_user() {
        if (isset($_COOKIE["login_cookie"]) && isset($_COOKIE["rand_cookie_val"])) {
            global $connect_to_database;

            $user_id = $_COOKIE["login_cookie"];
            $browser_rand_cookie_val = $_COOKIE["rand_cookie_val"];


            $query_require_data_for_login = $connect_to_database->query("SELECT * FROM users WHERE users_id = '$user_id'");
            $query_login_require_data_fetch = mysqli_fetch_object($query_require_data_for_login);

            if (mysqli_num_rows($query_require_data_for_login) > 0) {
    
                $db_rand_cookie_val = $query_login_require_data_fetch->user_unique_login_cookie_value;

                if ($db_rand_cookie_val == $browser_rand_cookie_val) {
                    return true;
                } else {
                    return false;
                }
            
            } else {
                return false;
            }

            
        } else {
            return false;
        }
    }





    // Email Exist or not
    function exist_email() {
        global $connect_to_database;
        global $email_S_L;
        global $query_fetch;

        $email_query = $connect_to_database->query("SELECT * FROM users WHERE email = '$email_S_L'");
        $query_fetch = mysqli_fetch_object($email_query);

        if (mysqli_num_rows($email_query) == 1) {
            return true;
        } else {
            return false;
        }
    }

    
    

    
    





    // Get Users personal info
    function user_personal_data() {
        global $connect_to_database;
        global $user_id;
        global $Database_first_name;
        global $Database_last_name;
        global $Database_full_name;
       
        $user_id = $_COOKIE["login_cookie"];
        $qry_get_user_info_from_db = $connect_to_database->query("SELECT * FROM users WHERE users_id = '$user_id'");

        $query_fetch_user_info = mysqli_fetch_object($qry_get_user_info_from_db);

        if (mysqli_num_rows($qry_get_user_info_from_db) == 1) {

            //Getting first name
            $Database_first_name = $query_fetch_user_info->first_name;

            //Getting last name
            $Database_last_name = $query_fetch_user_info->last_name;

            $Database_full_name = $Database_first_name . " " . $Database_last_name;

            return true;

        } else {
            return false;
        }
            
        

    
    }







    function get_mgs_author_info() {
        global $connect_to_database;
        global $msg_author_index_id;
        global $msg_author_full_name;
        global $last_online_msg_author;
        
        $qry_msg_author_info_db = $connect_to_database->query("SELECT * FROM users WHERE users_id = '$msg_author_index_id'");

        $qry_fetch_msg_author = mysqli_fetch_object($qry_msg_author_info_db);

        if (mysqli_num_rows($qry_msg_author_info_db) > 0) {

            $last_online_msg_author = $qry_fetch_msg_author->users_last_active_time;
            $msg_author_first_name = $qry_fetch_msg_author->first_name;
            $msg_author_last_name = $qry_fetch_msg_author->last_name;
            
            $msg_author_full_name = $msg_author_first_name. " " . $msg_author_last_name;


            // if name is log more than 20 chr so the name will be short
            if (strlen($msg_author_full_name) > 22) {
                $msg_author_full_name = substr($msg_author_first_name, 0, 22) . "...";
            }

            return true;
        } else {
            return false;
        }
    }


    function user_msg_writing_time() {
        global $connect_to_database;
        $user_id = $_COOKIE["login_cookie"];
        $current_time = time() - 3;

        $qry_msg_last_writing_time = $connect_to_database->query("SELECT users_last_msg_writing_time FROM users WHERE users_last_msg_writing_time > '$current_time' AND users_id != '$user_id'");

        if (mysqli_num_rows($qry_msg_last_writing_time) > 0) {
            return true;
        } else {
            return false;
        }
    }
    



    // Limited messages show process
    function is_there_more_than_300_msg() {
        global $connect_to_database;
        global $msg_show_from;
        $query_get_mes_row = $connect_to_database->query("SELECT * FROM user_messages");
        $total_msg_rows = mysqli_num_rows($query_get_mes_row);

        if ($total_msg_rows > 300) {
            $msg_show_from = $total_msg_rows - 300;

            return true;

        } else {
            return false;
        }
    }





?>