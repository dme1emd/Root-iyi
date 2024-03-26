<?php
    include("../../tbs_3150/tbs_class.php");
    include("../connect.php");
    $tbs = new clsTinyButStrong;
    try {
        $pdo = new PDO($host, $login, $password);
        $message = "connexion établie";
        if(isset($_POST["pseudo"])){
            $res=$pdo->prepare("SELECT * FROM `user` WHERE pseudo=:psuedo AND password=:password");
            $res->bindParam(":pseudo",$_POST["pseudo"]);
            $res->bindParam(":password",$_POST["password"]);
            $res->execute();
            $row = $res->fetch(PDO::FETCH_ASSOC);
            if($row){
                $message="connected";//TODO:start a session
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