<?php
    include("../connect.php");
    $pdo = new PDO("mysql:host=mysql02.univ-lyon2.fr;dbname=php_moaliouche;charset=utf8mb4", "php_moaliouche", "xpf-FeenJiA7mEP4TE1KbuO4n");
    class Challenge{
        private $categoryId;
        private $title;
        private $description;
        private $urlChallenge;
        private $flag;
        private $nbPoints;
        private $difficulty;
        public function __construct($categoryId=0, $title="",$description="",$urlChallenge="",$flag="",$nbPoints=5,$difficulty=0) {
            $this->categoryId = $categoryId;
            $this->title = $title;
            $this->description = $description;
            $this->urlChalllenge = $urlChalllenge;
            $this->flag = $flag;
            $this->nbPoints = $nbPoints;
            $this->difficulty = $difficulty;
        }
        public function addChallenge(){
            global $pdo;
            $res=$pdo->prepare("INSERT INTO `challenge` (`categoryId`,`title`,`description`,`urlChallenge`,`flag`,`nbPoints`,`difficulty`) VALUES (:categoryId,:title,:description,:urlChallenge,:flag,:nbPoints,:difficulty);");
            $res->bindParam(":title",$this->title);
            $res->bindParam(":description",$this->description);
            $res->bindParam(":categoryId",$this->categoryId);
            $res->bindParam(":urlChallenge",$this->urlChallenge);
            $res->bindParam(":flag",$this->flag);
            $res->bindParam(":nbPoints",$this->nbPoints);
            $res->bindParam(":difficulty",$this->difficulty);
            $res->execute();
        }
        public static function retreiveChallenge($id){
            global $pdo;
            $res=$pdo->prepare("SELECT * FROM `challenge` WHERE `challengeId`=:challengeId;");
            $res->bindParam(":challengeId",$id);
            $res->execute();
            $row = $res->fetch(PDO::FETCH_ASSOC);
            return $row;
        }
        public static function validate($challengeId , $userId){
            global $pdo;
            $res = $pdo->prepare("SELECT * FROM `resolution` WHERE userId=:userId AND challengeId=:challengeId;");
            $res->bindParam(":challengeId",$challengeId);
            $res->bindParam(":userId",$userId);
            $res->execute();
            $row = $res->fetch(PDO::FETCH_ASSOC);
            if($row["resolved"]){
                return false;
            }
            else{
                // this can be vulnerable to race condition
                $res = $pdo->prepare("
                UPDATE `user` SET nbPoints = nbPoints + (SELECT nbPoints FROM `challenge` WHERE challengeId=:challengeId) WHERE userId=:userId;
                UPDATE `resolution` SET resolved = 1 Where userId=:userId AND challengeId=:challengeId;
                ");
                $res->bindParam(":challengeId",$challengeId);
                $res->bindParam(":userId",$userId);
                $res->execute();
            }
        }
    }
?>