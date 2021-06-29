<?php
    require_once "autoloader.inc.php";

    session_start();

    $stopWatch_obj=isset($_SESSION['stopWatch_object'])?$_SESSION['stopWatch_object']:new StopWatch(false,0);



    /**
     * if button start was clicked ..stopwatch is running
     */
    if(isset($_POST['start'])&&$stopWatch_obj->getRunning()==false){
        $stopWatch_obj->starting();

        $_SESSION['stopWatch_object']=$stopWatch_obj;
    }


    /**
     * if button pause was clicked ..stopwatch is stop
     */
    if(isset($_POST['pause'])&&($stopWatch_obj->getRunning())){

       $stopWatch_obj->pausing();
       $_SESSION['stopWatch_object']=$stopWatch_obj;
    }


    /**
     * if button reset was clicked ..stopwatch reset second to zero
     */
    if(isset($_POST['reset'])&&(!$stopWatch_obj->getRunning())){

        $stopWatch_obj->reset();
        $_SESSION['stopWatch_object']=$stopWatch_obj;
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
                    <button type="submit" name="start" class="btn btn-success mt-5 ">
                        <i class="fa fa-play fa-lg"></i> Zákazník_A
                    </button>
                </form>

                <form  class="col-4 text-center" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <button type="submit" name="pause" class="btn btn-success mt-5 ">
                        <i class="fa fa-play fa-lg"></i> Zákazník_B
                    </button>
                </form>
            </div>

            <form  class="col-4 text-center ml-5 mr-5" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <button type="submit" name="pause" class="btn btn-warning mt-5 ">
                    <i class="fa fa-pause fa-lg"></i> Pauza
                </button>
            </form>
            <h5 class="w-100 text-center mt-5"> <?php echo  $stopWatch_obj->getMessage() ;?></h5>

            <h5 class="w-100 mt-5 "><span class="mr-5">Zákazník_A</span><?php   echo gmdate("H:i:s",$stopWatch_obj->getTotal())  ;?></h5>
            <h5 class="w-100 mt-1 "><span class="mr-5">Zákazník_B</span><?php   echo gmdate("H:i:s",$stopWatch_obj->getTotal())  ;?></h5>
            <h5 class="w-100 mt-1"><span class="mr-5">Pauza</span><span class="ml-5"><?php   echo gmdate("H:i:s",$stopWatch_obj->getTotal())  ;?></span></h5>

        </div>
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
