<?php

    $dsn = "mysql:host=localhost;dbname=mediator";       // data source name
    $user = "root";
    $pass = "";
    $option = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8",
    );
    try{
        $con = new PDO ($dsn, $user, $pass, $option);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "you are connceted ";
    }
    catch(PDOException $e){
        echo "failed to connect " . $e->getMessage();  // a message of more info
    }