
    <?php
    require_once "autoloader.inc.php";
    require_once "inc/inc.setting.php";
    require_once "functions.php";


    /**
     * auto redirect to logged user after check all cookies
     */
    logByAllCookiesStopwatchObj($_COOKIE[CUST_A]??"",$_COOKIE[CUST_B]??"",$_COOKIE[PAUSE]??"",$_COOKIE['logged']??"");

        $emailErr = $passErr ="";

        /**
         * if login form was submit->validation
         */
        require_once("inc/inc.login.validation.php")
        // if(isset($_POST['login'])){

        //     /**
        //      * email validation
        //      */
        //   require_once "inc/_duplicated_code/emailValidation.php";

        //     /**
        //      * password validation
        //      */
        //     if(empty($_POST['pass'])){
        //         $passErr ='Napíš heslo';
        //     }else{
        //         $pass=$_POST['pass'];
        //     }

        //     /**
        //      * if form pass without entry errors
        //      */
        //     if( empty($passErr) && empty($emailErr) ){

        //         /**
        //          * select registered emails from table users for next checking
        //          */
        //         $data=selectEmailsFromDB($conn);

        //         /**
        //          * if $data are empty ->table of registered emails is empty
        //          */
        //         if(!$data){
        //             $emailErr="Email nie je registrovaný, najskor sa zaregistrujte!";
        //         }else{
        //             foreach($data as $key => $value) {
        //                 $emailVal=trim($value['email']);
        //                 /**
        //                  * if email from table users and that written in input are equal ->then select all data by this email from table users
        //                  */
        //                 if (strcasecmp($email,$emailVal) == 0){
        //                     $stmt = $conn->prepare("SELECT meno, email, heslo FROM users WHERE email = :email");
        //                     $stmt->bindParam(':email', $email );
        //                     $stmt->execute();

        //                     // set the resulting array to associative
        //                     $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        //                     $dataLogin =$stmt->fetchAll();

        //                     /**
        //                      * check password towards email, if correct->set COOKIE['logged'] and redirect with logged user
        //                      */
        //                     if(password_verify($pass,$dataLogin[0]['heslo'])){
        //                         $user=new User($dataLogin[0]['meno'],$dataLogin[0]['email']);
        //                         $serializeUser=serialize($user);
        //                                                                          //expire after cca 5 year
        //                         setcookie('logged', $serializeUser, time()+ (5 * 365 * 24 * 60 * 60), '/');

        //                         redirect("/");
        //                         die();
        //                     }else{
        //                         $passErr="Heslo pre tento zaregistrovaný email nie je správne! ";
        //                         $emailErr="";
        //                         break;
        //                     }

        //                 }else{
        //                     $emailErr= "Tento email nie je registrovaný, skontrolujte či je napísaný správne alebo ho zaregistrujte! ";

        //                 }

        //             }
        //          }
        //     }
        // }
       
    ?>

    <?php
    /**
     * include header
     */
    include_once ("inc/_partial_pages/header.html")?>

            <meta name="description" content="login form">
            <meta name="author" content="Zdeno">

            <title>Login</title>

            <!-- Bootstrap core CSS -->
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        </head>

        <body class="text-center">

            <?php
            /**
             * Button trigger modal ->content of modal window is included below
             */
            ?>
            <button type="button" class="btn btn-outline-warning mt-5 mb-5" data-toggle="modal" data-target="#exampleModalLong">
                Vyskúšaj bez registrácie
            </button>
            <?php include_once "inc/_partial_pages/modal.html"?>
            <form  class="form-signin  w-25 mx-auto  " action="/prihlasenie" method="POST">
                <h1 class="h3 mb-3 font-weight-normal ">Prihlásiť sa alebo <a href="/registracia">Registrovať</a></h1>

                <label for="inputEmail" class="sr-only">Email address</label>
                <input type="email" id="inputEmail" class="form-control mt-4 mb-3" placeholder="Email" name="email" required autofocus value="<?php echo $email??"";?>">
                <span class="text-danger"> <?php echo $emailErr;?></span>

                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" id="inputPassword" class="form-control mt-4 mb-3 " placeholder="Heslo" name="pass" required>
                <span class="text-danger "> <?php echo $passErr;?></span>

                <button class="btn btn-lg btn-primary btn-block mt-4" type="submit" name="login">Prihlásiť sa</button>
                <p class="mt-5 mb-3 text-muted">&copy; 2021</p>
            </form>
            <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        </body>
    </html>