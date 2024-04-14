<?php
    $pdo = new PDO($host,$login,$password);
    class Resolution{
        private $userId;
        private $challengeId;
        public function __construct($userId,$challengeId) {
            $this->userId = $userId;
            $this->challengeId = $challengeId;
        }
        public function save(){
            global $pdo;
            $res = $pdo->prepare("INSERT INTO resolution (userId,challengeId) VALUES (:userId,:challengeId);");
            $res->bindParam(":userId",$this->userId);
            $res->bindParam(":challengeId",$this->challengeId);
            $res->execute();
        }
    }
?>