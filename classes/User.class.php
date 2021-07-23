<?php


    class User{
        private $name;
        private $email;
//        private $loged;
//
//        /**
//         * @return mixed
//         */
//        public function getLoged()
//        {
//            return $this->loged;
//        }
//
//        /**
//         * @param mixed $loged
//         */
//        public function setLoged($loged)
//        {
//            $this->loged = $loged;
//        }

        public function __construct($name, $email/*,$loged*/){
            $this->name= $name;
            $this->email = $email;
           // $this->loged = $loged;

        }

        /**
         * @return string
         */
        public function getName()
        {
            return $this->name;
        }

        /**
         * @return string
         */
        public function getEmail()
        {
            return $this->email;
        }


    }