
<?php

    require_once "inc/inc.setting.php";
    require_once "functions.php";

    /**
     * auto redirect to logged user after check all cookies
     */
    logByAllCookiesStopwatchObj($_COOKIE[CUST_A]??"",$_COOKIE[CUST_B]??"",$_COOKIE[PAUSE]??"",$_COOKIE['logged']??"");

    $nameErr = $emailErr = $passErr = $passConfErr ="";

    /**
     * if form register was submit -> validation
     */
   
    require_once("inc/inc.reg.validation.php")?>
?>

    <?php
    /**
     * include header
     */
    include_once ("inc/_partial_pages/header.html")?>

        <meta name="description" content="registration form">
        <meta name="author" content="Zdeno">

        <title>Registration</title>

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" >

    </head>

    <body class="text-center ">
        <form style="margin-top: 7%;" class="form-signin w-25 mx-auto " action="<?php echo "/registracia" ?>" method="POST">
            <h1 class="h3 mb-3 font-weight-normal">Registrovať sa alebo sa <a href="login.php">Prihlásiť</a></h1>
            <label for="inputPassword" class="sr-only ">Meno</label>
            <input name="name" type="text" id="inputPassword" minlength="3" maxlength="30"class="form-control mt-4" placeholder="Meno" required value="<?php echo $name??"";?>" >
            <span class="text-danger"> <?php echo $nameErr;?></span>

            <label for="inputEmail" class="sr-only">Email address</label>
            <input name="email" type="email" id="inputEmail" minlength="3" class="form-control mt-4" placeholder="Email" required value="<?php echo $email??"";?>">
            <span class="text-danger"> <?php echo $emailErr;?></span>

            <label for="inputPassword" class="sr-only ">Password</label>
            <input name="password" type="password" id="inputPassword" class="form-control mt-4" placeholder="Heslo" required value="<?php echo $pass??"";?>">
            <span class="text-danger"> <?php echo $passErr;?></span>

            <label for="RePassword" class="sr-only">Password</label>
            <input name="password_confirm" type="password" id="RePassword" class="form-control mt-4 mb-3" placeholder="Potvrď heslo" required value="<?php echo $passConf??"";?>">
            <span class="text-danger"> <?php echo $passConfErr;?></span>

            <button class="btn btn-lg btn-primary btn-block" type="submit"  name="register" >Registrácia</button>
            <p class="mt-5 mb-3 text-muted">&copy; 2021</p>
        </form>

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
    </html>
