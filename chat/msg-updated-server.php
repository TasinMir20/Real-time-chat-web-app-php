<?php

require "../functions.php";



if (login_access_user()) {

    if (isset($_POST["message-sent"])) {

        $message = $_POST["message-a"];
        $message_author_index_id = $_COOKIE["login_cookie"];
    
        // Start message sent Time and Date
        date_default_timezone_set('Asia/Dhaka');
        $date = date('d-M-Y');
        $time = date('h:i:s A');
    
        $message_sent_time = $time . " | " . $date;
        // End message sent Time and Date
    
    
        if (strlen($message) > 0) {
            $insert_message = $connect_to_database->query("INSERT INTO user_messages (messages, msg_author_index_id, msg_sent_time) VALUES ('$message', '$message_author_index_id', '$message_sent_time')");
        }  
    }

} else {
    echo "<p class='danger-message'>You don't have access for this page! <a href='../logout.php'>reload please</a></p>";
}





?>