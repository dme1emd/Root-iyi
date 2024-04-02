<?php
    include("../../tbs_3150/tbs_class.php");
    include("../connect.php");
    include("../models/challengeModele.php");
    $tbs = new clsTinyButStrong;
    try {
        $pdo = new PDO($host, $login, $password);
        $message = "connexion établie";
        if(isset($_GET["id"])){
            $row = "Challenge"::retreiveChallenge($_GET["id"]);
            $title=$row["title"];
            $description=$row["description"];
            $urlChallenge=$row["urlChallenge"];
            $difficulty=$row["difficulty"];
            $challengeId=$row["challengeId"];
            $tbs->MergeField("row",$row);
            $tbs->LoadTemplate("../views/challenge.html");
            $tbs->Show();
        }
        if(isset($_POST["flag"])){
            if($row){
                $message="félicitations vous avez resolu le challenge " . $row["title"];//TODO: verify the user didn't solve this yet 
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