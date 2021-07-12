<?php

    /**
     *   settings for PDO database connection
     */
    //settings for localhost
    $servername = "localhost";
    $username = "root";
    $password = "";

//        settings for localhost
//        $servername = "sql4.webzdarma.cz";
//        $username = "prikladywzsk0510";
//        $password = "8Oj4.e2tfRq(pT(w,Pky";

//    try {
        $conn = new PDO("mysql:host=$servername;dbname=work_manager", $username, $password);
//        $conn = new PDO("mysql:host=$servername;dbname=prikladywzsk0510", $username, $password);

// set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Connected successfully";
//    } catch (PDOException $e) {
//        //echo "Connection failed: " . $e->getMessage();
//    }


