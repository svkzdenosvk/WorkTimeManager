<?php


    class User{
        private $name;
        private $email;

        public function __construct($name, $email){
            $this->name= $name;
            $this->email = $email;
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