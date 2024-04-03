<?php
    include("../../tbs_3150/tbs_class.php");
    include("../connect.php");
    include("../models/challengeModele.php");
    include("../utils/restriction.php");
    session_start();
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
            only_auth();
            if($row["flag"] == $_POST["flag"]){
                if("Challenge"::validate($_SESSION["userId"],$row["challengeId"])){
                    $message = "congratulations you got it right you win " . $row["nbPoints"] . " points.";
                    $css_class = "success_challenge";
                }
                else{
                    $message = "you have already solved this challenge ;)";
                    $css_class = "fail_challenge";
                }
            }
            else{
                $message=$row["flag"];
                $css_class = "fail_challenge";
            }
        }
    } catch (PDOException $erreur) {
        $message = $erreur->getMessage();
    }
    $tbs->LoadTemplate("../views/challenge.html");
    $tbs->Show();
?>