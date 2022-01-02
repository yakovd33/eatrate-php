<?php
    ob_start();
    session_start();

    $conn = new PDO("mysql:host=localhost;dbname=eatrate", 'root', '');
    $conn->exec("set names utf8");
    $URL = 'http://localhost/eatRate/';
?>