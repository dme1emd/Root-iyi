<?php
    include("../../tbs_3150/tbs_class.php");
    include("../connect.php");
    $tbs = new clsTinyButStrong;
    try {
        $pdo = new PDO($host, $login, $password);
        $message = "connexion établie";
    } catch (PDOException $erreur) {
        $message = $erreur->getMessage();
    }
    if(isset($_POST["title"])){
        $res=$pdo->prepare("INSERT INTO challenge (title, description, urlChallenge, difficulty) VALUES (:title, :description, :urlChallenge, :difficulty)");
        $res->bindParam(":title",$_POST["title"]);
        $res->bindParam(":description",$_POST["description"]);
        $res->bindParam(":urlChallenge",$_POST["urlChallenge"]);
        $res->bindParam(":difficulty",$_POST["difficulty"]);
        $res->execute();
    }
    $tbs->LoadTemplate("../views/admin.html");
    $tbs->Show();
?>