<?php

if (isset($_POST['delete'])){
    session_start();
    require_once 'dbh.inc.php';

    $id = $_POST['deleteFile'];
    $dir = "uploads";
    $filePath = $_POST['filePath'];
    print $filePath;
    
    $sql = "DELETE FROM gallery WHERE id=$id";
    $result = mysqli_query($conn,$sql);
    if($result){
        echo "Yes";
    }else{
        die(mysqli_error($conn));
    }
    unlink('../'.$dir.'/'.$filePath);
    header("location: ../index.php");
} else {
    header("location: ../index.php?error=post");
    exit();
}
