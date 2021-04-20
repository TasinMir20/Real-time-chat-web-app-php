(function($) {


    jQuery(document).ready(function() {


        // message send to the database after click the sent button
        jQuery(".message-sent-btn").click(function() {
            var message = document.querySelector(".message").value;

            $.ajax({
                "url" : "msg-updated-server.php",
                "type" : "post",
                "data" : {
                    "message-sent" : "ok",
                    "message-a" : message
                },
                "success" : function(mgs_updated) {
                    jQuery(".msg-up-or-not").html(mgs_updated);

                    document.querySelector(".message").value = "";
                }
            });

            return false;
        });


        // Frequently chat messages load
        function frequently_update() {

            $.ajax({

                "url" : "chat-box-data.php",
                "type" : "post",
                "data" : {
                    "frequently-msg-load" : "set"
                },
                "success" : function(chat_box_data) {
                    jQuery(".chat-box").html(chat_box_data);
                }
            });

            return false;
        }
        
        setInterval(frequently_update, 200);
        
        frequently_update();


        // User last online time update
        function user_last_online_update() {
            $.ajax({

                "url" : "index.php",
                "type" : "post",
                "data" : {
                    "user_online_update" : "set"
                }
            });

            return false;
        }
        
        setInterval(user_last_online_update, 2000);
        
        user_last_online_update();


        // User last msg writing time update
        function user_last_msg_writing() {
            $.ajax({

                "url" : "index.php",
                "type" : "post",
                "data" : {
                    "user_msg_writing" : "yes"
                }
            });

            return false;
        }
        
        document.querySelector(".message").onkeyup = user_last_msg_writing;


        


    });



}(jQuery))
