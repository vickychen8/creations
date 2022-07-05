<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creations</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Arima&display=swap" rel="stylesheet">
</head>
<body>
    <div class="wrapper">
    <div class="signup-stor">
    <section class="main">
            <section class="left">
                <div class="left-box">
                    <div class="line"></div>
                    <h1>Sign Up</h1> 
                    <div class="signup-form">
                        <form action="includes/signup.inc.php" method="post">
                            <input type="text" name="username" placeholder="Create an username">
                            <input type="text" name="name" placeholder="Full name">
                            <input type="password" name="pwd" placeholder="Password">
                            <input type="password" name="pwdrepeat" placeholder="Repeat password">
                            <button type="submit" name="submit">Submit</button>
                        </form>
                    </div>
                    <div class="signin">
                        <a href="signin.php"><button type="button" name="signup">Sign In</button></a>
                    </div>
                </div>
            </section>
            <section class="right">
            <h1>CREATIONS</h1>
            <p>Store your works of art in one site</p>
            </section>
    </section>
    </div>
</div>
</body>
</html>