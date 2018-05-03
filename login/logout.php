<?php
session_start();
session_destroy();
header('Location: ../barCrawler/index.html');
?>