<?php
    require("../connect.php");
    session_start();
    function only_auth(){
        if(isset($_SESSION["pseudo"])){
            try {
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
                    return $row;
                }
                else{
                    header("Location: /~moaliouche/tp-php/rootiyi/controllers/login.php");
                    die();
                }
            }
            catch (PDOException $erreur) {
                $message = $erreur->getMessage();
            }
        }
    }
        function only_unauth(){
            if(isset($_SESSION["pseudo"])){
                try {
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
                        header("Location: /~moaliouche/tp-php/rootiyi/controllers/challenges.php");
                        die();
                    }
                    else{
                       return 1;
                    }
                }
                catch (PDOException $erreur) {
                    $message = $erreur->getMessage();
                }
            }
            else{
                return 1;
            }
    }
    function admin_only(){
        $row = only_auth();
        if(!$row["isAdmin"]){
            header("Location: /~moaliouche/tp-php/rootiyi/controllers/challenges.php");
            die();
        }
    }
    function is_user($id){
        if(isset($_SESSION["pseudo"])){
            return  $_SESSION["userId"] == $id; 
        }
    }
?>