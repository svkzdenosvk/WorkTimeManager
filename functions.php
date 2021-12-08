<?php
    /*******************************************************************************************************************
    /************************************************COMMON FUNCTIONS***************************************************
    /*******************************************************************************************************************/

    /*******************************************************************************************************************
     * f. is copied from stackoverflow
     * this f. makes from number of seconds -> 00:00:00 (Hours:Minutes:Second)
     * @param number $seconds
     * @return string
     */
    function timeFormat ($seconds){
        $hours = floor($seconds / 3600);
        $mins = floor($seconds / 60 % 60);
        $secs = floor($seconds % 60);

        return sprintf('%02d:%02d:%02d', $hours, $mins, $secs);
    }


    /*******************************************************************************************************************
     * this f. is just formating StopWatch object property name to lowercase without diacritics using f. remove_accents()
     * @param StopWatch object
     * @return string
     */
    function objPropertyName_to_varString(StopWatch $stopwatch_obj){

        $someString=remove_accents($stopwatch_obj->getNameObj());

        //just english version for coding 
        $someString=str_replace("Zakaznik","Customer",$someString);
        $someString=str_replace("Pauza","Pause",$someString);
        

        return strtolower($someString);
    }

  

    /*******************************************************************************************************************
     * f. is copied from stackoverflow
     * this f. remove diacritics -> from "á"->"a"...
     * @param string $string
     * @return string $string
     */
    function remove_accents($string) {
        if ( !preg_match('/[\x80-\xff]/', $string) )
            return $string;

        $chars = array(
            // Decompositions for Latin-1 Supplement
            chr(195).chr(128) => 'A', chr(195).chr(129) => 'A',
            chr(195).chr(130) => 'A', chr(195).chr(131) => 'A',
            chr(195).chr(132) => 'A', chr(195).chr(133) => 'A',
            chr(195).chr(135) => 'C', chr(195).chr(136) => 'E',
            chr(195).chr(137) => 'E', chr(195).chr(138) => 'E',
            chr(195).chr(139) => 'E', chr(195).chr(140) => 'I',
            chr(195).chr(141) => 'I', chr(195).chr(142) => 'I',
            chr(195).chr(143) => 'I', chr(195).chr(145) => 'N',
            chr(195).chr(146) => 'O', chr(195).chr(147) => 'O',
            chr(195).chr(148) => 'O', chr(195).chr(149) => 'O',
            chr(195).chr(150) => 'O', chr(195).chr(153) => 'U',
            chr(195).chr(154) => 'U', chr(195).chr(155) => 'U',
            chr(195).chr(156) => 'U', chr(195).chr(157) => 'Y',
            chr(195).chr(159) => 's', chr(195).chr(160) => 'a',
            chr(195).chr(161) => 'a', chr(195).chr(162) => 'a',
            chr(195).chr(163) => 'a', chr(195).chr(164) => 'a',
            chr(195).chr(165) => 'a', chr(195).chr(167) => 'c',
            chr(195).chr(168) => 'e', chr(195).chr(169) => 'e',
            chr(195).chr(170) => 'e', chr(195).chr(171) => 'e',
            chr(195).chr(172) => 'i', chr(195).chr(173) => 'i',
            chr(195).chr(174) => 'i', chr(195).chr(175) => 'i',
            chr(195).chr(177) => 'n', chr(195).chr(178) => 'o',
            chr(195).chr(179) => 'o', chr(195).chr(180) => 'o',
            chr(195).chr(181) => 'o', chr(195).chr(182) => 'o',
            chr(195).chr(182) => 'o', chr(195).chr(185) => 'u',
            chr(195).chr(186) => 'u', chr(195).chr(187) => 'u',
            chr(195).chr(188) => 'u', chr(195).chr(189) => 'y',
            chr(195).chr(191) => 'y',
            // Decompositions for Latin Extended-A
            chr(196).chr(128) => 'A', chr(196).chr(129) => 'a',
            chr(196).chr(130) => 'A', chr(196).chr(131) => 'a',
            chr(196).chr(132) => 'A', chr(196).chr(133) => 'a',
            chr(196).chr(134) => 'C', chr(196).chr(135) => 'c',
            chr(196).chr(136) => 'C', chr(196).chr(137) => 'c',
            chr(196).chr(138) => 'C', chr(196).chr(139) => 'c',
            chr(196).chr(140) => 'C', chr(196).chr(141) => 'c',
            chr(196).chr(142) => 'D', chr(196).chr(143) => 'd',
            chr(196).chr(144) => 'D', chr(196).chr(145) => 'd',
            chr(196).chr(146) => 'E', chr(196).chr(147) => 'e',
            chr(196).chr(148) => 'E', chr(196).chr(149) => 'e',
            chr(196).chr(150) => 'E', chr(196).chr(151) => 'e',
            chr(196).chr(152) => 'E', chr(196).chr(153) => 'e',
            chr(196).chr(154) => 'E', chr(196).chr(155) => 'e',
            chr(196).chr(156) => 'G', chr(196).chr(157) => 'g',
            chr(196).chr(158) => 'G', chr(196).chr(159) => 'g',
            chr(196).chr(160) => 'G', chr(196).chr(161) => 'g',
            chr(196).chr(162) => 'G', chr(196).chr(163) => 'g',
            chr(196).chr(164) => 'H', chr(196).chr(165) => 'h',
            chr(196).chr(166) => 'H', chr(196).chr(167) => 'h',
            chr(196).chr(168) => 'I', chr(196).chr(169) => 'i',
            chr(196).chr(170) => 'I', chr(196).chr(171) => 'i',
            chr(196).chr(172) => 'I', chr(196).chr(173) => 'i',
            chr(196).chr(174) => 'I', chr(196).chr(175) => 'i',
            chr(196).chr(176) => 'I', chr(196).chr(177) => 'i',
            chr(196).chr(178) => 'IJ',chr(196).chr(179) => 'ij',
            chr(196).chr(180) => 'J', chr(196).chr(181) => 'j',
            chr(196).chr(182) => 'K', chr(196).chr(183) => 'k',
            chr(196).chr(184) => 'k', chr(196).chr(185) => 'L',
            chr(196).chr(186) => 'l', chr(196).chr(187) => 'L',
            chr(196).chr(188) => 'l', chr(196).chr(189) => 'L',
            chr(196).chr(190) => 'l', chr(196).chr(191) => 'L',
            chr(197).chr(128) => 'l', chr(197).chr(129) => 'L',
            chr(197).chr(130) => 'l', chr(197).chr(131) => 'N',
            chr(197).chr(132) => 'n', chr(197).chr(133) => 'N',
            chr(197).chr(134) => 'n', chr(197).chr(135) => 'N',
            chr(197).chr(136) => 'n', chr(197).chr(137) => 'N',
            chr(197).chr(138) => 'n', chr(197).chr(139) => 'N',
            chr(197).chr(140) => 'O', chr(197).chr(141) => 'o',
            chr(197).chr(142) => 'O', chr(197).chr(143) => 'o',
            chr(197).chr(144) => 'O', chr(197).chr(145) => 'o',
            chr(197).chr(146) => 'OE',chr(197).chr(147) => 'oe',
            chr(197).chr(148) => 'R',chr(197).chr(149) => 'r',
            chr(197).chr(150) => 'R',chr(197).chr(151) => 'r',
            chr(197).chr(152) => 'R',chr(197).chr(153) => 'r',
            chr(197).chr(154) => 'S',chr(197).chr(155) => 's',
            chr(197).chr(156) => 'S',chr(197).chr(157) => 's',
            chr(197).chr(158) => 'S',chr(197).chr(159) => 's',
            chr(197).chr(160) => 'S', chr(197).chr(161) => 's',
            chr(197).chr(162) => 'T', chr(197).chr(163) => 't',
            chr(197).chr(164) => 'T', chr(197).chr(165) => 't',
            chr(197).chr(166) => 'T', chr(197).chr(167) => 't',
            chr(197).chr(168) => 'U', chr(197).chr(169) => 'u',
            chr(197).chr(170) => 'U', chr(197).chr(171) => 'u',
            chr(197).chr(172) => 'U', chr(197).chr(173) => 'u',
            chr(197).chr(174) => 'U', chr(197).chr(175) => 'u',
            chr(197).chr(176) => 'U', chr(197).chr(177) => 'u',
            chr(197).chr(178) => 'U', chr(197).chr(179) => 'u',
            chr(197).chr(180) => 'W', chr(197).chr(181) => 'w',
            chr(197).chr(182) => 'Y', chr(197).chr(183) => 'y',
            chr(197).chr(184) => 'Y', chr(197).chr(185) => 'Z',
            chr(197).chr(186) => 'z', chr(197).chr(187) => 'Z',
            chr(197).chr(188) => 'z', chr(197).chr(189) => 'Z',
            chr(197).chr(190) => 'z', chr(197).chr(191) => 's'
        );

        $string = strtr($string, $chars);

        return $string;
    }
    

    
/***********************************************************************************************************************
/************************************************RENDER FUNCTIONS*******************************************************
/**********************************************************************************************************************/

    /*******************************************************************************************************************
     * this f. show message about which thread is running (customer_A|customer_B|pause)
     * @param array (of objects)
     * @return void (just echo)
     */
    function renderRunningThread(array $array_obj){
        
        array_map(function($obj) {

            if ($obj->getRunning()) echo $obj->getMessage();

        },$array_obj);
    }


    /*******************************************************************************************************************
     * this f. show statistic  in current day 
     * @param array (of objects)
     * @return void (just echo)
     */
    /*if not working corretly -> in index:
          <?php foreach($array_obj as $obj):?>
              <div class="row"><h5 class="col-6 col-sm-3"><span class="mr-5 "><?php   echo $obj->getNameObj() ;?> </span></h5><h5 class="col-6 col-sm-3"><?php   echo gmdate("H:i:s",$obj->getTotal()) ;?></h5></div>
          <?php endforeach;  ?> -->
        */
    function renderDayStatistics(array $array_obj){

         foreach($array_obj as $obj){
             
            echo '<div class="row"><h5 class="col-6 col-sm-3"><span class="mr-5 ">'. $obj->getNameObj() .' </span></h5><h5 class="col-6 col-sm-3">'.  gmdate("H:i:s",$obj->getTotal()).' </h5></div>';
         }
        
    } 

    /*******************************************************************************************************************
     * this f. show buttons 
     * @param array (of objects)
     * @return void (just echo "view")
     */
    function renderThreadButtons(array $array_obj){

      require "inc/_partial_pages/btns.html";
          
    }

    /*******************************************************************************************************************
     * this f. is partial f. 
     * @param string
     * @return void (just echo "view")
     */
    function _renderControlBtn(string $element){

        echo <<<END
            <form style="margin-top:-5%;"  class=" text-center  float-right  mr-5" action="/" method="post">
               {$element}
            </form> 
            END;

    }

    /*******************************************************************************************************************
     * this f. render control btn Save
     * @return void (just echo "view")
     */
    function renderControlBtnSave(){

        $el ='<button type="submit" name="save" class="btn btn-info mt-5">
                  <i class="fa fa-archive fa-lg"></i> Uložiť
              </button>';

        _renderControlBtn($el);
    }

    /*******************************************************************************************************************
     * this f. render control btn Reset
     * @return void (just echo "view")
     */
    function renderControlBtnReset(){

        $el ='<button type="submit" name="reset" class="btn btn-danger mt-5">
                  <i class="fa fa-refresh fa-lg"></i> Reset
              </button>';

        _renderControlBtn($el);
    }

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