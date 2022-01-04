<?php
if(isset($_POST['register'])){

    /**
     * name validation
     */
    if (empty($_POST['name'])){
        $nameErr ='Zadaj meno!';
    }else{
        $name = trim($_POST['name']);

        if(!ctype_alnum($name)){
        $nameErr ='V mene používaj len písmená a číslice.';
        }

        if(strlen($name)<3){ $nameErr ='Meno musí obsahovať minimálne 3 znaky!';}
        if(strlen($name)>30){ $nameErr ='Meno nesmie obsahovať viac ako 30 znakov!';}
    }
    /**
     * email validation
     */
    require_once "inc/_duplicated_code/emailValidation.php";

    /**
     * password validation
     */
    if (isset($_POST['password'])){
        $pass = $_POST['password'];

        if(!preg_match("/(?=.*[A-Za-z])(?=.*\d)[a-zA-Z\d\w\W]/",$pass)){

            $passErr ='Heslo musí obsahovať minimálne jedno písmeno a jednu číslicu';
        }
        if(strlen($pass)<3){ $passErr ='Heslo musí mať minimálne 3 znaky';}
        if(strlen($pass)>150){ $passErr ='Heslo je príliš dlhé.';}

        /**
         * password_confirm validation
         */
        if(empty($_POST['password_confirm'])){
            $passConfErr ='Zopakuj heslo';
        }else{
            $passConf=$_POST['password_confirm'];

            if (strcmp($pass, $passConf) !== 0){
                $passConfErr='Heslá sa nezhodujú';
            }
        }
    }

    /**
    * if form pass without error -> then control email against emails in table and if pass -> save user to DB
    */
    if( empty($nameErr) && empty($emailErr) && empty($passErr) && empty($passConfErr) ){

        /**
         * select registered emails from table users for next checking if already registered
         */
        $data=selectEmailsFromDB($conn);

        /**
         * if db is NOT empty
         */
        if($data){
            foreach($data as $key => $value) {
                $emailVal=trim($value['email']);
                if (strcasecmp($email,$emailVal) == 0){
                    $emailErr="Email je už zaregistrovaný";
                }
            }
            if(empty($emailErr)){

                /**
                 * save user to DB
                 */
                save($conn,$name,$email,$pass);
            }

        /**
         * if db IS empty -> immediately save
         */
        }else {
            /**
             * save user to DB
             */
            save($conn,$name,$email,$pass);
        }
    }
}