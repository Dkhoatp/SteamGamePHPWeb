<?php
class buy{
    private $buyID;
    private $name;
    private $gameID;
    private $DateBuy;
    
    function __construct($buyID, $name, $gameID, $DateBuy) {
        $this->buyID = $buyID;
        $this->name = $name;
        $this->gameID = $gameID;
        $this->DateBuy = $DateBuy;
    }

    function ownGame($conn, $usname, $gameID){
        $sql = "SELECT name, gameID FROM buy where name = '$usname' and gameID = '$gameID'";
        $result = $conn->query($sql);
        return $result;
        
    }
}
?>