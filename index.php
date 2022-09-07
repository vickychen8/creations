<?php
session_start();
if(!isset($_SESSION['useruid'])){
    header("location: signin.php");
    die("Please login");
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creations</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <nav>
        <div class="nav-main">
            <div class="nav-main-logo">
                <a href="index.php">CREATIONS</a>
            </div>
            <ul>
                <li>
                    
                    <a href="includes/logout.inc.php">Sign Out</a>
                    
                    <!--
                    <form action="includes/logout.inc.php" method="post">
                        <button type="submit" name="logout">Log Out</button>
                    </form>
                    -->
                </li>
            </ul>
        </div>
    </nav>
    <div class="instr">
        <h1>Have photos of your <span style="color: #5DA2D7">amazing</span> works?</h1>
    </div>
    <div class="icon">

        <!--
        <form action="upload.php" method="POST" enctype="multipart/form-data">
            <input type="file" name="file">
            <button type="submit" name="submit">UPLOAD</button>
        </form>
        -->
        <div class="upload">
            <div class="upload-button">
            <form action="includes/upload.inc.php" method="POST" enctype="multipart/form-data">
                <input type="text" name="title" placeholder="Image title">
                <input type="file" name="img">
                <button type="submit" name="submit">Upload</button>
            </form>
            </div>
        </div>
    </div>
    <section class="gallery">
        <h2>Gallery</h2>
       
        <div class="gallery-container">
            <?php
                include_once 'includes/dbh.inc.php';
                $sql = "SELECT * FROM gallery ORDER BY sort DESC";
                $pstmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($pstmt, $sql)){
                    header("location: index.php?error=error");
                } else{
                    mysqli_stmt_execute($pstmt);
                    $result = mysqli_stmt_get_result($pstmt);
                    while($row = mysqli_fetch_assoc($result)){
                        if($row["userid"] == $_SESSION["userid"]){
                        echo '
                        <div class="gallery-container-box">
                            <a href="#">
                            <div class="gallery-box-img" style="background-image: url(uploads/'.$row["fullname"].');"></div>
                            </a>
                            <h3>'.$row["title"].'</h3>
                        </div>
                        ';
                        }
                    }
                }
            ?>
        </div>
</section>
</body>
</html>