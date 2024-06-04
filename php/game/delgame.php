<?php

if(isset($_POST["game"])&&$_POST["game"]!=0){
    require_once("../connect.php");

    $game = htmlspecialchars($_POST["game"]);
    $sql = "DELETE FROM mecze WHERE id_meczu = $game";
    $sql2 = "DELETE FROM wyniki WHERE id_meczu = $game";
    $sql3 = "DELETE FROM typy WHERE id_meczu = $game";

    $result = $conn -> query($sql);
    $result2 = $conn -> query($sql2);
    $result3 = $conn -> query($sql3);
    header("location:../../adminpanel.php?delgame=1");
}
else{
    header("location:../../adminpanel.php?delgame=2");
}