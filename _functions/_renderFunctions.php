<?php
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
     * this f. show buttons (2 greens and 1 yellow)
     * @param array (of objects)
     * @return void (just echo "view")
     */
    function renderThreadButtons(array $array_obj){

      require "inc/_partial_pages/btns.html";
          
    }

    /*******************************************************************************************************************
     * this f. is partial f. (for render save button and reset button)
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
                  <i class="fa fa-archive fa-lg"></i> Ulo??i??
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

     /*******************************************************************************************************************
     * this f. is partial f. (for render last month button and current month button)
     * @param string
     * @return void (just echo "view")
     */
    function _renderMonthBtn(string $string1, string $string2){

        echo <<<END
             <form  class=" text-left " action="/" method="post">
                <button type="submit" name="{$string1}" class="btn btn-primary mt-3">
                    <i class="fa fa-bar-chart fa-lg"></i>{$string2}
                </button>
             </form> 
             END;

    }

    /********************************************************************************************************************
     * this f. render last month button
     */
    function renderLastMonthBtn(){
        $string1 ="last-month";
        $string2="Minul?? mesiac";
        _renderMonthBtn($string1, $string2);
    }

    /********************************************************************************************************************
     * this f. render current month button
     */
    function renderCurrentMonthBtn(){
        $string1 ="actual-month";
        $string2="Aktu??lny mesiac";
        _renderMonthBtn($string1, $string2);
    }