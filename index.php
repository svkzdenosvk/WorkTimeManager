<?php
    require_once "autoloader.inc.php";
    require_once "functions.php";
    require_once "inc/inc.setting.php";


    session_start();

    /**
     * if POST logout ->unset ALL COOKIES and redirect to login
     */
    if(isset($_POST['logout'])){
       logOut();
    }

    /**
     * redirect to login when COOKIE is not set
     */
      if(!isset($_COOKIE['logged'])){
          redirect("prihlasenie");
      }else{
          $user=unserialize($_COOKIE['logged']);
      }

    /**
     * some own 2 controlS -> if object user and his email is not in relevant form redirect to login -> MAY BE THIS IS UNNECESSARY
     */
    if(!$user instanceof User){
        redirect("prihlasenie");
    }

    if (!filter_var($user->getEmail(), FILTER_VALIDATE_EMAIL)) {
        redirect("prihlasenie");
        }

        /**
         * set array of objects
         * object is from $_COOKIE or created new
         */
        $customer_a_obj = isset($_COOKIE[CUST_A])? unserialize($_COOKIE[CUST_A]):new StopWatch("Zákazník_A",$user);
        $customer_b_obj = isset($_COOKIE[CUST_B])? unserialize($_COOKIE[CUST_B]):new StopWatch("Zákazník_B",$user);
        $pause_obj = isset($_COOKIE[PAUSE])? unserialize($_COOKIE[PAUSE]):new StopWatch("Pauza",$user);

        $array_obj=array( $customer_a_obj, $customer_b_obj, $pause_obj);


    require_once "inc/inc.post.php";
?>

    <!doctype html>
    <html lang="sk">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <title>Stopwatch</title>

    </head>
    <body>
        <div class="container  d-flex justify-content-around  ">
            <?php
                /**
                 * logged user
                 */
            ?>
            <button type="button" class="btn btn-outline-info mt-4 disabled font-weight-bold"><?php echo htmlspecialchars($user->getName()); ?></button>

            <?php
                /**
                 * logout form
                 */
            ?>
            <form class="  mt-4 " action="/"method="post"><button type="submit" class="btn btn-danger    " name="logout" >Odhlásiť</button></form>
        </div>

            <?php

            /**
             * flash message after save to DB
             */
            if (isset($_SESSION['flash'])): ?>
        <div class=" text-center col-6 p-3 mt-5 alert alert-success mx-auto " role="alert">
            <?php echo $_SESSION['flash'];
                  unset($_SESSION['flash']);?>
        </div>
            <?php endif;?>

        <div class="row w-50 mx-auto mt-3 ">
            <div class="w-100">

                 <?php
                /**
                 * show buttons to start counting time  
                 */?>
                 <?php renderThreadButtons($array_obj);?>
             
                    
                <div class=" text-center col-12 p-3 mt-5 alert alert-primary mx-auto " role="alert">

                <?php renderRunningThread($array_obj); ?>
            </div>
        </div >
        <div class="container">
                <?php
                    /**
                     * show time in actual day spending on Zákazník_A/Zákazník_B/Pauza
                     */?>
                <h2 class="mt-3 mb-5">DENNÁ ŠTATISTIKA</h2>
                <div class="ml-5">
                    <?php renderDayStatistics($array_obj); ?> 
                    
                </div>

                <?php /**
                        * form Save
                        */               
                        renderControlBtnSave();
                        ?>
            

                <?php /**
                        * form Reset
                        */
                        renderControlBtnReset();
                        ?>
             
          
            <h2  class="mt-5 ">DLHODOBÁ ŠTATISTIKA</h2>
            <div class=" ml-5">

                <?php /**
                        * actual month form
                        */
                        renderCurrentMonthBtn();?>
               
                <div class="ml-5 mt-2">
                    <p class="m-0"><?php if(isset($_POST["actual-month"])) echo "V aktuálnom mesiaci ste na Zákazníka A odpracovali <span class='font-weight-bold'>". ($act_month_zak_a??"")."</span>"?></p>
                    <p class="m-0"><?php if(isset($_POST["actual-month"])) echo "V aktuálnom mesiaci ste na Zákazníka B odpracovali <span class='font-weight-bold'>".($act_month_zak_b??"")."</span>"?></p>
                </div>
            </div>
            <div class=" ml-5">
                <?php /**
                        * last month form
                        */
                        renderLastMonthBtn();?>
              
                <div class="ml-5 mt-2">
                    <p class="m-0"><?php if(isset($_POST["last-month"])) echo "V minulom mesiaci ste na Zákazníka A odpracovali <span class='font-weight-bold'>". ($last_month_zak_a??"")."</span>"?></p>
                    <p class="m-0"><?php if(isset($_POST["last-month"])) echo "V minulom mesiaci ste na Zákazníka B odpracovali <span class='font-weight-bold'>".($last_month_zak_b??"")."</span>"?></p>
                </div>
            </div>

            <div class=" ml-5">

                <?php /**
                        * days range form
                        */?>
                <form  class=" text-left  " action="/" method="post">
                    <button type="submit" name="day_range" class="btn btn-primary">
                        <i class="fa fa-bar-chart fa-lg"></i> Za obdobie
                    </button>

                    <label class="mt-3" >Od: </label>
                    <input type="date" name="od_date" required>

                    <label class="mt-3" >Do: </label>
                    <input type="date"  name="do_date">

                </form>
                    <div class=" mt-2">
                        <p class=" m-0"><?php if(isset($_POST["day_range"])) echo "Za vybraté obdobie ste na Zákazníka A odpracovali <span class='font-weight-bold'>". (empty( $spec_period_zak_a)?"": $spec_period_zak_a)."</span>"?></p>
                        <p class=" m-0"><?php if(isset($_POST["day_range"])) echo "Za vybraté obdobie ste na Zákazníka B odpracovali <span class='font-weight-bold'>".(empty($spec_period_zak_b)?"":$spec_period_zak_b)."</span>"?></p>
                    </div>

            </div>
        </div>
        <!-- Optional JavaScript -->

        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    </body>

  </html>
