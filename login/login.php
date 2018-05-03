<?php

session_start();
require '../config/config.php';


if ( !isset($_SESSION['logged_in']) || !$_SESSION['logged_in'] ) {
    // User Not Logged In.

    if ( isset($_POST['username']) && isset($_POST['password']) ) {
        // Form was submitted

        if ( empty($_POST['username']) || empty($_POST['password']) ) {
            // Missing username or password.
            $error = "Please enter username and password.";
        } else {
            // Valid credentials. Log in the user.
            $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            if ($mysqli->connect_errno) {
                echo $mysqli->connect_error;
                exit();
            }
            $hashPassword = hash('sha256', $_POST['password']);
            $sql_registered = "SELECT * FROM users
            WHERE username = '" . $_POST['username'] . "' AND password = '" . $hashPassword .  "';";
            $results_registered = $mysqli->query($sql_registered);
            if(!$results_registered) {
                echo $mysqli->error;
                exit();
            }
            if( $results_registered->num_rows > 0 ) {
                $_SESSION['logged_in'] = true;
                $_SESSION['username'] = $_POST['username'];
                header('Location: ../barCrawler/loggedin.php');
            } else {
                $error = "Invalid username or password.";
            }
        }
    }

} else {
    // User Already Logged In.
    header('Location: ../barCrawler/loggedin.php');
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Song Database</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style type="text/css" media="screen">
        body {
/*            background-image: url('../style/background.jpg');
            background-repeat: no-repeat;
            background-size: cover;*/
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand navbar-dark bg-dark">
      <a class="navbar-brand" href="../barCrawler/index.html" style="color: #366e51; font-weight: bold; font-size: 24px;">BarCrawler</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample02" aria-controls="navbarsExample02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </nav>

    <div class="container">

        <form action="login.php" method="POST">

            <div class="row mb-3">
                <div class="font-italic text-danger col-sm-9 ml-sm-auto">
                    <!-- Show errors here. -->
                    <?php
                        if ( isset($error) && !empty($error) ) {
                            echo $error;
                        }
                    ?>
                </div>
            </div> <!-- .row -->


            <div class="form-group row">
                <label for="username-id" class="col-sm-3 col-form-label text-sm-right">Username:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="username-id" name="username">
                </div>
            </div> <!-- .form-group -->

            <div class="form-group row">
                <label for="password-id" class="col-sm-3 col-form-label text-sm-right">Password:</label>
                <div class="col-sm-9">
                    <input type="password" class="form-control" id="password-id" name="password">
                </div>
            </div> <!-- .form-group -->

            <div class="form-group row">
                <div class="col-sm-3"></div>
                <div class="col-sm-9 mt-2">
                    <button type="submit" class="btn btn-primary" style="background-color: #366e51;">Login</button>
                    <a href="../barCrawler/index.html" role="button" class="btn btn-light">Cancel</a>
                </div>
            </div> <!-- .form-group -->
        </form>

        <div class="row">
            <div class="col-sm-9 ml-sm-auto">
                <a href="register_form.php" style="color: #366e51;">Create an account</a>
            </div>
        </div> <!-- .row -->

    </div> <!-- .container -->
</body>
</html>