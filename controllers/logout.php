<?php
    session_start();
    session_destroy();
    header("Location: /~moaliouche/tp-php/Root-iyi/controllers/login.php");
    die();
?>