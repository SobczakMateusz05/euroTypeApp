<?php

if(isset($_POST["user"])&&$_POST["user"]!=0&&isset($_POST["pass"])&&$_POST["pass"]!=""){
    require_once("../connect.php");

    $user = htmlspecialchars($_POST["user"]);
    $pass= htmlspecialchars($_POST["pass"]);

    $pass=password_hash("$pass", PASSWORD_DEFAULT);

    $sql = "SELECT haslo from osoby where id_osoby=$user";
    $result = $conn -> query($sql);
    $row_num = mysqli_num_rows($result);

    if($row_num!=1){
        header("location:../../adminpanel.php?passuser=2");
    }
    else{
        $row = $result -> fetch_assoc();
        if($row["haslo"]!=$pass){
            $sql = "UPDATE osoby SET haslo='$pass' WHERE id_osoby=$user";
        
            $result = $conn -> query($sql);
    
            header("location:../../adminpanel.php?passuser=1");
        }
        else{
            header("location:../../adminpanel.php?passuser=3");
        }
    }
}
else{
    header("location:../../adminpanel.php?passuser=2");
}