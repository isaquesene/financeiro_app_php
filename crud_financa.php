<?php
 
 include 'conectar.php';

//CURD 
if(isset($_POST['send'])){
    $descricao = $_POST['descricao'];
    $valor = $_POST['valor'];
    $pagamento = $_POST['pagamento'];
    $categoria = $_POST['categoria'];
    $dataent = $_POST['dataent'];
    $entradas = $_POST['entradas'];


    $request = "insert into financa(descricao, valor, pagamento, categoria, dataent, entradas) values 
    ('$descricao','$valor','$pagamento','$categoria','$dataent','$entradas')";


    mysqli_query($conn, $request);

    //echo 'Sucesso!';
    header('location:index.php');
}else{
    echo '';
}
?>