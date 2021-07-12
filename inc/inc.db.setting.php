<?php

    /**
     *   settings for PDO database connection
     */

    $servername = "localhost";
    $username = "root";
    $password = "";

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









//    /**
//     *settings for PDO database connection - create db and create table
//     */
//
//    //global $conn;
//    $servername = "localhost";
//    $username = "root";
//    $password = "";
//
//    try {
//         $conn = new PDO("mysql:host=$servername",  $username, $password);
//        // set the PDO error mode to exception
//        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
////               echo "Connected successfully";
////    } catch (PDOException $e) {
////        echo "Connection failed: " . $e->getMessage();
////    }
//        $sql = "CREATE DATABASE IF NOT EXISTS bankomatDBPDO";
//        // use exec() because no results are returned
//        $conn->exec($sql);
//        echo "som tu 0";
//        $stmt = $conn->prepare( "DESCRIBE `Vyber`");
//        if ( $stmt->execute() ) {
//            // my_table exists
//            echo "som tu";
//        } else {
//            $conn = new PDO("mysql:host=$servername;dbname=bankomatDBPDO", $username, $password);
//            // set the PDO error mode to exception
//            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//
//            $sql = "CREATE TABLE Vyber (
//                      id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//                      firstname VARCHAR(30) NOT NULL,
//                      lastname VARCHAR(30) NOT NULL,
//                      email VARCHAR(50),
//                      reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
//                      )";
//            $conn->exec($sql);
//        }
//    } catch(PDOException $e) {
//        echo $e->getMessage();
//    }
//
//$conn = null;

