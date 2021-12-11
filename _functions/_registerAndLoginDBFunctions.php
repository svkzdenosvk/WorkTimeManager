<?php
/***********************************************************************************************************************
/****************************************REGISTRATION, LOGIN, DB FUNCTIONS**********************************************
/**********************************************************************************************************************/

    /*******************************************************************************************************************
     * this f. save user from registration form to DB
     * @param PDO $conn
     * @param $name
     * @param $email
     * @param $pass
     * @return void
     */
    function save(PDO $conn, $name, $email, $pass){
        $password = password_hash($pass,PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO users (meno, email, heslo)  VALUES(:meno, :email, :password)");
        $stmt->bindParam(':meno', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);

        $stmt->execute();

        redirect("prihlasenie");
        die();
    }

    /*******************************************************************************************************************
     * this f. is copied from stackoverflow
     * this f. unset all cookies
     * @return void
     */
    function unsetCookies(){

        if (isset($_SERVER['HTTP_COOKIE'])) {
            $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
            foreach($cookies as $cookie) {
                $parts = explode('=', $cookie);
                $name = trim($parts[0]);
                setcookie($name, '', time()-1000);
                setcookie($name, '', time()-1000, '/');
            }
        }
    }


    /*******************************************************************************************************************
     * f. automaticly redirect to index when find out COOKIE of Stopwatch object exists
     * @param (StopWatch) $cookie_obj
     */
    function logByCookieStopwatchObj( $cookie_obj){
        if(!empty($cookie_obj)){
            redirect("/");
            die();

        };
    }


    /*******************************************************************************************************************
     * f. automaticly redirect to index when find out COOKIE of User object exists
     * @param (User) $cookie_obj
     */
    function logByCookieUser( $cookie_obj){
        if(!empty($cookie_obj)){
            redirect("/");
            die();
        };
    }


    /*******************************************************************************************************************
     * f. automaticly redirect to index when find only one COOKIE and check ALL COOKIES
     * @param (StopWatch) $cookie_a
     * @param (StopWatch) $cookie_b
     * @param (StopWatch) $cookie_pauza
     * @param (User) $cookie_user
     */
    function logByAllCookiesStopwatchObj( $cookie_a, $cookie_b, $cookie_pauza, $cookie_user){
        if(!empty($cookie_a))logByCookieStopwatchObj($cookie_a);
        if(!empty($cookie_b))logByCookieStopwatchObj($cookie_b);
        if(!empty($cookie_pauza))logByCookieStopwatchObj($cookie_pauza);
        if(!empty($cookie_user))logByCookieUser($cookie_user);

    }


    /*******************************************************************************************************************
     * f. redirect to path in parameter
     * @param string $path_red
     */
    function redirect ($path_red){
        header("Location: $path_red");
    }


    /*******************************************************************************************************************
     * f. select data from DB by MONTH
     * ->this f. was created because of duplicated code in $_POST['actual_month'] and $_POST['last_month']
     * @param PDO $conn
     * @param string $month
     * @param string $userEmail
     * @return (associative) array $data
     */
    function selectWhereMonthFromDB(PDO $conn, $month, $userEmail){
        $stmt = $conn->prepare("SELECT SUM(zakaznik_a), SUM(zakaznik_b) FROM day_work WHERE MONTH(datum) = :month AND user = :user");
        $stmt->bindParam(':month', $month );
        $stmt->bindParam(':user', $userEmail );

        $stmt->execute();

        // set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $data =$stmt->fetchAll();
        return $data;
    }

    /*******************************************************************************************************************
     * f. select data from DB by MONTH
     * ->this f. was created because of duplicated code in $_POST['actual_month'] and $_POST['last_month']
     * @param PDO $conn
     * @return (associative) array $data
     */
    function selectEmailsFromDB($conn){
        $stmt = $conn->prepare("SELECT email FROM users  ");
        $stmt->execute();

        // set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $data =$stmt->fetchAll();
        return $data;
    }

    /*******************************************************************************************************************
     * logout function
     */

     function logOut(){
          /**
         * destroy all COOKIES and redirect to login.php
         */
        session_destroy();
        unsetCookies();
        redirect("prihlasenie");
     }