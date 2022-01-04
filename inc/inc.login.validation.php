<?php

/**
  * if login form was submit->validation
  */
if(isset($_POST['login'])){

    /**
     * email validation
     */
  require_once "inc/_duplicated_code/emailValidation.php";

    /**
     * password validation
     */
    if(empty($_POST['pass'])){
        $passErr ='Napíš heslo';
    }else{
        $pass=$_POST['pass'];
    }

    /**
     * if form pass without entry errors
     */
    if( empty($passErr) && empty($emailErr) ){

        /**
         * select registered emails from table users for next checking
         */
        $data=selectEmailsFromDB($conn);

        /**
         * if $data are empty ->table of registered emails is empty
         */
        if(!$data){
            $emailErr="Email nie je registrovaný, najskor sa zaregistrujte!";
        }else{
            foreach($data as $key => $value) {
                $emailVal=trim($value['email']);
                /**
                 * if email from table users and that written in input are equal ->then select all data by this email from table users
                 */
                if (strcasecmp($email,$emailVal) == 0){
                    $stmt = $conn->prepare("SELECT meno, email, heslo FROM users WHERE email = :email");
                    $stmt->bindParam(':email', $email );
                    $stmt->execute();

                    // set the resulting array to associative
                    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                    $dataLogin =$stmt->fetchAll();

                    /**
                     * check password towards email, if correct->set COOKIE['logged'] and redirect with logged user
                     */
                    if(password_verify($pass,$dataLogin[0]['heslo'])){
                        $user=new User($dataLogin[0]['meno'],$dataLogin[0]['email']);
                        $serializeUser=serialize($user);
                                                                         //expire after cca 5 year
                        setcookie('logged', $serializeUser, time()+ (5 * 365 * 24 * 60 * 60), '/');

                        redirect("/");
                        die();
                    }else{
                        $passErr="Heslo pre tento zaregistrovaný email nie je správne! ";
                        $emailErr="";
                        break;
                    }

                }else{
                    $emailErr= "Tento email nie je registrovaný, skontrolujte či je napísaný správne alebo ho zaregistrujte! ";

                }

            }
         }
    }
}