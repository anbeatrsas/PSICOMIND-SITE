<?php 

    $host = "localhost";
    $user = "root";
    $pass = "";
    $database = "psicominddb";
    $charset = "utf8";
    $port = "3306";

    try{
        
        $conn = new mysqli($host,$user,$pass,$database,$port);
        mysqli_set_charset($conn,$charset);

    }catch(Throwable $e){
        die("ERRO: ". $e);
    }

?>