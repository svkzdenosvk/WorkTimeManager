<?php
    /*******************************************************************************************************************
     * if button zak_a was clicked ..stopwatch for zak_a is running and others are stopped
     */
    if(isset($_POST[objPropertyName_to_varString($zakaznik_a_obj)])){

        if($zakaznik_a_obj->getRunning()==false){

            $zakaznik_a_obj->starting();
            setcookie(ZAK_A, serialize($zakaznik_a_obj), time()+86400, '/');
        }

        if($zakaznik_b_obj->getRunning()==true){
            $zakaznik_b_obj->pausing();
            setcookie(ZAK_B, serialize($zakaznik_b_obj), time()+86400, '/');
        }

        if($pauza_obj->getRunning()==true){
            $pauza_obj->pausing();
            setcookie(PAUZA, serialize($pauza_obj), time()+86400, '/');
        }
    }


    /*******************************************************************************************************************
     * if button pause was clicked ..stopwatch for pause is running and others are stopped
     */
    if(isset($_POST[objPropertyName_to_varString($pauza_obj)])){

        if($pauza_obj->getRunning()==false){

            $pauza_obj->starting();
            setcookie(PAUZA, serialize($pauza_obj), time()+86400, '/');
        }

        if($zakaznik_b_obj->getRunning()==true){
            $zakaznik_b_obj->pausing();
            setcookie(ZAK_B, serialize($zakaznik_b_obj), time()+86400, '/');
        }

        if($zakaznik_a_obj->getRunning()==true){
            $zakaznik_a_obj->pausing();
            setcookie(ZAK_A, serialize($zakaznik_a_obj), time()+86400, '/');
        }
    }


    /*******************************************************************************************************************
     * if button zak_b was clicked ..stopwatch for zak_b is running and others are stopped
     */
    if(isset($_POST[objPropertyName_to_varString($zakaznik_b_obj)])){

        if($zakaznik_b_obj->getRunning()==false){

            $zakaznik_b_obj->starting();
            setcookie(ZAK_B, serialize($zakaznik_b_obj), time()+86400, '/');
        }

        if($zakaznik_a_obj->getRunning()==true){
            $zakaznik_a_obj->pausing();
            setcookie(ZAK_A, serialize($zakaznik_a_obj), time()+86400, '/');
        }

        if($pauza_obj->getRunning()==true){
            $pauza_obj->pausing();
            setcookie(PAUZA, serialize($pauza_obj), time()+86400, '/');
        }
    }


    /*******************************************************************************************************************
     * if button reset was clicked ..stopwatch of all objects and their time values are set to zero(0)
     */
    if(isset($_POST['reset'])){

        array_map(function($obj) {

            $obj->reset();
            /**
             *  $obj->name_obj (without ´ˇ)
             *   - example: from Zákazník_B to COOKIE['zakaznik_b_obj']
             */
            setcookie(objPropertyName_to_varString($obj).'_obj', serialize($obj), time()+86400, '/');


        },$array_obj);
    }

/***********************************************************************************************************************
                                                        /**
                                                         *
                                                         * DB - posts
                                                         *
                                                         */

    require_once "inc.post.db.php";