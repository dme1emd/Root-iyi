<?php
    include_once "../../tbs_3150/tbs_class.php";
    include_once "../connect.php";
    include_once "../utils/restriction.php";
    include_once "../models/challengeModele.php";
    include_once "../models/categoryModele.php";
    include_once "../context/authContext.php";
    session_start();
    admin_only();
    $message="";
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
    $rows = "Category"::retreiveCategories();
    $tbs = new clsTinyButStrong;
        if(isset($_POST["title"])){
            $chl = new Challenge($_POST["category"],$_POST["title"],$_POST["description"],$_POST["urlChallenge"],$_POST["flag"],$_POST["nbPoints"],$_POST["difficulty"]);
            $chl->save();
        }
    $tbs->LoadTemplate("../views/admin.html");
    $tbs->MergeBlock("row",$rows);
    $tbs->Show();
?>