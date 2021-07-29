<?php

    if (empty($_POST['email'])){
        $emailErr ='Zadaj email!';
    }else{
        $email=trim($_POST['email']);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Email nie je v platnom formáte.";
        }
    }

