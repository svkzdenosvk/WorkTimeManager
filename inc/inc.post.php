<?php



    /*******************************************************************************************************************
     * if button zak_a was clicked ..stopwatch for cust_a is running and others are stopped
     */
    if(isset($_POST[objPropertyName_to_varString($customer_a_obj)])){
      

        if($customer_a_obj->getRunning()==false){

            $customer_a_obj->starting();
            setcookie(CUST_A, serialize($customer_a_obj), time()+86400, '/');
        }

        if($customer_b_obj->getRunning()==true){
            $customer_b_obj->pausing();
            setcookie(CUST_B, serialize($customer_b_obj), time()+86400, '/');
        }

        if($pause_obj->getRunning()==true){
            $pause_obj->pausing();
            setcookie(PAUSE, serialize($pause_obj), time()+86400, '/');
        }
    }


    /*******************************************************************************************************************
     * if button pause was clicked ..stopwatch for pause is running and others are stopped
     */
    if(isset($_POST[objPropertyName_to_varString($pause_obj)])){
      
        
        if($customer_a_obj->getRunning()==true){
            $customer_a_obj->pausing();
            setcookie(CUST_A, serialize($customer_a_obj), time()+86400, '/');
        }

        if($customer_b_obj->getRunning()==true){
            $customer_b_obj->pausing();
            setcookie(CUST_B, serialize($customer_b_obj), time()+86400, '/');
        }

        if($pause_obj->getRunning()==false){

            $pause_obj->starting();
            setcookie(PAUSE, serialize($pause_obj), time()+86400, '/');
        }
       
    }


    /*******************************************************************************************************************
     * if button zak_b was clicked ..stopwatch for cust_b is running and others are stopped
     */
    if(isset($_POST[objPropertyName_to_varString($customer_b_obj)])){
       

        if($customer_a_obj->getRunning()==true){
            $customer_a_obj->pausing();
            setcookie(CUST_A, serialize($customer_a_obj), time()+86400, '/');
        }

        if($customer_b_obj->getRunning()==false){

            $customer_b_obj->starting();
            setcookie(CUST_B, serialize($customer_b_obj), time()+86400, '/');
        }

        if($pause_obj->getRunning()==true){
            $pause_obj->pausing();
            setcookie(PAUSE, serialize($pause_obj), time()+86400, '/');
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