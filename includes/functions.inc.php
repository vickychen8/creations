<?php

function createUser($conn, $name, $username, $pwd){
    $sql = "INSERT INTO users (usersName, usersUid, usersPwd) VALUES (?,?,?);";
    $pstmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($pstmt, $sql)){
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($pstmt, "sss", $name, $username, $hashedPwd);
    mysqli_stmt_execute($pstmt);
    mysqli_stmt_close($pstmt);

    header("location: ../signin.php?error=none");
    exit();

}

function usernameExists($conn, $username){
    $sql = "SELECT * FROM users WHERE usersUid = ?;";
    $pstmt = mysqli_stmt_init($conn); 
    if(!mysqli_stmt_prepare($pstmt, $sql)){
        header("location: ../signup.php?error=pstmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($pstmt, "s", $username);
    mysqli_stmt_execute($pstmt);

    $resultData = mysqli_stmt_get_result($pstmt);

    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    } else{
        return false;
    }

    mysqli_stmt_close($pstmt);
}

function login($conn, $username, $pwd){
    $usernameExists = usernameExists($conn, $username);
    if($usernameExists === false){
        header("location: ../signin.php?error=incorrect");
        exit();
    }
    $hashedPwd = $usernameExists["usersPwd"];
    $checkPwd = password_verify($pwd, $hashedPwd);
    if($checkPwd === false){
        header("location: ../signin.php?error=incorrect");
    } else if ($checkPwd === true){
        session_start();
        $_SESSION["userid"] = $usernameExists["usersId"];
        $_SESSION["useruid"] = $usernameExists["usersUid"];
        header("location: ../index.php");
        exit();
    }
}

function emptySigninInput($username, $pwd){
    return (empty($username) || empty($pwd));
}

function emptySignupInput($name, $username, $pwd, $pwdRepeat){
    return (empty($name) || empty($username) || empty($pwd) || empty($pwdRepeat));
}
 
function pwdsNotMatch($pwd, $pwdRepeat){
    return ($pwd !== $pwdRepeat);
}