<?php
    require("../connect.php");
    $pdo = new PDO("mysql:host=mysql02.univ-lyon2.fr;dbname=php_moaliouche;charset=utf8mb4", "php_moaliouche", "xpf-FeenJiA7mEP4TE1KbuO4n");
    class Category{
        private $title;
        public function __construct($title="") {
            $this->title = $title;
        }
        public function addCategory(){
            $res=$pdo->prepare("INSERT INTO `category` (`title`) VALUES (:title);");
            $res->bindParam(":title",$this->title);
            $res->execute();
        }
        public static function retreiveCategory($id){
            $res=$pdo->prepare("SELECT * FROM `category` WHERE `challengeId`=:challengeId;");
            $res->bindParam(":challengeId",$id);
            $res->execute();
            $row = $res->fetch(PDO::FETCH_ASSOC);
            return row;
        }
    }
?>