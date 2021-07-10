<?php
    /**
     *save
     */

    if(isset($_POST['save'])){

        /**
         *if time for zakaznik_a going -> than pausing
         * and save total seconds of work for zakaznik_a to var $zak_a
         */
        if($zakaznik_a_obj->getRunning()){
            $zakaznik_a_obj->pausing();
        }

        $zak_a=$zakaznik_a_obj->getTotal();

        /**
         *if time for zakaznik_b going -> than pausing
         * and save total seconds of work for zakaznik_b to var $zak_b
         */
        if($zakaznik_b_obj->getRunning()){
            $zakaznik_b_obj->pausing();
        }
        $zak_b=$zakaznik_b_obj->getTotal();


        $stmt = $conn->prepare("INSERT INTO day_work (zakaznik_a, zakaznik_b)  VALUES(:zakaznik_a, :zakaznik_b)");
        $stmt->bindParam(':zakaznik_a',$zak_a );
        $stmt->bindParam(':zakaznik_b',  $zak_b);

        $stmt->execute();

        /**
         * after save reset seconds
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
         * redirect to prevent re-post by refresh
         */
        header('Location: /');
        exit;

    }


    /**
     *actual-month
     */

    if(isset($_POST['actual-month'])){
        /**
         *
         */
        $actual_month=date('m');

        $stmt = $conn->prepare("SELECT SUM(zakaznik_a), SUM(zakaznik_b) FROM day_work WHERE MONTH(datum) = :act_month ");
        $stmt->bindParam(':act_month', $actual_month );
        $stmt->execute();

        // set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $data =$stmt->fetchAll();

        $act_month_zak_a = timeFormat((int)htmlspecialchars($data[0]["SUM(zakaznik_a)"]));
        $act_month_zak_b = timeFormat((int)htmlspecialchars($data[0]["SUM(zakaznik_b)"]));

    }

    /**
     *last-month
     */


    if(isset($_POST['last-month'])){
        $actual_month=date('m');
        if ($actual_month==1) {$actual_month=13;}

        $last_month=$actual_month-1;

        $stmt = $conn->prepare("SELECT SUM(zakaznik_a), SUM(zakaznik_b) FROM day_work WHERE MONTH(datum) = :last_month ");
        $stmt->bindParam(':last_month', $last_month );
        $stmt->execute();

        // set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $data =$stmt->fetchAll();

        $last_month_zak_a = timeFormat((int)htmlspecialchars($data[0]["SUM(zakaznik_a)"]));
        $last_month_zak_b = timeFormat((int)htmlspecialchars($data[0]["SUM(zakaznik_b)"]));

    }

    /**
     *day_range
     */

    if(isset($_POST['day_range'])){
        if (isset($_POST['od_date'])){

            $od= date('Y-j-n', strtotime($_POST['od_date']));
            $do =!empty($_POST['do_date'])? date('Y-j-n', strtotime($_POST['do_date'])):date("Y-j-n");

            $stmt = $conn->prepare("SELECT SUM(zakaznik_a), SUM(zakaznik_b) FROM day_work WHERE datum BETWEEN :od AND :do ");
            $stmt->bindParam(':od',  $od );
            $stmt->bindParam(':do', $do);

            $stmt->execute();

            // set the resulting array to associative
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $data =$stmt->fetchAll();
            print_r($data);
        }

    }