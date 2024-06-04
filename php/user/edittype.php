<?php

if(isset($_POST["user"])&&$_POST["user"]!=0&&isset($_POST["type"])){
    require_once("../connect.php");
    $user = htmlspecialchars($_POST["user"]);
    $type = htmlspecialchars($_POST["type"]);

    $sql = "UPDATE osoby set typ = $type where id_osoby = $user";
    $result = $conn ->query($sql);

    header("location:../../adminpanel.php?edittype=1");
}
else{
    header("location:../../adminpanel.php?edittype=2");
}