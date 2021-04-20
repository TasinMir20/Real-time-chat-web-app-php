(function($) {


    jQuery(document).ready(function() {

        jQuery(".sign-up-btn").click(function() {

            var firstName = jQuery(".fst-nm").val();
            var lastName = jQuery(".lst-nm").val();
            var emailAddress = jQuery(".eml").val();
            var password = jQuery(".pass").val();

            $.ajax({

                "url" : "signup.php",
                "type" : "post",
                "data" : {
                    "sign-up-clc-a" : "ok",

                    "first-name-a" : firstName,
                    "last-name-a" : lastName,
                    "email-address-a" : emailAddress,
                    "password-a" : password
                },
                "success" : function(signup_pg_data) {
                    jQuery(".fdbk-aftr-sbmt").html(signup_pg_data);
                    jQuery(".inputs").val("");
                }

            });

            return false;

        });

    });



}(jQuery))








