<?php

if(isset($_POST["pass1"])&&isset($_POST["pass2"])){
    session_start();
    $id=$_SESSION["id"];
    $pass1=$_POST["pass1"];
    $pass2=$_POST["pass2"];

    $pass = password_hash("$pass1", PASSWORD_DEFAULT);

    require_once("../connect.php");
    $sql = "UPDATE osoby SET haslo='$pass' WHERE id_osoby=$id";
    $result = $conn -> query($sql);
    header("location:../../password.php?add=1");
}
else{
    header("location:../../password.php?add=2");
}