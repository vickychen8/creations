<?php

if(isset($_POST["submit"])){
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if (emptySigninInput($username, $pwd) !== false){
        header("location: ../signin.php?error=emptyinput");
        exit();
    }
    login($conn, $username, $pwd);
} else {
    header("location: ../login.php");
    exit();
}