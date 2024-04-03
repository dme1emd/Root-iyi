<?php
    include("../connect.php");
    $pdo = new PDO($host,$login,$password);
    class User{
        private $pseudo;
        private $mail;
        private $password;
        private $nbPoints;
        public function __construct($pseudo="",$mail="",$password="",$nbPoints=0) {
            $this->pseudo = $pseudo;
            $this->mail = $mail;
            $this->password = $password;
            $this->nbPoints = $nbPoints;
        }
        public function save(){
            global $pdo;
            $res=$pdo->prepare("INSERT INTO `user` (`pseudo`,`mail`,`password`,`nbPoints`) VALUES (:pseudo,:mail,:password,:nbPoints);");
            $res->bindParam(":mail",$this->mail);
            $res->bindParam(":password",$this->password);
            $res->bindParam(":pseudo",$this->pseudo);
            $res->bindParam(":nbPoints",$this->nbPoints);
            $res->execute();
        }
        public static function retreiveUser($id){
            global $pdo;
            $res=$pdo->prepare("SELECT userId,pseudo,mail,nbPoints FROM `user` WHERE `userId`=:userId;");
            $res->bindParam(":userId",$id);
            $res->execute();
            $row = $res->fetch(PDO::FETCH_ASSOC);
            return $row;
        }
    }
?>