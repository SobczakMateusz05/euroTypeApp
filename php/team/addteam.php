<?php

if(isset($_POST["name"])){
    $name=htmlspecialchars($_POST["name"]);
    
    $name= mb_strtolower($name, "UTF-8");
    $first = mb_substr($name, 0, 1, "UTF-8");
    $rest = mb_substr($name, 1, null, "UTF-8");
    $first = mb_convert_case($first, MB_CASE_TITLE, "UTF-8");
    $name = $first . $rest;

    require_once("../connect.php");
    $sql = "SELECT * FROM druzyny WHERE kraj = '$name'";
    $result=$conn->query($sql);
    $num_row=mysqli_num_rows($result);
    if($num_row==0){
        $sql = "INSERT INTO druzyny(kraj) VALUES('$name')";
        $result = $conn -> query($sql);
        header("location:../../adminpanel.php?addteam=1");
    }
    else{
        header("location:../../adminpanel.php?addteam=3");
    }
}
else{
    header("location:../../adminpanel.php?addteam=2");
}