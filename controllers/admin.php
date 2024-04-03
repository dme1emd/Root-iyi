<?php
    include("../../tbs_3150/tbs_class.php");
    include("../connect.php");
    include("../utils/restriction.php");
    include("../models/challengeModele.php");
    session_start();
    admin_only();
    $tbs = new clsTinyButStrong;
        if(isset($_POST["title"])){
            //pass the category id in the form for later
            $chl = new Challenge(1,$_POST["title"],$_POST["description"],$_POST["urlChallenge"],$_POST["flag"],$_POST["nbPoints"],$_POST["difficulty"]);
            $chl->save();
        }
    $tbs->LoadTemplate("../views/admin.html");
    $tbs->Show();
?>