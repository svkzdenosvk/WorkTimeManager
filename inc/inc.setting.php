<?php

    /**
     *   settings for constants
     */
    //this would be in config file
    const CUST_A = "customer_a_obj";
    const CUST_B = "customer_b_obj";
    const PAUSE = "pause_obj";

    /**
     *   settings for PDO database connection
     */
    //settings for localhost
   $servername = "localhost";
   $username = "root";
   $password = "";

//        settings for live server


    try {
        $conn = new PDO("mysql:host=$servername;dbname=work_manager", $username, $password);

        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Connected successfully";
    } catch (PDOException $e) {
        echo "Problém s pripojením na databázu, kontaktujte webmastra! ";
        die();
    }


