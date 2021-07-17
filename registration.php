
<?php

    //require_once "inc/inc.db.setting.php";

//    $errors=array('name'=>'','title'=>'','password'=>'','re_password'=>'');
//    $nameErr = $emailErr = $passErr = $passConfErr ="";
//    $name = $email = $pass = $passConf = "";

    if(isset($_POST['register'])){

        if (empty($_POST['name'])){
            $nameErr ='Zadaj meno!';
        }else{
            $name = $_POST['name'];

            if(!ctype_alnum($name)){
             $nameErr ='V mene používaj len písmená a číslice.';
            }

            if(strlen($name)<3){ $nameErr ='Meno musí obsahovať minimálne 3 znaky!';}
            if(strlen($name)>30){ $nameErr ='Meno nesmie obsahovať viac ako 30 znakov!';}
        }
        if (empty($_POST['email'])){
            $emailErr ='Zadaj email!';
        }else{
            $email=$_POST['email'];
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Email nie je v platnom formáte.";
            }
        }

        if (isset($_POST['password'])){
            $pass = $_POST['password'];

            if(!preg_match("/(?=.*[A-Za-z])(?=.*\d)[a-zA-Z\d\w\W]/",$pass)){

                $passErr ='Heslo musí obsahovať minimálne jedno písmeno a jednu číslicu';
            }
            if(strlen($pass)<3){ $passErr ='Heslo musí mať minimálne 3 znaky';}
            if(strlen($pass)>150){ $passErr ='Heslo je príliš dlhé.';}

            if (empty($_POST['password_confirm'])){

                $passConfErr ='Zopakuj heslo';
            }else{
                $passConf=$_POST['password_confirm'];

                if (strcmp($pass, $passConf) !== 0){
                    $passConfErr='Heslá sa nezhodujú';
                }
            }

        }

    }else{ echo "nepreslo to"; echo $_SERVER['PHP_SELF'];}
?>


    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

        <title>Signin Template for Bootstrap</title>

        <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/sign-in/">

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" >

        <!-- Custom styles for this template -->
<!--        <link href="signin.css" rel="stylesheet">-->
    </head>

    <body class="text-center ">
        <form style="margin-top: 7%;" class="form-signin w-25 mx-auto " action="registration.php" method="POST">
            <h1 class="h3 mb-3 font-weight-normal">Registrácia</h1>
            <label for="inputPassword" class="sr-only ">Meno</label>
            <input name="name" type="text" id="inputPassword" minlength="3" maxlength="30"class="form-control mt-4" placeholder="Meno" required value="<?php echo $name??"";?>" >
            <span class="text-danger"> <?php echo $nameErr??"";?></span>

            <label for="inputEmail" class="sr-only">Email address</label>
            <input name="email" type="email" id="inputEmail" class="form-control mt-4" placeholder="Email" required value="<?php echo $email??"";?>">
            <span class="text-danger"> <?php echo $emailErr??"";?></span>

            <label for="inputPassword" class="sr-only ">Password</label>
            <input name="password" type="password" id="inputPassword" class="form-control mt-4" placeholder="Heslo" required value="<?php echo $pass??"";?>">
            <span class="text-danger"> <?php echo $passErr??"";?></span>

            <label for="RePassword" class="sr-only">Password</label>
            <input name="password_confirm" type="password" id="RePassword" class="form-control mt-4 mb-2" placeholder="Potvrď heslo" required value="<?php echo $passConf??"";?>">
            <span class="text-danger"> <?php echo $passConfErr??"";?></span>

<!--            <div class="checkbox mb-3">-->
<!--                <label>-->
<!--                    <input type="checkbox" value="remember-me"> Remember me-->
<!--                </label>-->
<!--            </div>-->
            <button class="btn btn-lg btn-primary btn-block" type="submit"  name="register"  >Registrácia</button>
            <p class="mt-5 mb-3 text-muted">&copy; 2021</p>
        </form>

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
    </html>
