<?php
require '../config/config.php';

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($mysqli->connect_errno) {
    echo $mysqli->connect_error;
    exit();
}

$sql_check = "SELECT * FROM bars WHERE name = '" . $_GET['name'] . "';";
$results_check = $mysqli->query($sql_check);
if(!$results_check) {
    echo $mysqli->error;
    exit();
}
if( $results_check->num_rows == 0 ) {
    $sql_insert = "INSERT INTO bars(name,img,address,rating,open) VALUES('" . $_GET['name'] . "',' " . $_GET['img'] . "',' " . $_GET['address'] . "',' " . $_GET['rating'] . "', '" . $_GET['open'] . "');";

    $results_insert = $mysqli->query($sql_insert);
    if(!$results_insert) {
        echo $mysqli->error;
        exit();
    }
}

$sql_user_Bar_Relationship = "INSERT INTO users_has_bars (users_id, bars_id)
                                SELECT users.id, bars.id
                                FROM users, bars
                                WHERE users.username ='" . $_SESSION['username'] . "'
                                AND name = '" . $_GET['name'] . "';";
$results_user_Bar_Relationship = $mysqli->query($sql_user_Bar_Relationship);
if(!$results_user_Bar_Relationship) {
    echo $mysqli->error;
    exit();
}

?>