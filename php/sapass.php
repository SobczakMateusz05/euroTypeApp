<?php

if(isset($_POST["pass"])){
    require_once("connect.php");
    $pass=$_POST["pass"];
    
    $sql = "INSERT INTO osoby VALUES(1, 'sa' , '$pass',1)";
    $result = $conn -> query($sql);
    header("location:../index.php");
}
else{
    header("location:../index.php");
}