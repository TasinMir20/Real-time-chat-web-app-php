<?php

    setcookie("login_cookie", "", time() - 60*60*24);
    setcookie("rand_cookie_val", "", time() - 60*60*24);
    
    unset($_COOKIE["login_cookie"]);
    unset($_COOKIE["rand_cookie_val"]);

    header("location: login.php");

?>