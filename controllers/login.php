<?php
    include_once "../../tbs_3150/tbs_class.php";
    include_once "../connect.php";
    include_once "../utils/restriction.php";
    include_once "../context/authContext.php";
    $tbs = new clsTinyButStrong;
    session_start();
    only_unauth();
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
    try {
        $pdo = new PDO($host, $login, $password);
        if(isset($_POST["pseudo"])){
            $res=$pdo->prepare("SELECT * FROM `user` WHERE pseudo=:pseudo AND password=:password");
            $res->bindParam(":pseudo",$_POST["pseudo"]);
            $res->bindParam(":password",$_POST["password"]);
            $res->execute();
            $row = $res->fetch(PDO::FETCH_ASSOC);
            if($row){
                $message="connected";
                $_SESSION["userId"] = $row["userId"];
                $_SESSION["pseudo"]= $row["pseudo"];
                $_SESSION["password"]=$row["password"];
                header("Location: ./challenges.php");
                die();
            }
            else{
                $message="connexion failed";
            }
        }
    } catch (PDOException $erreur) {
        $message = $erreur->getMessage();
    }
    $tbs->LoadTemplate("../views/login.html");
    $tbs->Show();
?>