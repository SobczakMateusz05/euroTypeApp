<?php

if(isset($_POST["user"])&&$_POST["user"]!=0){
    require_once("../connect.php");
    $user = htmlspecialchars($_POST["user"]);

    $sql = "DELETE FROM osoby WHERE id_osoby = $user";
    $sql2 = "DELETE FROM typy WHERE id_osoby = $user";
    $sql3 = "DELETE FROM zaglosowane WHERE id_osoby = $user";
   
    $result = $conn -> query($sql);
    $result2 = $conn -> query($sql2);
    $result2 = $conn -> query($sql3);

    header("location:../../adminpanel.php?deluser=1");
}
else{
    header("location:../../adminpanel.php?deluser=2");
}
