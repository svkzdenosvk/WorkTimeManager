<?php


    class StopWatch{
        public $start;
        public $paused;
        public $running;
        public $total;

        /**
         * StopWatch constructor.
         * @param $running
         * @param $total
         */
        public function __construct($running, $total)
        {
            $this->running = $running;
            $this->total = $total;
        }


        public function starting(){
            $this->start=hrtime()[0];
            $this->running=true;
            echo ("Stopky bežia");
            echo $this->total;
        }

        public function pausing(){

            $this->paused=hrtime()[0];
            $this->running=false;

            $this->total+=$this->paused - $this->start;
            echo ("Stopky stoja");
            echo $this->total;

        }

        public function reset(){
            $this->total=0;
            echo $this->total;

            echo ("Stopky sa resetli");

        }
    }