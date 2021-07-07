<?php
    /**
     * if button zak_a was clicked ..stopwatch for zak_a is running and others are stopped
     */
    //    if(isset($_POST['zak_a'])&&$zak_b_obj->getRunning()==false&&$pause_obj->getRunning()==false){
    if(isset($_POST[objPropertyName_to_varString($zakaznik_a_obj)])){

        if($zakaznik_a_obj->getRunning()==false){

            $zakaznik_a_obj->starting();
            setcookie(ZAK_A, serialize($zakaznik_a_obj), time()+86400, '/');
            //  $_SESSION['$zak_a_obj']=$zak_a_obj;
        }

        if($zakaznik_b_obj->getRunning()==true){
            $zakaznik_b_obj->pausing();
            setcookie(ZAK_B, serialize($zakaznik_b_obj), time()+86400, '/');
            //  $_SESSION['$zak_b_obj']=$zak_b_obj;
        }

        if($pauza_obj->getRunning()==true){
            $pauza_obj->pausing();
            setcookie(PAUZA, serialize($pauza_obj), time()+86400, '/');
            //  $_SESSION['$pause_obj']=$pause_obj;
        }
    }


    /**
     * if button pause was clicked ..stopwatch for pause is running and others are stopped
     */
    if(isset($_POST[objPropertyName_to_varString($pauza_obj)])){

        if($pauza_obj->getRunning()==false){

            $pauza_obj->starting();
            setcookie(PAUZA, serialize($pauza_obj), time()+86400, '/');
            //  $_SESSION['$pause_obj']=$pause_obj;
        }

        if($zakaznik_b_obj->getRunning()==true){
            $zakaznik_b_obj->pausing();
            setcookie(ZAK_B, serialize($zakaznik_b_obj), time()+86400, '/');
            //  $_SESSION['$zak_b_obj']=$zak_b_obj;
        }

        if($zakaznik_a_obj->getRunning()==true){
            $zakaznik_a_obj->pausing();
            setcookie(ZAK_A, serialize($zakaznik_a_obj), time()+86400, '/');
            //  $_SESSION['$zak_a_obj']=$zak_a_obj;
        }
    }

    /**
     * if button zak_b was clicked ..stopwatch for zak_b is running and others are stopped
     */
    if(isset($_POST[objPropertyName_to_varString($zakaznik_b_obj)])){

        if($zakaznik_b_obj->getRunning()==false){

            $zakaznik_b_obj->starting();
            setcookie(ZAK_B, serialize($zakaznik_b_obj), time()+86400, '/');
            //  $_SESSION['$zak_b_obj']=$zak_b_obj;
        }

        if($zakaznik_a_obj->getRunning()==true){
            $zakaznik_a_obj->pausing();
            setcookie(ZAK_A, serialize($zakaznik_a_obj), time()+86400, '/');
            //  $_SESSION['$zak_a_obj']=$zak_a_obj;
        }

        if($pauza_obj->getRunning()==true){
            $pauza_obj->pausing();
            setcookie(PAUZA, serialize($pauza_obj), time()+86400, '/');
            //  $_SESSION['$pause_obj']=$pause_obj;
        }
    }

    /**
     * if button uloz was clicked ..stopwatch of all objects paused and their values save to DB->tables
     */
    if(isset($_POST['uloz'])&&($zakaznik_b_obj->getRunning()||$zakaznik_a_obj->getRunning()||$pauza_obj->getRunning())){
        //nastaviť pauzu pre všetky objekty
        //a ich príslušné hodnoty odoslať do príslušných databáz

    }

    /**
     * if button reset was clicked ..stopwatch of all objects and their time values are set to zero(0)
     */
    if(isset($_POST['reset'])){

//
//        function anonymFunction2($obj)
//        {
//            $obj->reset();
//            /**
//             *  $obj->name_obj (without ´ˇ)
//             *   - example: from Zákazník_B to COOKIE['zakaznik_b_obj']
//             */
//            setcookie(objPropertyName_to_varString($obj).'_obj', serialize($obj), time()+86400, '/');
//            //  $_SESSION['$obj']=$obj;
//        }
//
//        //array_map("anonymFunction2",$array_obj);

        array_map(function($obj) {

            $obj->reset();
            /**
             *  $obj->name_obj (without ´ˇ)
             *   - example: from Zákazník_B to COOKIE['zakaznik_b_obj']
             */
            setcookie(objPropertyName_to_varString($obj).'_obj', serialize($obj), time()+86400, '/');


        },$array_obj);



    }