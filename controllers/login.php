<?php
    require("../../tbs_3150/tbs_class.php");
    require("../connect.php");
    require("../utils/restriction.php");
    only_unauth();
    $tbs = new clsTinyButStrong;
    if (!session_id()) {
        session_start();
    }
    try {
        $pdo = new PDO($host, $login, $password);
        $message = "connexion établie";
        if(isset($_POST["pseudo"])){
            $res=$pdo->prepare("SELECT * FROM `user` WHERE pseudo=:pseudo AND password=:password");
            $res->bindParam(":pseudo",$_POST["pseudo"]);
            $res->bindParam(":password",$_POST["password"]);
            $res->execute();
            $row = $res->fetch(PDO::FETCH_ASSOC);
            if($row){
                $message="connected";//TODO:start a session
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