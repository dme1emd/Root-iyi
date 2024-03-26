<?php
    include("../../tbs_3150/tbs_class.php");
    include("../connect.php");
    $tbs = new clsTinyButStrong;
    try {
        $pdo = new PDO($host, $login, $password);
        $message = "connexion établie";
        if(isset($_GET["category"])){
            $res = $pdo->prepare("SELECT * FROM `challenge` WHERE `categoryId`=:categoryId;");
            $res->bindParam(":categoryId",$_GET["category"]);
            $res->execute();
            $rows = $res->fetchAll(PDO::FETCH_ASSOC);
            $tbs->MergeBlock("row",$rows);
        }
    } catch (PDOException $erreur) {
        $message = $erreur->getMessage();
    }
    $tbs->LoadTemplate("../views/challenges.html");
    $tbs->Show();
?>