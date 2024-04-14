<?php
    include_once "../../tbs_3150/tbs_class.php";
    include_once "../models/categoryModele.php";
    include_once "../connect.php";
    include("../context/authContext.php");
    include_once "../utils/restriction.php";
    $tbs = new clsTinyButStrong;
    $rows = "Category"::retreiveCategories();
    if(is_connected()){
        $connexionStatus = "connected";
        $connexionNavBar = "logout";
    }
    else{
        $connexionStatus = "not-connected";
        $connexionNavBar = "login";
    }
    $tbs->LoadTemplate("../views/home.html");
    $tbs->MergeBlock("row",$rows);
    $tbs->Show();
?>