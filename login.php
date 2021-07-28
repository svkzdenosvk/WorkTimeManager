
    <?php
    require_once "autoloader.inc.php";
    require_once "inc/inc.setting.php";
    require_once "functions.php";


    /**
     * auto redirect to logged user after check all cookies
     */
    logByAllCookiesStopwatchObj($_COOKIE[ZAK_A]??"",$_COOKIE[ZAK_B]??"",$_COOKIE[PAUZA]??"",$_COOKIE['logged']??"");



        $emailErr = $passErr ="";

        /**
         * if form was submit
         */
        if(isset($_POST['login'])){
            /**
             * validation
             */
            //toto(email validation) sa opakuje aj v registration 6 riadkov -> treba funkciu !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

            if (empty($_POST['email'])){
                $emailErr ='Zadaj email!';
            }else{
                $email=trim($_POST['email']);
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $emailErr = "Email nie je v platnom formáte.";
                }
            }
            if(empty($_POST['pass'])){
                $passErr ='Napíš heslo';
            }else{
                $pass=$_POST['pass'];
            }

            /**
             * if form pass without entry errors
             */
            if( empty($passErr) && empty($emailErr) ){
                //toto sa opakuje aj v registration 7 riadkov -> treba funkciu!!!!!!!!!!!!!!!!!!!!!!!!!!!!
                $stmt = $conn->prepare("SELECT email FROM users  ");
                $stmt->execute();

                // set the resulting array to associative
                $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $data =$stmt->fetchAll();

                if(!$data){
                    $emailErr="Email nie je registrovaný, najskor sa zaregistrujte!hore";
                }else{
                    foreach($data as $key => $value) {
                        $emailVal=trim($value['email']);
                        if (strcasecmp($email,$emailVal) == 0){
//                            $emailErr="Email nie je registrovaný, najskor sa zaregistrujte!dole";
                            $stmt = $conn->prepare("SELECT meno, email, heslo FROM users WHERE email = :email");
                            $stmt->bindParam(':email', $email );
                            $stmt->execute();

                            // set the resulting array to associative
                            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                            $dataLogin =$stmt->fetchAll();

                            /**
                             * check password to email, if correct->set COOKIE and redirect
                             */
                            if(password_verify($pass,$dataLogin[0]['heslo'])){
                                $user=new User($dataLogin[0]['meno'],$dataLogin[0]['email']);
                                $serializeUser=serialize($user);
                                                                                 //expire after cca 5 year
                                setcookie('logged', $serializeUser, time()+ (5 * 365 * 24 * 60 * 60), '/');

//                                /**
//                                 * encrypt to URL serialize array of data
//                                 */
//                                $encrypted_string=openssl_encrypt($serializeUser,"AES-128-ECB",$password);

//                                header("Location: index.php/?path=$encrypted_string");
                               redirect("/");
                                die();
                            }else{
                                $passErr="Heslo pre tento zaregistrovaný email nie je správne! ";
                            }

                        }else{  //this have to be repaired !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
                            $emailErr= "heslo k tomuto emailu nesedí, si vobec zaregistrovaný ?";
                        }

                    }
                 }
            }
        }
    ?>

    <!doctype html>
    <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <meta name="description" content="">
            <meta name="author" content="">

            <title>Login</title>

            <!-- Bootstrap core CSS -->
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

            <!-- Custom styles for this template -->
        </head>

        <body class="text-center">

        <!-- Button trigger modal -->
            <?php
            /**
             * button on modal window ->content of modal window is included below
             */
            ?>
            <button type="button" class="btn btn-outline-warning mt-5 mb-5" data-toggle="modal" data-target="#exampleModalLong">
                Vyskúšaj bez registrácie
            </button>
            <?php include_once "inc/_partial_pages/modal.html"?>
            <form  class="form-signin  w-25 mx-auto  " action="/prihlasenie" method="POST">
                <h1 class="h3 mb-3 font-weight-normal ">Prihlásiť sa alebo <a href="/registracia">Registrovať</a></h1>

                <label for="inputEmail" class="sr-only">Email address</label>
                <input type="email" id="inputEmail" class="form-control mt-4" placeholder="Email" name="email" required autofocus value="<?php echo $email??"";?>">
                <span class="text-danger"> <?php echo $emailErr;?></span>

                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" id="inputPassword" class="form-control mt-4 mb-4" placeholder="Heslo" name="pass" required>
                <span class="text-danger"> <?php echo $passErr;?></span>

                <button class="btn btn-lg btn-primary btn-block" type="submit" name="login">Prihlásiť sa</button>
                <p class="mt-5 mb-3 text-muted">&copy; 2021</p>
            </form>
            <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        </body>
    </html>