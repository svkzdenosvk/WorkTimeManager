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

        /**
         * @return mixed
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
         * @return mixed
         */
        public function getRunning()
        {
            return $this->running;
        }

        /**
         * @param mixed $running
         */
        public function setRunning($running)
        {
            $this->running = $running;
        }




        public function starting(){
            $this->start=hrtime()[0];
            $this->running=true;
            $this->message= "Stopky pre ".$this->name_obj." bežia";

        }

        public function pausing(){

            $this->paused=hrtime()[0];
            $this->running=false;

            $this->total+=$this->paused - $this->start;
            $this->message= "Stopky pre ".$this->name_obj." stoja";

        }

        public function reset(){
            $this->total=0;

            $this->message= "Stopky pre ".$this->name_obj." resetli";

        }
    }