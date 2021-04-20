<?php
    $host = "localhost";
    $username = "class-49-chat-application";
    $password = "123456";
    $database_name = "class-49-chat-application";


    //$connect_to_database = mysqli_connect($host, $username, $password, $database_name);

    $connect_to_database = new mysqli($host, $username, $password, $database_name);



?>