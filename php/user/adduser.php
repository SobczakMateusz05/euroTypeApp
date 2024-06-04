<?php
if(isset($_POST["name"])&&isset($_POST["pass"])&&isset($_POST["type"])){
    require_once("../connect.php");

    $name = htmlspecialchars($_POST["name"]);
    $pass = htmlspecialchars($_POST["pass"]);
    $type= htmlspecialchars($_POST["type"]);
    
    $sql = "SELECT login from osoby WHERE login='$name'";
    $result = $conn -> query($sql);
    $num_row = mysqli_num_rows($result);
    
    if($num_row==0){
        $sql = "INSERT INTO osoby(login, haslo, typ) VALUES('$name', '$pass', '$type')";
    
        $result = $conn -> query($sql);
    
        header("location:../../adminpanel.php?user=1");
    }
    else{
        header("location:../../adminpanel.php?user=3");
    }  
}
else{
    header("location:../../adminpanel.php?user=2");
}
