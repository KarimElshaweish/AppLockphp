<?php
    class DBOpertation{
        private $conn;
        function __construct()
        {
            require_once dirname(__FILE__).'/DBConnect.php';
            $db=new DBConnect();
            $this->conn=$db->connect();
        }
        private function isUserExit($Name,$Email){
            $stmt=$this->conn->prepare("SELECT ID FROM register WHERE NAME = ? OR Email =?");
            $stmt->bind_param("ss",$Name,$Email);
            $stmt->execute();
            $stmt->store_result();
            return $stmt->num_rows>0;
        }
       public function  createUser($ID,$Name,$Passowrd,$Email)
       {
           if ($this->isUserExit($Name, $Passowrd)) {
                return 0;
           } else {
               $Passowrd = md5($Passowrd);
               $stmt = $this->conn->prepare("
                            INSERT INTO `register` (`ID`, `Name`, `Email`, `Password`) VALUES (?, ?, ?, ?)"
               );
               $stmt->bind_param("ssss", $ID, $Name, $Email, $Passowrd);
               if ($stmt->execute()) {
                   return 1;
               } else {
                   return 2;
               }
           }
       }
       public function userLogin($Email,$Passowrd){
            $Passowrd=md5($Passowrd);
            $stmt=$this->conn->prepare("SELECT ID FROM register WHERE Email=? AND Password=?");
            $stmt->bind_param("ss",$Email,$Passowrd);
            $stmt->execute();
            $stmt->store_result();
            return $stmt->num_rows>0;
       }
       public function getUserID($Email){
            $stmt=$this->conn->prepare("select ID from register where Email = ?");
            $stmt->bind_param("s",$Email);
            return $stmt->get_result()->fetch_assoc();
       }
    }
