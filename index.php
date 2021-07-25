<?php
    require_once "autoloader.inc.php";
    require_once "functions.php";
    require_once "inc/inc.setting.php";


    session_start();

    /**
     * if POST logout ->unset ALL COOKIES and redirect to login
     */
    if(isset($_POST['logout'])){
        /**
         * destroy all COOKIES and redirect to login.php
         */
        session_destroy();
        unsetCookies();
        header("Location: /login.php");
    }

//    // GET CURRENT page
//     $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    /**
     * redirect to login when COOKIE is not set
     */
      if(!isset($_COOKIE['logged'])){
          header("Location: /login.php");
      }else{
          $user=unserialize($_COOKIE['logged']);
      }

    /**
     * some own 2 controlS -> if object user and his email is not in relevant form redirect to login -> MAY BE THIS IS UNNECESSARY
     */
    if(!$user instanceof User){
       header("Location: /login.php");
    }

    if (!filter_var($user->getEmail(), FILTER_VALIDATE_EMAIL)) {
           header("Location: /login.php");
        }

        /**
         * set array of objects
         * object is from $_COOKIE or created new
         */
        $zakaznik_a_obj = isset($_COOKIE[ZAK_A])? unserialize($_COOKIE[ZAK_A]):new StopWatch("Zákazník_A",$user);
        $zakaznik_b_obj = isset($_COOKIE[ZAK_B])? unserialize($_COOKIE[ZAK_B]):new StopWatch("Zákazník_B",$user);
        $pauza_obj = isset($_COOKIE[PAUZA])? unserialize($_COOKIE[PAUZA]):new StopWatch("Pauza",$user);

        $array_obj=array( $zakaznik_a_obj, $zakaznik_b_obj, $pauza_obj);

    require_once "inc/inc.post.php";
?>

  <!doctype html>
  <html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <title>Stopwatch</title>

    </head>
    <body>

            <?php
            /**
             * logout form
             */
            ?>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"><button type="submit" class="btn btn-danger float-right mr-5" name="logout" >Odhlásiť</button></form>

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


        <div class="row w-50 mx-auto mt-5 ">
            <div>

                <?php /**
                        * form Zákazník_A
                        */?>
                <form class=" <?php if(isset($_POST[objPropertyName_to_varString($zakaznik_a_obj)])){ echo "invisible";} ?> col-4 text-center" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <button type="submit" name="<?php echo objPropertyName_to_varString($zakaznik_a_obj)?>" class="btn btn-success mt-5  ">
                        <i class="fa fa-play fa-lg"></i> Zákazník_A
                    </button>
                </form>

                <?php /**
                        * form Zákazník_B
                        */?>
                <form  class="  <?php if(isset($_POST[objPropertyName_to_varString($zakaznik_b_obj)])){ echo "invisible";}?>  col-4 text-center" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <button type="submit" name="<?php echo objPropertyName_to_varString($zakaznik_b_obj)?>" class="btn btn-success mt-5 ">
                        <i class="fa fa-play fa-lg"></i> Zákazník_B
                    </button>
                </form>
            </div>

            <?php /**
                    * form Pauza
                    */?>
            <form  class="  <?php if(isset($_POST[objPropertyName_to_varString($pauza_obj)])){ echo "invisible";}?> col-4 text-center ml-5 mr-5" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <button type="submit" name="<?php echo objPropertyName_to_varString($pauza_obj)?>" class="btn btn-warning mt-5 ">
                    <i class="fa fa-pause fa-lg"></i> Pauza
                </button>
            </form>

            <div class=" text-center col-12 p-3 mt-5 alert alert-primary mx-auto " role="alert">

                <?php
                /**
                 * show message about what thread is running
                 */
                //$array_obj[] - this array is defined on top
                array_map(function($obj) {

                    if ($obj->getRunning()) echo $obj->getMessage();

                },$array_obj);
                ?>
            </div>
        </div >
        <div class="container">
                <?php
                    /**
                     * show time in actual day spending on Zákazník_A/Zákazník_B/Pauza
                     */?>
                <h2 class="mt-3 ">DENNÁ ŠTATISTIKA</h2>
                <div class="ml-5">
                    <h5 class="w-100 mt-3 "><span class="mr-5 ">Zákazník_A</span><?php   echo gmdate("H:i:s",$zakaznik_a_obj->getTotal())  ;?></h5>
                    <h5 class="w-100 mt-1 "><span class="mr-5 ">Zákazník_B</span><?php   echo gmdate("H:i:s",$zakaznik_b_obj->getTotal())  ;?></h5>
                    <h5 class="w-100 mt-1 "><span class="mr-5 ">Pauza</span><span class=" ml-5"><?php   echo gmdate("H:i:s",$pauza_obj->getTotal()) ;?></span></h5>
                </div>


            <?php /**
                    * form Save
                    */?>
            <form style="margin-top:-5%;"  class=" text-center  float-right  mr-5" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <button type="submit" name="save" class="btn btn-info mt-5">
                    <i class="	fa fa-archive fa-lg"></i> Uloziť
                </button>
            </form>

            <?php /**
                    * form Reset
                    */?>
            <form style="margin-top:-5%;" class=" text-center  float-right  mr-5" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <button type="submit" name="reset" class="btn btn-danger mt-5">
                    <i class="fa fa-refresh fa-lg"></i> Reset
                </button>
            </form>
            <h2  class="mt-5 ">DLHODOBÁ ŠTATISTIKA</h2>
            <div class=" ml-5">

                <?php /**
                        * actual month form
                        */?>
                <form  class=" text-left " action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <button type="submit" name="actual-month" class="btn btn-primary mt-3">
                        <i class="fa fa-bar-chart fa-lg"></i> Aktuálny mesiac
                    </button>
                </form>
                <div class="ml-5 mt-2">
                    <p class="m-0"><?php if(isset($_POST["actual-month"])) echo "V aktuálnom mesiaci ste na Zákazníka A odpracovali <span class='font-weight-bold'>". ($act_month_zak_a??"")."</span>"?></p>
                    <p class="m-0"><?php if(isset($_POST["actual-month"])) echo "V aktuálnom mesiaci ste na Zákazníka B odpracovali <span class='font-weight-bold'>".($act_month_zak_b??"")."</span>"?></p>
                </div>
            </div>
            <div class=" ml-5">
                <?php /**
                        * last month form
                        */?>
                <form  class=" text-left  " action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <button type="submit" name="last-month" class="btn btn-primary mt-3">
                    <i class="fa fa-bar-chart fa-lg"></i> Minulý mesiac
                </button>
                </form>
                <div class="ml-5 mt-2">
                    <p class="m-0"><?php if(isset($_POST["last-month"])) echo "V minulom mesiaci ste na Zákazníka A odpracovali <span class='font-weight-bold'>". ($last_month_zak_a??"")."</span>"?></p>
                    <p class="m-0"><?php if(isset($_POST["last-month"])) echo "V minulom mesiaci ste na Zákazníka B odpracovali <span class='font-weight-bold'>".($last_month_zak_b??"")."</span>"?></p>
                </div>
            </div>

            <div class=" ml-5">

                <?php /**
                        * days range form
                        */?>
                <form  class=" text-left  " action="<?php echo $actual_link; ?>" method="post">
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
        <script src="https:print_r(hrtime());//cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    </body>

  </html>
