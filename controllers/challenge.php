<?php
    include("../../tbs_3150/tbs_class.php");
    include("../connect.php");
    $tbs = new clsTinyButStrong;
    try {
        $pdo = new PDO($host, $login, $password);
        $message = "connexion établie";
        if(isset($_GET["id"])){
            $res = $pdo->prepare("SELECT * FROM `challenge` WHERE `challengeId`=:challengeId;");
            $res->bindParam(":challengeId",$_GET["id"]);
            $res->execute();
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $title=$row["title"];
            $description=$row["description"];
            $urlChallenge=$row["urlChallenge"];
            $difficulty=$row["difficulty"];
            $challengeId=$row["challengeId"];
            $tbs->MergeField("row",$row);
        }
        if(isset($_POST["flag"])){
            $res = $pdo->prepare("SELECT * FROM `challenge` WHERE `challengeId`=:challengeId AND `flag`=:flag;");
            $res->bindParam(":challengeId",$_POST["challengeId"]);
            $res->bindParam(":flag",$_POST["flag"]);
            $res->execute();
            $row = $res->fetch(PDO::FETCH_ASSOC);
            if($row){
                $message="félicitations vous avez resolu le challenge " . $row["title"]; // todo: check if it wasn't solved yet by the player
            }
            else{
                $message="not ok";
            }
        }
    } catch (PDOException $erreur) {
        $message = $erreur->getMessage();
    }
    $tbs->LoadTemplate("../views/challenge.html");
    $tbs->Show();
?>