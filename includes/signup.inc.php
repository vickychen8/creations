<?php

if(isset($_POST["submit"])){
    $name = $_POST["name"];
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdrepeat"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if (emptySignupInput($name, $username, $pwd, $pwdRepeat) !== false){
        header("location: ../signup.php?error=emptyinput");
        exit();
    }
    if (usernameExists($conn, $username) !== false){
        header("location: ../signup.php?error=usernameexists");
        exit();
    }
    if (pwdsNotMatch($pwd, $pwdRepeat) !== false){
        header("location: ../signup.php?error=passwordsdontmatch");
        exit();
    }
    createUser($conn, $name, $username, $pwd);
} else {
    header("location: ../signup.php");
}