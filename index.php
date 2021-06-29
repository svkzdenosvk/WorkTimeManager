<?php
    require_once "autoloader.inc.php";

    session_start();

    $zak_a_obj=isset($_SESSION['$zak_a_obj'])?$_SESSION['$zak_a_obj']:new StopWatch("Zákazník_A");
    $zak_b_obj=isset($_SESSION['$zak_b_obj'])?$_SESSION['$zak_b_obj']:new StopWatch("Zákazník_B");
    $pause_obj=isset($_SESSION['$pause_obj'])?$_SESSION['$pause_obj']:new StopWatch("Pauza");



    /**
     * if button zak_a was clicked ..stopwatch for zak_a is running and others are stopped
     */
//    if(isset($_POST['zak_a'])&&$zak_b_obj->getRunning()==false&&$pause_obj->getRunning()==false){
    if(isset($_POST['zak_a'])){

        $zak_a_obj->starting();
        $_SESSION['$zak_a_obj']=$zak_a_obj;

        if($zak_b_obj->getRunning()==true){
            $zak_b_obj->pausing();
            $_SESSION['$zak_b_obj']=$zak_b_obj;
        }

        if($pause_obj->getRunning()==true){
            $pause_obj->pausing();
            $_SESSION['$pause_obj']=$pause_obj;
        }

    }


    /**
     * if button pause was clicked ..stopwatch for pause is running and others are stopped
     */
    if(isset($_POST['pause'])){

        $pause_obj->starting();
        $_SESSION['$pause_obj']=$pause_obj;

        if($zak_b_obj->getRunning()==true){
            $zak_b_obj->pausing();
            $_SESSION['$zak_b_obj']=$zak_b_obj;
        }

        if($zak_a_obj->getRunning()==true){
            $zak_a_obj->pausing();
            $_SESSION['$zak_a_obj']=$zak_a_obj;
        }
    }

    /**
     * if button zak_b was clicked ..stopwatch for zak_b is running and others are stopped
     */
    if(isset($_POST['zak_b'])){

        $zak_b_obj->starting();
        $_SESSION['$zak_b_obj']=$zak_b_obj;

        if($zak_a_obj->getRunning()==true){
            $zak_a_obj->pausing();
            $_SESSION['$zak_a_obj']=$zak_a_obj;
        }

        if($pause_obj->getRunning()==true){
            $pause_obj->pausing();
            $_SESSION['$pause_obj']=$pause_obj;
        }
    }

    /**
     * if button uloz was clicked ..stopwatch of all objects paused and their values save to DB->tables
     */
    if(isset($_POST['uloz'])&&($zak_b_obj->getRunning()||$zak_a_obj->getRunning()||$pause_obj->getRunning())){
            //nastaviť pauzu pre všetky objekty
            //a ich príslušné hodnoty odoslať do príslušných databáz


    }

    /**
     * if button reset was clicked ..stopwatch of all objects and their time values are set to zero(0)
     */
    if(isset($_POST['reset'])){
        $pause_obj->reset();
        $_SESSION['$pause_obj']=$pause_obj;

        $zak_a_obj->reset();
        $_SESSION['$zak_a_obj']=$zak_a_obj;

        $zak_b_obj->reset();
        $_SESSION['$zak_b_obj']=$zak_b_obj;
    //        $stopWatch_obj->reset();
    //        $_SESSION['stopWatch_object']=$stopWatch_obj;
    }
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



        ?>

        <div class="row w-50 mx-auto mt-5 ">
            <div>
                <form class="col-4 text-center"action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <button type="submit" name="zak_a" class="btn btn-success mt-5 ">
                        <i class="fa fa-play fa-lg"></i> Zákazník_A
                    </button>
                </form>

                <form  class="col-4 text-center" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <button type="submit" name="zak_b" class="btn btn-success mt-5 ">
                        <i class="fa fa-play fa-lg"></i> Zákazník_B
                    </button>
                </form>
            </div>

            <form  class="col-4 text-center ml-5 mr-5" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <button type="submit" name="pause" class="btn btn-warning mt-5 ">
                    <i class="fa fa-pause fa-lg"></i> Pauza
                </button>
            </form>
            <h5 class="w-100 text-center mt-5"> <?php echo  $zak_a_obj->getMessage() ;?></h5>
            <h5 class="w-100 text-center mt-5"> <?php echo  $zak_b_obj->getMessage() ;?></h5>
            <h5 class="w-100 text-center mt-5"> <?php echo  $pause_obj->getMessage() ;?></h5>

            <h5 class="w-100 mt-5 "><span class="mr-5">Zákazník_A</span><?php   echo gmdate("H:i:s",$zak_a_obj->getTotal())  ;?></h5>
            <h5 class="w-100 mt-1 "><span class="mr-5">Zákazník_B</span><?php   echo gmdate("H:i:s",$zak_b_obj->getTotal())  ;?></h5>
            <h5 class="w-100 mt-1"><span class="mr-5">Pauza</span><span class="ml-5"><?php   echo gmdate("H:i:s",$pause_obj->getTotal())  ;?></span></h5>

        </div>
            <form  class=" text-center  float-right mt-5 mr-5" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <button type="submit" name="uloz" class="btn btn-info mt-5">
                    <i class="fa fa-fast-backward fa-lg"></i> Reset
                </button>
            </form>

        <form  class=" text-center  float-right mt-5 mr-5" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <button type="submit" name="reset" class="btn btn-danger mt-5">
                <i class="fa fa-fast-backward fa-lg"></i> Reset
            </button>
        </form>



        <!-- Optional JavaScript -->
            <!-- jQuery first, then Popper.js, then Bootstrap JS -->
            <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
            <script src="https:print_r(hrtime());//cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        </body>
    </html>
