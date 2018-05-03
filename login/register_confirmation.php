<?php

require '../config/config.php';

if ( !isset($_POST['email']) || empty($_POST['email'])
    || !isset($_POST['username']) || empty($_POST['username'])
    || !isset($_POST['password']) || empty($_POST['password']) ) {
    $error = "Please fill out all required fields.";
}
else {
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($mysqli->connect_errno) {
        echo $mysqli->connect_error;
        exit();
    }

    // Check if username already exists

    $sql_registered = "SELECT * FROM users
                        WHERE username = '" . $_POST['username'] . "' OR email = '" . $_POST['email'] .  "';";


    $results_registered = $mysqli->query($sql_registered);

    if(!$results_registered) {
        echo $mysqli->error;
        exit();
    }

    if( $results_registered->num_rows > 0 ) {
        // Username or email is already taken
        $error = "Username or email is already taken";
    }
    else {

        $password = hash('sha256', $_POST['password']);

        $sql = "INSERT INTO users(username, email, password) VALUES('" . $_POST['username'] . "',' " . $_POST['email'] . "', '" . $password . "');";


        $results = $mysqli->query($sql);

        if(!$results) {
            echo $mysqli->erro;
            exit();
        }
    }

    $mysqli->close();
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration Confirmation</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

    <nav class="navbar navbar-expand navbar-dark bg-dark">
      <a class="navbar-brand" href="../barCrawler/index.html" style="color: #366e51; font-weight: bold; font-size: 24px;">BarCrawler</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample02" aria-controls="navbarsExample02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </nav>

    <div class="container">

        <div class="row mt-4">
            <div class="col-12">
                <?php if ( isset($error) && !empty($error) ) : ?>
                    <div class="text-danger"><?php echo $error; ?></div>
                <?php else : ?>
                    <div class="text-success">account was successfully registered.</div>
                <?php endif; ?>
        </div> <!-- .col -->
    </div> <!-- .row -->

    <div class="row mt-4 mb-4">
        <div class="col-12">
            <a href="login.php" role="button" class="btn btn-primary" style="background-color: #366e51;">Login</a>
            <a href="../barCrawler/index.html" role="button" class="btn btn-light">Back</a>
        </div> <!-- .col -->
    </div> <!-- .row -->

</div> <!-- .container -->

</body>
</html>