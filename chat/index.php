<?php

require "../functions.php";



if (!login_access_user()) {

    //header("location: ../logout.php");
    //header("location: ../login.php");

    header("Refresh:0; url=../logout.php");
    die();

}




if (isset($_POST["user_online_update"])) {
    $last_online_time = time();
    $user_id = $_COOKIE["login_cookie"];
    //last active time update query
    $update_user_last_active = $connect_to_database->query("UPDATE users SET users_last_active_time = '$last_online_time' WHERE users_id = '$user_id'");

}




if (isset($_POST["user_msg_writing"])) {
    
    $last_msg_writing_time = time();
    $user_id = $_COOKIE["login_cookie"];
    //last active time update query
    $update_user_last_msg_writing = $connect_to_database->query("UPDATE users SET users_last_msg_writing_time = '$last_msg_writing_time' WHERE users_id = '$user_id'");

}

?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Description" content="Chat web application made by @TasinMir20">
    <link rel="icon" href="../img/fav.ico" type="image/x-icon">
    <title>Chatroom</title>
    <link rel="stylesheet" href="../font-icons/fontawesome-free-5.15.2-web/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <section class="chat-section">
        <div class="container">
            <div class="chat-area">
                <div class="chat-header">
                    <a class="left-arrow" href="../logout.php"><i class="fas fa-arrow-left"></i></a>
                    <div>
                        <h4>Chatroom</h4>
                    </div>
                </div>
                <div class="chat-box">

                    <!-- Outgoing message HTML structure -->
                    <!-- 
                    <div class="single-text-box outgoing-mgs">
                        <span class="msg-author">Tasin Mir
                            <i class="fas fa-circle user-online"></i>
                        </span>
                        <span class="the-msg delete-msg-style">Hello</span>
                        <span class="msg-time">8:20 PM</span>
                    </div>
                    -->

                    <!-- Incoming message HTML structure -->
                    <!--   
                    <div class="single-text-box incoming-mgs">
                        <span class="msg-author">Sakib Mir
                            <i class="fas fa-circle user-online"></i>
                        </span>
                        <span class="the-msg delete-msg-style">Hi</span>
                        <span class="msg-time">8:21 PM</span>
                    </div>  
                    -->
                    
                </div>
                <form action="#" method="post"class="message-sent-area">
                    <input class="msg msg-and-btn message" name="message" type="text" placeholder="Type a message...">
                    <button class="snt-btn msg-and-btn message-sent-btn"><i class="fab fa-telegram-plane"></i></button>
                </form>
                <div class="msg-up-or-not">

                </div>
            </div>
        </div>
    </section>

    <script src="../js/jquery.min-3.5.1.js"></script>
    <script src="js/scripts-for-jquery.js"></script>
    <script src="js/plain-script.js"></script>
    
</body>
</html>