<?php
    include_once "../../tbs_3150/tbs_class.php";
    include_once "../models/categoryModele.php";
    include_once "../connect.php";
    include("../context/authContext.php");
    include_once "../utils/restriction.php";
    $tbs = new clsTinyButStrong;
    $message="";
    $rows = "Category"::retreiveCategories();
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
    $tbs->LoadTemplate("../views/home.html");
    $tbs->MergeBlock("row",$rows);
    $tbs->Show();
?>