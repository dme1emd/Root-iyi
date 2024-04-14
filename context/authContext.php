<?php
        include("../connect.php");
        include_once "../models/challengeModele.php";
        session_start();
        function get_auth_context(){

            if(isset($_SESSION["pseudo"])){
                $pdo = new PDO($host, $login, $password);
                $res=$pdo->prepare("SELECT * FROM `user` WHERE pseudo=:pseudo AND password=:password");
                $res->bindParam(":pseudo",$_SESSION["pseudo"]);
                $res->bindParam(":password",$_SESSION["password"]);
                $res->execute();
                $row = $res->fetch(PDO::FETCH_ASSOC);
                if($row){
                    return "connected";
                }
                    return "not-connected";
            }
            return "not-connected";
        }
?>