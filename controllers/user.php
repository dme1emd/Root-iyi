<?php
    include("../../tbs_3150/tbs_class.php");
    include("../models/userModele.php");
    include("../utils/restriction.php");
    session_start();
    $tbs = new clsTinyButStrong;
    if(!isset($_GET["userId"])){ // if the userId param not given redirect to challenges
        header("Location: /~moaliouche/tp-php/rootiyi/controllers/challenges.php");
        die();
    }
    $user = "User"::retreiveUser($_GET["userId"]);
    if(is_user($_GET["userId"])){
        $template="personal-profile.html";
    }
    else{
        $template="user.html";
    }
    $tbs->LoadTemplate("../views/" . $template);
    $tbs->Show();
?>