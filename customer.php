<?php
class customer {
    private $email;
    private $type;
    private $us;
    private $pw;
    
    function __construct($email, $type, $us, $pw) {
        $this->email = $email;
        $this->type = $type;
        $this->us = $us;
        $this->pw = $pw;
    }  
     public function showallcustomer($conn) {
        $sql = "SELECT * FROM user";
        $result = $conn->query($sql);
        return $result;
    }
     public function showallseachname($conn,$seach) {
        $sql = "SELECT * FROM user where username Like '%$seach%' ";
        $result = $conn->query($sql);
        return $result;
    }
      public function insert($conn) {
        $sql = "insert into user(email,type,username,password,status) values (?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $status="true";
        $stmt->bind_param("sssss", $this->email,$this->type, $this->us, $this->pw,$status);
        $stmt->execute(); 
    }
    public function delete($conn) {
        $id = $_REQUEST['delete'];
        $stmt = $conn->prepare("update user set status = ? where  username= ?");
        $dl="false";
        $stmt->bind_param("ss",$dl,$id);
        $result = $stmt->execute();
        return $result;
    }
      public function edit($conn) {
        $id = $_REQUEST['edit'];
        $stmt = $conn->prepare("update user set  username=?, password=? where  email=?");
        $stmt->bind_param("sss",$this->us,$this->pw,$id);
        $result = $stmt->execute();
        return $result;
    }
    public function seach($conn){
        $id = $_GET['edit'];
        $sql = "SELECT * FROM user where  email='$id'";
        $result = $conn->query($sql);
        return $result;
    }
      public function login($conn) {
        $sql = "select username,password from user where  username= '$this->us'  AND password='$this->pw' ";
        $user = mysqli_query($conn, $sql);
        return $user;
    }

}
