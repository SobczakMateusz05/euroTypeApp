<?php

if(isset($_POST["pass"])){
    require_once("connect.php");
    $pass=htmlspecialchars($_POST["pass"]);

    $pass = password_hash("$pass", PASSWORD_DEFAULT);
    
    $sql = "INSERT INTO osoby VALUES(1, 'sa' , '$pass',1)";
    $result = $conn -> query($sql);
    header("location:../index.php");
}
else{
    header("location:../index.php");
}