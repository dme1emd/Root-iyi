<?php
    include_once "../../tbs_3150/tbs_class.php";
    include_once "../connect.php";
    include_once "../utils/restriction.php";
    include_once "../context/authContext.php";
    include_once "../models/userModele.php";
    $tbs = new clsTinyButStrong;
    session_start();
    only_unauth();
    $message = "";
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
    try {
        $pdo = new PDO($host, $login, $password);
        if(isset($_POST["pseudo"])){
            if("User"::userExists($_POST["pseudo"])){
                $message = "a user with this pseudo already exists try another one :)";
            }
            else{
                $user = new User($_POST["pseudo"] ,$_POST["email"] ,$_POST["password"]);
                $user->save();
                $message = "user created succefully, go to login page now";
            }
        }
    } catch (PDOException $erreur) {
        $message = $erreur->getMessage();
    }
    $tbs->LoadTemplate("../views/register.html");
    $tbs->Show();
?>