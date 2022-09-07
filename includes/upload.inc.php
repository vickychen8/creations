<?php

if (isset($_POST['submit'])){
    session_start();
    require_once 'dbh.inc.php';
   
    $file = $_FILES['img'];
    $fileName = $_FILES['img']['name'];
    $fileTmpName = $_FILES['img']['tmp_name'];
    $fileSize = $_FILES['img']['size'];
    $fileError = $_FILES['img']['error'];
    $fileType = $_FILES['img']['type'];
    
    $fileTitle = $_POST['title'];
    /*
    if (empty($_POST['title'])){
        $fileTitle = "gallery";
    } else {
        $fileTitle = strtolower(str_replace(" ", "-", $fileTitle));
    }
    */
    if($fileError === 0){
        $fileExt = strtolower(end(explode('.', $fileName)));
        $FileTypes = array('jpg', 'jpeg', 'png');
        if(in_array($fileExt, $FileTypes)){
            if($fileSize < 1000000){       
                $fileIdName = uniqid('', true).".".$fileExt;
                $fileDest = '../uploads/'.$fileIdName;

                $sql = "SELECT * FROM gallery;";
                $pstmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($pstmt, $sql)){
                    header("Location: index.php?error=stmtfailed");
                    exit();
                } else{
                    mysqli_stmt_execute($pstmt);
                    $result = mysqli_stmt_get_result($pstmt);
                    $rowCount = mysqli_num_rows($result);
                    $imgSort = $rowCount + 1;
                    $currentUserId =  $_SESSION["userid"];
                    $sql = "INSERT INTO gallery (userid, title, fullname, sort) VALUES (?, ?, ?, ?);";
                    if(!mysqli_stmt_prepare($pstmt, $sql)){
                        header("location: ../index.php?error=stmtfailed");
                        exit();
                    } else {
                        
                        mysqli_stmt_bind_param($pstmt, "ssss", $currentUserId, $fileTitle, $fileIdName, $imgSort);
                        mysqli_stmt_execute($pstmt);
                       
                        move_uploaded_file($fileTmpName, $fileDest);
                        header("location: ../index.php?uploadsuccess");
                        exit();
                    }
                }
            } else {
                header("Location: index.php?error=filetoolarge");
                exit();
            }
        } else{
            header("Location: index.php?error=incorrecttype");
            exit();
        }
    } else {
        header("Location: index.php?error=error");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}