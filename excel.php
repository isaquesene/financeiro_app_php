<?php
    @include('conectar.php');

    $output = '';
    if(isset($_POST["export_excel"])){
        $sql  = "select * from financa order by id_financa desc";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0){

            $output .= '
                    <table class="table" bordered="1">
                    <tr>
                        <th>Descricao</th>
                        <th>Valor</th>
                        <th>Pagamento</th>
                        <th>Categoria</th>
                        <th>Data</th>
                        <th>Tipo</th>
                    </tr
            ';
            while($row = mysqli_fetch_array($result)){
                $output .= '
                    <tr>
                        <td>'.$row["descricao"].'</td>
                        <td>'.$row["valor"].'</td>
                        <td>'.$row["pagamento"].'</td>
                        <td>'.$row["categoria"].'</td>
                        <td>'.$row["dataent"].'</td>
                        <td>'.$row["entradas"].'</td>
                    </tr>
                ';
            }
            $output .= '</table>';
            header("Content-Type: application/xls");
            header("Content-Disposition: attachment; filename=downlaod.xls");
            echo $output;
        }
    }
