<?php
    require("../connect.php");
    include_once "../models/userModele.php";
    session_start();
    function is_connected(){
        if(isset($_SESSION["pseudo"])){
                global $host;
                global $login;
                global $password;
                $pdo = new PDO($host, $login, $password);
                $res=$pdo->prepare("SELECT * FROM `user` WHERE pseudo=:pseudo AND password=:password");
                $res->bindParam(":pseudo",$_SESSION["pseudo"]);
                $res->bindParam(":password",$_SESSION["password"]);
                $res->execute();
                $row = $res->fetch(PDO::FETCH_ASSOC);
                if($row){
                    return true;
                }
                return false;
        }
    }
    function only_auth(){
        if(!is_connected()){
            header("Location: /~moaliouche/tp-php/Root-iyi/controllers/challenges.php");
            die();
        }
    }
    function only_unauth(){
        if(is_connected()){
            header("Location: /~moaliouche/tp-php/Root-iyi/controllers/challenges.php");
            die();
        }
        else{
            return 1;
        }
    }
    function admin_only(){
        only_auth();
        $row = "User"::retreiveUser($_SESSION["userId"]);
        if(!$row["isAdmin"]){
            header("Location: /~moaliouche/tp-php/Root-iyi/controllers/challenges.php?category=1");
            die();
        }
    }
    function is_user($id){
        if(isset($_SESSION["pseudo"])){
            return  $_SESSION["userId"] == $id; 
        }
    }
?>