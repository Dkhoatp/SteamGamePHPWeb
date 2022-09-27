<?php
class product {
    private $Game_id;
    private $Type;
    private $Name;
    private $publisher;
    private $developers;
    private $releaseDate;
    private $Imgae;
    private $video;
    private $price;
    private $description;
    function __construct($Game_id, $Type, $Name, $publisher, $developers, $releaseDate, $Imgae, $video, $price, $description) {
        $this->Game_id = $Game_id;
        $this->Type = $Type;
        $this->Name = $Name;
        $this->publisher = $publisher;
        $this->developers = $developers;
        $this->releaseDate = $releaseDate;
        $this->Imgae = $Imgae;
        $this->video = $video;
        $this->price = $price;
        $this->description = $description;
    }
    public function showall($conn) {
        $sql = "SELECT * FROM pruduct";
        $result = $conn->query($sql);
        return $result;
    }
    public function showimg($conn,$id){
        $sql = "SELECT * FROM image where gameID='$id'";
        $result = $conn->query($sql);
        return $result;
    }
     public function showallseachname($conn,$seach) {
        $sql = "SELECT * FROM pruduct where name Like '%$seach%' ";
        $result = $conn->query($sql);
        return $result;
    }
    public function showalltype($conn) {
        $sql = "SELECT * FROM type";
        $result = $conn->query($sql);
        return $result;
    }
    public function uploadfileimg() {
        $file_name = $_FILES["images"]['name'];
        foreach ($file_name as $key => $value) {
            move_uploaded_file($_FILES['images']['tmp_name'][$key], 'img/imgproduct/' . $_FILES['images']['name'][$key]);
        }
    }
    public function inserttype($conn,$typeid,$typename) {
        $sql = "insert into type (Type_ID,Name) values (?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("is",$typeid,$typename);
        $stmt->execute();
    }
    public function deletetype($conn) {
        $id = $_REQUEST['delete'];
        $stmt = $conn->prepare("delete from type where Type_ID = ?");
        $stmt->bind_param("i",$id);
        $result = $stmt->execute();
        return $result;
    }
    public function showallseachnametype($conn,$seach) {
        $sql = "SELECT * FROM type where name Like '%$seach%' ";
        $result = $conn->query($sql);
        return $result;
    }
    public function seach($conn){
        $id = $_GET['edit'];
        $sql = "SELECT * FROM type where  Type_ID='$id'";
        $result = $conn->query($sql);
        return $result;
    }
     public function edittype($conn,$nametype) {
        $id = $_REQUEST['edit'];
        $stmt = $conn->prepare("update type set Name = ? where Type_ID=?");
        $stmt->bind_param("si",$nametype,$id);
        $result = $stmt->execute();
        return $result;
    }
     public function delete($conn) {
        $id = $_REQUEST['delete'];
        $stmt = $conn->prepare("update pruduct set status = ? where  gameID= ?");
        $dl="false";
        $stmt->bind_param("ss",$dl,$id);
        $result = $stmt->execute();
        return $result;
    }
       public function insert($conn) {
        $sql = "insert into pruduct(gameID,type,name,publisher,developers,releaseDate,description,price,URLvideo,status) values (?,?,?,?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $status="true";
        $stmt->bind_param("ssssssssss",$this->Game_id, $this->Type, $this->Name,$this->publisher,$this->developers, $this->releaseDate, $this->description, $this->price, $this->video,$status);
        $stmt->execute(); 
    }
    public function seachproduct($conn){
        $id = $_GET['edit'];
        $sql = "SELECT * FROM pruduct where  gameID='$id'";
        $result = $conn->query($sql);
        return $result;
    }
     public function edit($conn) {
        $id = $_REQUEST['edit'];
        $stmt = $conn->prepare("update pruduct set  type=?, name=?, publisher=?, developers=?, description=?,price=?,URLvideo=? where  gameID=?");
        $stmt->bind_param("ssssssss",$this->Type,$this->Name,$this->publisher,$this->developers,$this->description,$this->price,$this->video,$id);
        $result = $stmt->execute();
        return $result;
    }
    public function showallbuy($conn) {
        $sql = "SELECT * FROM buy";
        $result = $conn->query($sql);
        return $result;
    }
    public function showsanpham($conn){
        $id = $_GET['detal'];
        $sql = "SELECT * FROM pruduct where  gameID='$id'";
        $result = $conn->query($sql);
        return $result;
    }
     public function insertbuy($conn,$ngame,$name,$date) {
        $sql = "insert into buy(name,gameID,DateBuy) values (?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss",$name,$ngame,$date);
        $stmt->execute(); 
    }
    public function deletepd($conn,$name) {
        $id =$name;
        $stmt = $conn->prepare("update pruduct set status = ? where  name= ?");
        $dl="false";
        $stmt->bind_param("ss",$dl,$id);
        $result = $stmt->execute();
        return $result;
    }
    
   
}
