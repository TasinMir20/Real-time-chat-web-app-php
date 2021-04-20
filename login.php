
<?php

require "functions.php";


if (login_access_user()) {

    header("location: chat/index.php");

    die();

} else {
    setcookie("login_cookie", "", time() - 60*60*24);
    setcookie("rand_cookie_val", "", time() - 60*60*24);
    
    unset($_COOKIE["login_cookie"]);
    unset($_COOKIE["rand_cookie_val"]);
}


if (isset($_POST["login"])) {

    $user_email = $_POST["user-email-address"];
    $user_password = $_POST["user-password"];
    $keep_login = isset($_POST["check-box"]);

    $email_S_L = $user_email;

    if ($user_email && $user_password) {

        if (exist_email()) {

            define("DATABASE_PASSWORD", $query_fetch->passwords);
            $user_index_id = $query_fetch->users_id;
            $get_unique_cookie_val = $query_fetch->user_unique_login_cookie_value;
    

            if (password_verify($user_password, DATABASE_PASSWORD)) {

                if ($keep_login) {
                    setcookie("login_cookie", $user_index_id, time() + 60*60*24);
                    setcookie("rand_cookie_val", $get_unique_cookie_val, time() + 60*60*24);
                    header("location: chat/index.php");
                } else {
                    setcookie("login_cookie", $user_index_id);
                    setcookie("rand_cookie_val", $get_unique_cookie_val);
                    header("location: chat/index.php");
                }
                
            } else {
                $rpt = "<p class='danger-message'>Password is wrong!</p>";
            }
    
        } else {
            $rpt = "<p class='danger-message'>You are not registered!</p>";
        }

    } else {
        $rpt = "<p class='warning-message'>Fill in all the inputs!</p>";
    }

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Description" content="Chat web application made by @TasinMir20">
    <link rel="icon" href="img/fav.ico" type="image/x-icon">
    <title>Log In</title>
    <link rel="stylesheet" href="font-icons/fontawesome-free-5.15.2-web/css/all.min.css">
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <section class="section-login">
        <div class="container">
           <div class="login-account-container">
                <div class="heading">
                    <h3>Log In</h3>
                </div>
                <form action="" method="post">
                    <div class="contnr-inpt">
                        <input class="inputs u-eml" type="text" placeholder="Email address" name="user-email-address">
                    </div>
                    <div class="contnr-inpt pass-contnr">
                        <input class="inputs u-pass" type="password" placeholder="Password" name="user-password">
                        <i class="fas fa-eye"></i>
                    </div>
                    <div class="contnr-check">
                        <input type="checkbox" name="check-box" id="check">
                        <label for="check">Login for next 24 hours</label>
                    </div>
                    <div class="contnr-inpt">
                        <button class="login-btn" name="login">Login</button>
                    </div>
                </form>
                <div class="still-dont-acnt">
                    <span>You don't have an account yet? <a href="signup.php">Sign Up</a></span>
                </div>
                <div class="fdbk-aftr-sbmt">
                    <?php
                        if (isset($rpt)) {
                            echo $rpt;
                        }
                    ?>
                </div>
           </div>
        </div>
    </section>

    <script src="js/plain-script.js"></script>
</body>
</html>