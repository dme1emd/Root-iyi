<?php
    session_start();
    session_destroy();
    header("Location: /~moaliouche/tp-php/rootiyi/controllers/login.php");
    die();
?>