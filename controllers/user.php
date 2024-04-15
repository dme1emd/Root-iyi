<?php
    include_once "../../tbs_3150/tbs_class.php";
    include_once "../models/userModele.php";
    include_once "../utils/restriction.php";
    include_once "../context/authContext.php";
    session_start();
    $tbs = new clsTinyButStrong;
    $message ="";
    if(is_connected()){
        $connexionStatus = "connected";
        $connexionNavBar = "logout";
        $nav = "profile";
        $navLink = "user";
    }
    else{
        $connexionStatus = "not-connected";
        $connexionNavBar = "login";
        $nav = "register";
        $navLink = "register";
    }
    if(is_connected()){
        $connexionStatus = "connected";
        $connexionNavBar = "logout";
        $nav = "profile";
        $navLink = "profile";
    }
    else{
        $connexionStatus = "not-connected";
        $connexionNavBar = "login";
        $nav = "register";
        $navLink = "register";
    }
    if(isset($_GET["userId"])){ // if the userId param not given redirect to challenges
        $user = "User"::retreiveUser($_GET["userId"]);
        $pseudo = $user["pseudo"];
        $userId = $user["userId"];
        $nbPoints = $user["nbPoints"];
        if(is_user($_GET["userId"])){
            $mail = $user["mail"];
            $template="personal-profile.html";
        }
        else{
            $template="user.html";
        }
    }
    else{
        $user = "User"::retreiveUser($_SESSION["userId"]);
        $pseudo = $user["pseudo"];
        $userId = $user["userId"];
        $mail = $user["mail"];
        $nbPoints = $user["nbPoints"];
        if(isset($_POST["current"])){
            if("User"::changePassword($_SESSION["userId"], $_POST["current"], $_POST["new"])){
                $message = "changed successfuly";
            }
            else{
                $message = "wrong password :(";
            }
        }
        $template = "personal-profile.html";
    }

    $tbs->LoadTemplate("../views/" . $template);
    $tbs->Show();
?>