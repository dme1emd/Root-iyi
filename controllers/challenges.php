<?php
    include_once "../../tbs_3150/tbs_class.php";
    include_once "../models/challengeModele.php";
    include_once "../connect.php";
    include_once "../context/authContext.php";
    $tbs = new clsTinyButStrong;
    try {
        $pdo = new PDO($host, $login, $password);
        $message = "connexion établie";
        if(isset($_GET["category"])){
            $rows = "Challenge"::retreiveChallenges($_GET["category"]);
            $tbs->LoadTemplate("../views/challenges.html");
            $tbs->MergeBlock("row",$rows);
            $tbs->Show();
        }
        else{
            header("Location: /~moaliouche/tp-php/Root-iyi/controllers/home.php");
            die();
        }
    } catch (PDOException $erreur) {
        $message = $erreur->getMessage();
        $tbs->LoadTemplate("../views/challenges.html");
        $tbs->Show();
    }

?>