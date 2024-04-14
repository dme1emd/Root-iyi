<?php
    include_once "../../tbs_3150/tbs_class.php";
    include_once "../connect.php";
    include_once "../utils/restriction.php";
    include_once "../context/authContext.php";
    include_once "../models/challengeModele.php";
    include_once "../context/authContext.php";
    session_start();
    $tbs = new clsTinyButStrong;
    if(is_connected()){
        $connexionStatus = "connected";
    }
    else{
        $connexionStatus = "not-connected";
    }
    try {
        $pdo = new PDO($host, $login, $password);
        if(isset($_GET["id"])){
            $id=$_GET["id"];
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
        else{
            if(isset($_POST["flag"])){
                only_auth();
                $row="Challenge"::retreiveChallenge($_POST["id"]);
                $id=$row["challengeId"];
                $title=$row["title"];
                $description=$row["description"];
                $urlChallenge=$row["urlChallenge"];
                $difficulty=$row["difficulty"];
                $challengeId=$row["challengeId"];
                if($row["flag"] == $_POST["flag"]){
                    if("Challenge"::validate($_SESSION["userId"],$challengeId)){
                        $message = "congratulations you got it right you win " . $row["nbPoints"] . " points.";
                        $css_class = "success_challenge";
                    }
                    else{
                        $message = "you have already solved this challenge ;)";
                        $css_class = "fail_challenge";
                    }
                }
                else{
                    $message="wrong flag try again";
                    $css_class = "fail_challenge";
                }
            }
            else{
                header("Location: /~moaliouche/tp-php/Root-iyi/controllers/challenges.php?category=1");
                die();
            }
        }
        
    } catch (PDOException $erreur) {
        $message = $erreur->getMessage();
    }
    if(is_connected()){
        $connexion_status="connected";
    }
    else{
        $connection_status="disconnected";
    }
    $tbs->LoadTemplate("../views/challenge.html");
    $tbs->Show();
?>