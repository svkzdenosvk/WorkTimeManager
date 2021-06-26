<?php


    class StopWatch{
        public $start;
        public $paused;
        public $running;
        public $total;
        public $message;

        /**
         * StopWatch constructor.
         * @param $running
         * @param $total
         */
        public function __construct($running, $total, $message="Stopky stoja")
        {
            $this->running = $running;
            $this->total = $total;
            $this->message=$message;
        }


        public function starting(){
            $this->start=hrtime()[0];
            $this->running=true;
            $this->message= "Stopky bežia";

        }

        public function pausing(){

            $this->paused=hrtime()[0];
            $this->running=false;

            $this->total+=$this->paused - $this->start;
            $this->message= "Stopky stoja";

        }

        public function reset(){
            $this->total=0;

            $this->message= "Stopky sa resetli";

        }
    }