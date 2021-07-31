<?php

    /**
     *   settings for constants
     */
    //this would be in config file
    const ZAK_A = "zakaznik_a_obj";
    const ZAK_B = "zakaznik_b_obj";
    const PAUZA = "pauza_obj";

    /**
     *   settings for PDO database connection
     */
    //settings for localhost
//    $servername = "localhost";
//    $username = ":)";
//    $password = "";

//        settings for live server


    try {
        $conn = new PDO("mysql:host=$servername;dbname=", $username, $password);

        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Connected successfully";
    } catch (PDOException $e) {
        echo "Problém s pripojením na databázu, kontaktujte webmastra! ";
        die();
    }


