<?php
    include("../../tbs_3150/tbs_class.php");
    include("../connect.php");
    include("../utils/restriction.php");
    admin_only();
    $tbs = new clsTinyButStrong;
        if(isset($_POST["title"])){
            $res=$pdo->prepare();
            $res->bindParam(":title",$_POST["title"]);
            $res->bindParam(":description",$_POST["description"]);
            $res->bindParam(":urlChallenge",$_POST["urlChallenge"]);
            $res->bindParam(":difficulty",$_POST["difficulty"]);
            $res->bindParam(":flag",$_POST["flag"]);
            $res->execute();
        }
    $tbs->LoadTemplate("../views/admin.html");
    $tbs->Show();
?>