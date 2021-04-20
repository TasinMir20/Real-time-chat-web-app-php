
<?php

    require "functions.php";

    if (login_access_user()) {

        header("location: chat/index.php");
    

        die();
        
    } elseif (isset($_POST["sign-up-clc-a"])) {

        $first_name = $_POST["first-name-a"];
        $last_name = $_POST["last-name-a"];
        $email = $_POST["email-address-a"];
        $password = $_POST["password-a"];
        $enough_pass_len = strlen($password) > 8;

        $email_S_L = $email;
        

        $email_valid = filter_var($email, FILTER_VALIDATE_EMAIL);

        if ($first_name && $last_name && $email && $password && $enough_pass_len && $email_valid) {

            
            if (!exist_email()) {

                $rand_num1 = (rand(1000, 9999));
                $rand_num2 = (rand(1000, 9999));
                $rand_num = $rand_num1 . $rand_num2;
                $rand_num_enc = md5($rand_num);

                $unique_cookie_val = $rand_num_enc;

                $encrypted_password = password_hash($password, PASSWORD_DEFAULT);
    
                $insert_data = $connect_to_database->query("INSERT INTO users (first_name, last_name, email, passwords, user_unique_login_cookie_value, users_last_active_time, users_last_msg_writing_time) VALUES ('$first_name', '$last_name', '$email', '$encrypted_password', '$unique_cookie_val', '', '')");
    
    
                if ($insert_data) {
                    echo "<p class='success-message'>You have been successfully registered, now <a href='login.php'>Login</a>.</p>";
                }
    
            } else {
                echo "<p class='danger-message'>Email is already registered!</p>";
            }

        }
        elseif (!$first_name || !$last_name || !$email || !$password) {
            echo "<p class='warning-message'>Fill in all the inputs!</p>";
        }
        
        elseif (!$enough_pass_len) {
            echo "<p class='warning-message'>Password cannot be less than 8 characters!</p>";
        }

        if (!$email_valid && $email) {
            echo "<p class='danger-message'>Email is not valid!</p>";
        }
        
        

        die();
        
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
    <title>Sign Up</title>
    <link rel="stylesheet" href="font-icons/fontawesome-free-5.15.2-web/css/all.min.css">
    <link rel="stylesheet" href="css/signup.css">
</head>
<body>
    <section class="section-sign-up">
        <div class="container">
           <div class="create-account-container">
                <div class="heading">
                    <h3>Create an account</h3>
                </div>
                <form action="" method="post">
                    <div class="contnr-inpt">
                        <input class="inputs fst-nm" type="text" placeholder="First name" name="first-name">
                    </div>
                    <div class="contnr-inpt">
                        <input class="inputs lst-nm" type="text" placeholder="Last name" name="last-name">
                    </div>
                    <div class="contnr-inpt">
                        <input class="inputs eml" type="text" placeholder="Email address" name="email-address">
                    </div>
                    <div class="contnr-inpt pass-contnr">
                        <input class="inputs pass" type="password" placeholder="Password" name="password">
                        <i class="fas fa-eye"></i>
                    </div>
                    <div class="contnr-inpt">
                        <button class="sign-up-btn" name="sign-up">Sign Up</button>
                    </div>
                </form>
                <div class="already-hv-acnt">
                    <span>Already have an account? <a href="login.php">Login</a></span>
                </div>
                <div class="fdbk-aftr-sbmt"></div>
           </div>
        </div>
    </section>
    <script src="js/jquery.min-3.5.1.js"></script>
    <script src="js/scripts-for-jquery.js"></script>
    <script src="js/plain-script.js"></script>
</body>
</html>