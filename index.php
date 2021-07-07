<?php
    require_once "autoloader.inc.php";
    require_once "functions.php";

    //this would be in config file
    const ZAK_A = "zakaznik_a_obj";
    const ZAK_B = "zakaznik_b_obj";
    const PAUZA = "pauza_obj";

        $zakaznik_a_obj = isset($_COOKIE[ZAK_A])? unserialize($_COOKIE[ZAK_A]):new StopWatch("Zákazník_A");
        $zakaznik_b_obj = isset($_COOKIE[ZAK_B])? unserialize($_COOKIE[ZAK_B]):new StopWatch("Zákazník_B");
        $pauza_obj = isset($_COOKIE[PAUZA])? unserialize($_COOKIE[PAUZA]):new StopWatch("Pauza");

        $array_obj=array( $zakaznik_a_obj, $zakaznik_b_obj, $pauza_obj);

//try it again with sessions and destruct -a pred destruct ulozit do databazy alebo !!!!!


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
            <script src="jquery"></script>

        </head>
        <body>
      
        <div class="row w-50 mx-auto mt-5 ">
            <div>
                <form class=" <?php if(isset($_POST[objPropertyName_to_varString($zakaznik_a_obj)])){ echo "invisible";} ?> col-4 text-center" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <button type="submit" name="<?php echo objPropertyName_to_varString($zakaznik_a_obj)?>" class="btn btn-success mt-5  ">
                        <i class="fa fa-play fa-lg"></i> Zákazník_A
                    </button>
                </form>

                <form  class="  <?php if(isset($_POST[objPropertyName_to_varString($zakaznik_b_obj)])){ echo "invisible";}?>  col-4 text-center" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <button type="submit" name="<?php echo objPropertyName_to_varString($zakaznik_b_obj)?>" class="btn btn-success mt-5 ">
                        <i class="fa fa-play fa-lg"></i> Zákazník_B
                    </button>
                </form>
            </div>

            <form  class="  <?php if(isset($_POST[objPropertyName_to_varString($pauza_obj)])){ echo "invisible";}?> col-4 text-center ml-5 mr-5" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <button type="submit" name="<?php echo objPropertyName_to_varString($pauza_obj)?>" class="btn btn-warning mt-5 ">
                    <i class="fa fa-pause fa-lg"></i> Pauza
                </button>
            </form>

<!--                <div class=" text-center col-12 p-3 mt-5 alert --><?php //if($_SERVER['REQUEST_METHOD']=="POST"){echo " alert-primary ";}  ?><!-- mx-auto " role="alert">-->

                <div class=" text-center col-12 p-3 mt-5 alert alert-primary mx-auto " role="alert">

                    <?php

                        //$array_obj[] - this array is defined on top
//                        function anonymFunction1($obj)
//                        {
//                            if ($obj->getRunning()) echo $obj->getMessage();
//                    }
//                    array_map("anonymFunction1",$array_obj);

                    array_map(function($obj) {

                        if ($obj->getRunning()) echo $obj->getMessage();

                    },$array_obj);
                    ?>
                </div>


            <h5 class="w-100 mt-5 "><span class="mr-5">Zákazník_A</span><?php   echo gmdate("H:i:s",$zakaznik_a_obj->getTotal())  ;?></h5>
            <h5 class="w-100 mt-1 "><span class="mr-5">Zákazník_B</span><?php   echo gmdate("H:i:s",$zakaznik_b_obj->getTotal())  ;?></h5>
            <h5 class="w-100 mt-1"><span class="mr-5">Pauza</span><span class="ml-5"><?php   echo gmdate("H:i:s",$pauza_obj->getTotal())  ;?></span></h5>

        </div>
            <form  class=" text-center  float-right mt-5 mr-5" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <button type="submit" name="uloz" class="btn btn-info mt-5">
                    <i class="fa fa-fast-backward fa-lg"></i> Uloziť
                </button>
            </form>

        <form  class=" text-center  float-right mt-5 mr-5" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <button type="submit" name="reset" class="btn btn-danger mt-5">
                <i class="fa fa-fast-backward fa-lg"></i> Reset
            </button>
        </form>

        <?php
        /**
        * I don´t know if this work - maybe U can say me :)
        * -> main idea is to close connection to DB after browser is closed by client(and $_SESSIONs are unset by default)(?!)
        */
        if (connection_aborted()){//this maybe not working
// ulouime do cookies if is aborted uvidime či t pojde

            //$array_obj[] - this array is defined on top
            function anonymFunction2($obj)
            {
                if ($obj->getRunning()) {$obj->pausing();}

                /**
                 *  $obj->name_obj (without ´ˇ)
                 *   - example: COOKIE['zakaznik_b_obj']
                 */
                setcookie(strtolower(remove_accents($obj->getNameObj())).'_obj', serialize($obj), time()+86400, '/');
                //  $_SESSION['$obj']=$obj;
            }

            array_map("anonymFunction2",$array_obj);

        }


        ?>

        <!-- Optional JavaScript -->

            <!-- jQuery first, then Popper.js, then Bootstrap JS -->
            <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
            <script src="https:print_r(hrtime());//cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>



        </body>
    </html>
