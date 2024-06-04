<?php

if(isset($_POST["game"])&&$_POST["game"]!=0&&isset($_POST["score"])&&($_POST["score"]==0||$_POST["score"]==1||$_POST["score"]==2)){
    require_once("../connect.php");
    $game = htmlspecialchars($_POST["game"]);
    $score = htmlspecialchars($_POST["score"]);

    $sql = "UPDATE wyniki as w SET w.wynik=$score WHERE w.id_meczu=$game";

    $result = $conn -> query($sql);
    
    header("location:../../adminpanel.php?editscore=1");
}
else{
    header("location:../../adminpanel.php?editscore=2");
}
