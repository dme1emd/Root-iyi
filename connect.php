<?php
    $env = parse_ini_file('.env');
    $host =$_ENV["HOST"]; 
    $login = $_ENV["LOGIN"];
    $password = $_ENV["PASSWORD"];
    $dbname = $login;
?>