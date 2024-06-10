<?php

if(isset($_POST["id"])&&$_POST["id"]!=0){
    $id = htmlspecialchars($_POST["id"]);
    require_once("../connect.php");

    $sql = "DELETE FROM mecze WHERE id_meczu = $id";
    $sql2 = "DELETE FROM wyniki WHERE id_meczu = $id";
    $sql3 = "DELETE FROM typy WHERE id_meczu = $id";
    $sql4 = "DELETE FROM druzyny WHERE id=$id";

    $result = $conn -> query($sql);
    $result2 = $conn -> query($sql2);
    $result3 = $conn -> query($sql3);
    $result4=$conn -> query($sql4);

    header("location:../../adminpanel.php?delteam=1");
}
else{
    header("location:../../adminpanel.php?delteam=2");
}