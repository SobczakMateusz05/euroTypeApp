<?php

if(isset($_POST["game"])&&$_POST["game"]!=0){
    require_once("../connect.php");
    
    $game = htmlspecialchars($_POST["game"]);

    $sql = "DELETE from wyniki where id_meczu=$game";

    $result = $conn -> query($sql);

    header("location:../../adminpanel.php?delscore=1");
}
else{
    header("location:../../adminpanel.php?delscore=2");
}