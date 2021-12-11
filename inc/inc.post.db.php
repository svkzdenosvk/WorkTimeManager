<?php

    /*******************************************************************************************************************
     *save post
     */
    $userEmail=$customer_a_obj->getUser()->getEmail(); //- ak tak toto otvorit
    ////$userEmail=$array_obj[0]->getUser()->getEmail();


    if(isset($_POST['save'])){

        /**
         *if time for zakaznik_a going -> then pausing
         * and save total seconds of work for zakaznik_a to var $zak_a
         */
        if($customer_a_obj->getRunning()){
            $customer_a_obj->pausing();
        }

        $zak_a=$customer_a_obj->getTotal();

        /**
         *if time for zakaznik_b going -> then pausing
         * and save total seconds of work for zakaznik_b to var $zak_b
         */
        if($customer_b_obj->getRunning()){
            $customer_b_obj->pausing();
        }
        $zak_b=$customer_b_obj->getTotal();


        $stmt = $conn->prepare("INSERT INTO day_work (zakaznik_a, zakaznik_b, user)  VALUES(:zakaznik_a, :zakaznik_b, :user)");
        $stmt->bindParam(':zakaznik_a',$zak_a );
        $stmt->bindParam(':zakaznik_b',  $zak_b);
        $stmt->bindParam(':user',  $userEmail);


        $stmt->execute();

        /**
         * after save -> reset seconds
         */
        array_map(function($obj) {

            $obj->reset();

            /**
             *  $obj->name_obj (without ´ˇ)
             *   - example: from Zákazník_B to COOKIE['zakaznik_b_obj']
             */
            setcookie(objPropertyName_to_varString($obj).'_obj', serialize($obj), time()+86400, '/');


        },$array_obj);

        /**
         * add flash message
         */
        $_SESSION['flash'] = 'Údaje sa uložili';

        /**
         * redirect to prevent re-post by refresh page (f5)
         */
        redirect("/");
        
        exit();

    }


    /*******************************************************************************************************************
     *actual-month post
     */
    if(isset($_POST['actual-month'])){

        /**
         *select actual month
         */
        $actual_month=date('m');

        /**
         *f.-> select data from DB by MONTH
         */
        $data=selectWhereMonthFromDB($conn,$actual_month,$userEmail);

        /**
         *add data from DB to variables to show in index
         */
        $act_month_zak_a = timeFormat((int)htmlspecialchars($data[0]["SUM(zakaznik_a)"]));
        $act_month_zak_b = timeFormat((int)htmlspecialchars($data[0]["SUM(zakaznik_b)"]));

    }


    /*******************************************************************************************************************
     *last-month post
     */
    if(isset($_POST['last-month'])){

        /**
         *select previous month
         */
        $actual_month=date('m');
        if ($actual_month==1) {$actual_month=13;}

        $last_month=$actual_month-1;

        /**
         *f.-> select data from DB by MONTH
         */
        $data=selectWhereMonthFromDB($conn,$last_month,$userEmail);

        /**
         *add data from DB to variables to show in index
         */
        $last_month_zak_a = timeFormat((int)htmlspecialchars($data[0]["SUM(zakaznik_a)"]));
        $last_month_zak_b = timeFormat((int)htmlspecialchars($data[0]["SUM(zakaznik_b)"]));

    }


    /*******************************************************************************************************************
     *day_range post
     */
    if(isset($_POST['day_range'])){

        /**
         *from_date is required, if to_date is not set(applies current date)
         */
        if (isset($_POST['od_date'])){

            $od= date('Y-m-d', strtotime($_POST['od_date']));
            $do= date('Y-m-d H:i:s', strtotime($_POST['do_date'].' 23:59:59.993'));


            $stmt = $conn->prepare("SELECT SUM(zakaznik_a), SUM(zakaznik_b) FROM day_work WHERE datum BETWEEN :od AND :do AND user = :user ");
            $stmt->bindParam(':od',  $od );
            $stmt->bindParam(':do', $do);
            $stmt->bindParam(':user', $userEmail );


            $stmt->execute();

            // set the resulting array to associative
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $data =$stmt->fetchAll();

            /**
             *add data from DB to variables to show in index("/")
             */
            $spec_period_zak_a = timeFormat((int)htmlspecialchars($data[0]["SUM(zakaznik_a)"]));
            $spec_period_zak_b = timeFormat((int)htmlspecialchars($data[0]["SUM(zakaznik_b)"]));
        }

    }