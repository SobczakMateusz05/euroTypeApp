<?php

if(isset($_POST["user"])&&$_POST["user"]!=0){
    require_once("../connect.php");
    $user = $_POST["user"];

    $sql = "DELETE FROM osoby WHERE id_osoby = $user";
    $reult = $conn -> query($sql);

    header("location:../../adminpanel.php?deluser=1");
}
else{
    header("location:../../adminpanel.php?deluser=2");
}
