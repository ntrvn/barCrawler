<?php

require '../config/config.php';
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($mysqli->connect_errno) {
    echo $mysqli->connect_error;
    exit();
}

$sql_data = "SELECT bars.id, bars.name, bars.img,bars.address,bars.rating,bars.open
                FROM bars
                INNER JOIN users_has_bars
                ON users_has_bars.bars_id = bars.id
                INNER JOIN users
                ON users.id = users_has_bars.users_id
                WHERE users.username = '" . $_SESSION['username'] . "';";

$results = $mysqli->query($sql_data);
if ( $results == false ) {
    echo $mysqli->error;
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>User Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../style/user.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">
    <style type="text/css" media="screen">
        @media (max-width: 1024px) {
            .float {
                width: 25%;
                margin-left: 65px;
                margin-right: 0;
            }
        }
        @media (max-width: 768px) {
            .float {
                width: 40%;
                height: 350px;
                margin-left: 50px;
                margin-right: 0;
            }
            p {
                font-size: 12px;
            }
        }
        @media (max-width: 460px) {
            h1 {
                font-size: 30px;
                padding-top: 10px;
            }
            #header {
                height: 100px;
            }
            .float {
                width: 40%;
                height: 200px;
            }
            h3 {
                font-size: 20px;
            }
        }
        @media (max-width: 375px) {
            h1 {
                font-size: 30px;
                padding-top: 10px;
            }
            #header {
                height: 100px;
            }
            .float {
                float: none;
                margin-right: auto;
                margin-left: auto;
                width: 70%;
                height: 200px;
            }
            h3 {
                padding-top: 10px;
                font-size: 20px;
            }
        }

    </style>
</head>
<body>
    <nav class="navbar navbar-expand navbar-dark bg-dark">
      <a class="navbar-brand" href="loggedin.php" style="color: #366e51; font-weight: bold; font-size: 24px;">BarCrawler</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample02" aria-controls="navbarsExample02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="user.php" style="color: #366e51; font-size: 15px; font-weight: 500; padding-top: 10px;">My Account<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="../login/logout.php" style="color: #366e51; font-size: 15px; font-weight: 500; padding-top: 10px;">Sign Out<span class="sr-only">(current)</span></a>
          </li>
        </ul>
      </div>
    </nav>
    <div id="header" class="bg-dark">
        <h1 id="textHeader">Your Saved Bars</h1>
    </div>
    <div id="body">
        <?php while ( $row = $results->fetch_assoc() ) : ?>
            <div class="float bg-dark">
                <h3 style="margin-top: 20px;"><?php echo $row['name']; ?></h3>
                <h3 class="smaller margin"><?php echo $row['address']; ?></h3>
                <h3 class="smaller margin"><?php echo $row['rating']; ?></h3>
                <h3 class="smaller margin"><?php echo $row['open']; ?></h3>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>