<?php
    include_once "../connect.php";
    include_once "../models/userModele.php";
    include_once "../models/resolutionModele.php";
    $pdo = new PDO($host,$login,$password);
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
            $this->urlChallenge = $urlChallenge;
            $this->flag = $flag;
            $this->nbPoints = $nbPoints;
            $this->difficulty = $difficulty;
        }
        public function save(){
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
        public static function retreiveChallenges($id){
            global $pdo;
            $res = $pdo->prepare("SELECT * FROM `challenge` WHERE `categoryId`=:categoryId;");
            $res->bindParam(":categoryId",$_GET["category"]);
            $res->execute();
            $rows = $res->fetchAll(PDO::FETCH_ASSOC);
            return $rows;
        }
        public static function validate($userId,$challengeId){
            global $pdo;
            $res = $pdo->prepare("SELECT * FROM `resolution` WHERE userId=:userId AND challengeId=:challengeId;");
            $res->bindParam(":challengeId",$challengeId);
            $res->bindParam(":userId",$userId);
            $res->execute();
            $row = $res->fetch(PDO::FETCH_ASSOC);
            if($row){
                return false;
            }
            "User"::win($userId,$challengeId);
            $reso = new Resolution($userId,$challengeId);
            $reso->save();
            return true;
        }
    }
?>