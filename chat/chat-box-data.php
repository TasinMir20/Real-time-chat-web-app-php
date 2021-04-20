
<?php

require "../functions.php";


if (!login_access_user()) {
    die();
}

user_personal_data();

?>




<div class="chat-box-inner clearfix">
<?php
    
    if (isset($_POST["frequently-msg-load"])) {

?>
                    <?php
                        
                        if (is_there_more_than_300_msg()) {
                            $query_get_mes_frm_db = $connect_to_database->query("SELECT * FROM user_messages LIMIT $msg_show_from, 300;");
                        } else {
                            $query_get_mes_frm_db = $connect_to_database->query("SELECT * FROM user_messages");
                        }


                        while($query_get_mes_fetch = mysqli_fetch_assoc($query_get_mes_frm_db)):

                    ?>

                    <div class="single-text-box <?php
                    $msg_author_index_id = $query_get_mes_fetch["msg_author_index_id"];

                    $own = $msg_author_index_id == $_COOKIE["login_cookie"];

                     if ($own) {
                        echo "outgoing-mgs";

                    } else {
                        echo "incoming-mgs";
                    }
                    
                    ?>">
                        <span class="msg-author">

                        <?php
                            
                            if ($own) {
                                echo "You";

                            } else {

                                if (get_mgs_author_info()) {
                                    echo $msg_author_full_name;

                                } else {
                                    echo "User removed";
                                }
                            }
                        ?>

                        <i class="fas fa-circle 
                            <?php
                                if (!$own) {
                                    if (get_mgs_author_info()) {

                                        $online_user = ((int)$last_online_msg_author) > time() - 10;
                                        if ($online_user) {
                                            echo "user-online";
                                        }
                                    }
                                    
                                } elseif($own) {
                                    echo "user-online";
                                }
                                
                            ?>
                        
                        "></i>
                        </span>
                        

                        <?php
                            $message = $query_get_mes_fetch["messages"];
                            $msg = $filter_html_tag = filter_var($message, FILTER_SANITIZE_STRING);;
                        ?>
                        <span class="the-msg <?php
                            if (!$msg) {
                                echo "delete-msg-style";
                            }

                        ?>">
                            <?php
                                if (strlen($msg) > 0) {
                                    echo $msg;
                                    
                                } 
                                elseif (strlen($message) > 0 && strlen($msg) == 0) {
                                    echo "The message has been removed by our automated system!";
                                } 
                                elseif (strlen($msg) < 1) {
                                    echo "The message has been deleted by the author.";
                                }
                            ?>
                        </span>
                        <span class="msg-time">
                            <?php
                                $msg_time = $query_get_mes_fetch["msg_sent_time"];
                                echo $msg_time;
                            ?>
                        </span>
                    </div>

                    <?php endwhile ?>

<?php
        if (user_msg_writing_time()) {
            echo "<div class='msg-writing'><span>Someone is writing...</span></div>";

        }

    }

?>
</div>