<?php


    class StopWatch{
        private $name_obj;
        private $start;
        private $paused;
        private $running;
        private $total;
        private $message;

        /**
         * StopWatch constructor.
         * @param $name_obj
         * @param int $total
         * @param bool $running
         * @param string $message
         */
        public function __construct($name_obj, $total=0, $running=false, $message="stojí")
        {
            $this->name_obj= $name_obj;
            $this->total = $total;
            $this->running = $running;
            $this->message="Čas pre ".$name_obj." ".$message;
        }

/******************************************** GETTERS AND SETTERS ******************************************************

        /**
         * @return string
         */
        public function getNameObj()
        {
            return $this->name_obj;
        }

        /**
         * @return number (total seconds of work)
         */
        public function getTotal()
        {
            return $this->total;
        }

        /**
         * @return string
         */
        public function getMessage()
        {
            return $this->message;
        }

        /**
         * @return boolean
         */
        public function getRunning()
        {
            return $this->running;
        }

        /**
         * @param boolean $running
         * @return void
         */
        public function setRunning($running)
        {
            $this->running = $running;
        }

/******************************************** OWN FUNCTIONS ************************************************************

        /**
         * this f. start count seconds for selected thread
         * @return void
         */
        public function starting(){
            $this->start=hrtime()[0];
            $this->running=true;
            $this->message= "Stopky pre ".$this->name_obj." bežia";

        }

        /**
         * this f. stop count seconds for selected thread and sum seconds in property total
         * @return void
         */
        public function pausing(){

            $this->paused=hrtime()[0];
            $this->running=false;

            $this->total+=$this->paused - $this->start;
            $this->message= "Stopky pre ".$this->name_obj." stoja";
        }

        /**
         * this f. stop count seconds for selected thread and set property total (total seconds) to zero
         * @return void
         */
        public function reset(){
            if($this->getRunning()==true){
                $this->pausing();
            }
            $this->total=0;
            $this->message= "Stopky pre ".$this->name_obj." resetli";

        }
    }