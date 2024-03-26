<?php
    include("../../tbs_3150/tbs_class.php");
    include("../connect.php");
    $tbs = new clsTinyButStrong;
    try {
        $pdo = new PDO($host, $login, $password);
        $message = "connexion établie";
        if(isset($_POST["title"])){
            $res=$pdo->prepare("INSERT INTO challenge (title, description, urlChallenge, difficulty,flag) VALUES (:title, :description, :urlChallenge, :difficulty,:flag)");
            $res->bindParam(":title",$_POST["title"]);
            $res->bindParam(":description",$_POST["description"]);
            $res->bindParam(":urlChallenge",$_POST["urlChallenge"]);
            $res->bindParam(":difficulty",$_POST["difficulty"]);
            $res->bindParam(":flag",$_POST["flag"]);
            $res->execute();
        }
    } catch (PDOException $erreur) {
        $message = $erreur->getMessage();
    }
    $tbs->LoadTemplate("../views/admin.html");
    $tbs->Show();
?>