<?php
    include_once "../connect.php";
    $pdo = new PDO($host,$login,$password);
    class Category{
        private $title;
        public function __construct($title="") {
            $this->title = $title;
        }
        public function addCategory(){
            global $pdo;
            $res=$pdo->prepare("INSERT INTO `category` (`title`) VALUES (:title);");
            $res->bindParam(":title",$this->title);
            $res->execute();
        }
        public static function retreiveCategory($id){
            global $pdo;
            $res=$pdo->prepare("SELECT * FROM `category` WHERE `challengeId`=:challengeId;");
            $res->bindParam(":challengeId",$id);
            $res->execute();
            $row = $res->fetch(PDO::FETCH_ASSOC);
            return row;
        }
        public static function retreiveCategories(){
            global $pdo;
            $res=$pdo->prepare("SELECT * FROM `category`;");
            $res->execute();
            $rows = $res->fetchAll(PDO::FETCH_ASSOC);
            return $rows;
        }
    }
?>