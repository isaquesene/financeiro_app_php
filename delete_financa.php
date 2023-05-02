<?php 
include "conectar.php";

    $id = $_GET['id_financa'];
    $sql = "delete from financa where id_financa=$id";
    $result = mysqli_query($conn, $sql);

    if($result){
        header("location:index.php");
    }else{
        echo "Erro: " . mysqli_error($conn);
    }
?>