<?php
    $env = parse_ini_file('.env');
    $host = $env["HOST"]; 
    $login = $env["LOGIN"] ;
    $password = $env["PASSWORD"];
    $dbname = $login;
?>