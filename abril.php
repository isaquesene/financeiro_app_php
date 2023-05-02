<?php
//conexão
include 'conectar.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
  <title>App Financeiro</title>
</head>

<body>

  <!--<a id="button">
    <ion-icon name="chevron-up-outline"></ion-icon> &#x1F815;
  </a>-->
  <div id="progress">
    <span id="progress-value"><ion-icon name="chevron-up-outline"></ion-icon></span>
  </div>

  <!--Navbar Menu-->
  <header>
    <div class="logo">
      <img src="image/dolar.png" alt="">
      <a href="#" class="header_logo">Financeiro (Abril)</a>
    </div>
    <nav class="nav" id="nav-menu">
      <ion-icon name="close-outline" class="header_close" id="close-menu"></ion-icon>


      <ul class="nav_list">
        <li class="nav_item"><a href="lista.html" class="nav_link">Listas</a></li>
        <li class="nav_item"><a href="#" class="nav_link">Previsão</a></li>
        <li class="nav_item"><a href="abril.php" class="nav_link">Abril</a></li>
        <li class="nav_item"><a href="index.php" class="nav_link">Março</a></li>
      </ul>
    </nav>
    <ion-icon name="menu-outline" class="header_toggle" id="toggle-menu"></ion-icon>

  </header>

  <div class="table-container">
    <h1 class="heading"></h1>
    <button class="btn" id="abre" onclick="openModal()">Add</button>
    <input type="text" class="inputsearch" id="myInput" placeholder="Pesquisar" onkeyup="myFunction()">
    <table class="table" id="financeiro">
      <thead>
        <tr>
          <th>Descrição</th>
          <th>Valor</th>
          <th>Pagamento</th>
          <th>Categoria</th>
          <th>Data</th>
          <th>Tipo</th>
          <th>Ação</th>
        </tr>
      </thead>
      <tbody class="table">
        <?php
        @include 'conectar.php';

        $sql = "select * from financa WHERE MONTH(dataent) = 4";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
          <tr>
            <td data-label = "Descrição"><?php echo $row['descricao'] ?></td data-label = "">
            <td data-label = "Valor"><?php echo $row['valor'] ?></td data-label = "">
            <td data-label = "Pagamento"><?php echo $row['pagamento'] ?></td data-label = "">
            <td data-label = "Categoria"><?php echo $row['categoria'] ?></td data-label = "">
            <td data-label = "Data"><?php echo $row['dataent'] ?></td data-label = "">
            <td data-label = "Tipo"><?php echo ($row['entradas'] == "entrada") ? '<b style="background-color: green; color: #fff; padding: 5px; border-radius: 5px;">Entrada</b>' 
            : ($row['entradas'] == "saida" ? '<b style="background-color: red; color: #fff; padding: 5px; border-radius: 5px;">Saida</b>' : '') ?></td data-label = "">
            <td data-label = "Ações">
            <a href="delete_financa.php?id_financa=<?php echo $row['id_financa'] ?>" class="deletar"><i class="fa fa-trash"></i></a>
            </td>
          </tr>
        <?php
        }
        ?>

      </tbody>
    </table>

    <!--Form Add-->
    <div class="modal-container">
      <div class="modal">
        <form action="crud_financa.php" method="post">
          <input type="text" name="descricao" placeholder="Descrição">
          <input type="text" name="valor" placeholder="Valor">
          <input type="text" name="pagamento" placeholder="Pagamento">
          <input type="text" name="categoria" placeholder="criar categoria">
          <select name="categoria">
            <option>Selecione...</option>
            <option value="Comida">Comida</option>
            <option value="Transporte">Transporte</option>
            <option value="Lazer">Lazer</option>
            <option value="Emergência">Emergência</option>
            <option value="Mercado">Mercado</option>
            <option value="Outros">Outros...</option>
          </select>
          <input type="date" name="dataent">
          <div class="divType">
            <select id="type" name="entradas">
              <option class="entrada" value="entrada">Entrada</option>
              <option class="saida" value="saida">Saída</option>
            </select>
          </div>
          <button class="btnsalvar" value="submit" name="send">Salvar</button>
          <button class="btnsalvar" type="reset">Limpar</button>
        </form>
      </div>
    </div>

    <!--SELECT EDIT
      <?php
      $id = $_GET['	id_financa'];
      $sql = "select * from financa where 	id_financa = $id limit 1";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);
      ?>-->

    <!--Form Edit-->
    <div class="modal-container editar">
      <div class="modal">
        <form action="">
          <input type="text" name="descricao" value="<?php echo $row['name'] ?>">
          <input type="text" name="valor" value="<?php echo $row['valor'] ?>">
          <input type="text" name="pagamento" value="<?php echo $row['pagamento'] ?>">
          <input type="text" name="categoria" value="<?php echo $row['categoria'] ?>">
          <input type="date" name="dataent" value="<?php echo $row['dataent'] ?>">
          <div class="divType">
            <select id="type" name="ent_saida" value="ent_saida">
              <option class="entrada">Entrada</option>
              <option class="saida">Saída</option>
            </select>
          </div>
          <button class="btnsalvar" value="submit">Salvar</button>
          <button onclick="history.go(-1)" class="btnVoltar">Voltar</button>
        </form>
      </div>
    </div>
  </div>

  <!--imprimir-->
  <!--<a onclick="window.print()" class="print"><i class="fa fa-print" aria-hidden="true"></i></a>-->

  <!--Excel table-->
  <div id="live_data">
    <form action="excel.php" method="post">
      <!--<input type="submit" name="export_excel" value="Excel">-->
      <button type="submit" class="print" name="export_excel"><i class="fa fa-print" aria-hidden="true"></i></button>
    </form>
  </div>

  <section class="ends">
    <p>Desenvolvido por Isaque Sene © 2022</p>
  </section>


<!--Open Modal-->
<script>
  var abre = document.getElementById("abre").value;
    const modal = document.querySelector('.modal-container')

    function editItem(index){
    openModal(true, index)
}

function openModal(){

  modal.classList.add('active')
  
  
  modal.onclick = e =>{
  if(e.target.className.indexOf('modal-container') !== -1){
      modal.classList.remove('active')
    }
  }
}
</script>


<!--Search-->
<script type="text/javascript">
	function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("financeiro");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[3];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>


  <!--<script>
   var btn = $('#button');

$(window).scroll(function(){
  if($(window).scrollTop() > 300){
    btn.addClass('show');
  }else{
    btn.removeClass('show');
  }
});

btn.on('click', function(e){
  e.preventDefault();
  $('html, body').animate({scrollTop:0}, '300');
}); 
</script>-->

  <!--navbar script-->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>


  <script src="js/script.js"></script>
  <script src="js/scroll.js"></script>

  <!-- <script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-app.js"></script>
    
    <script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-database.js"></script>-->

  <!--<script>
    // Your web app's Firebase configuration
    const firebaseConfig = {
      apiKey: "AIzaSyBt88WuddD5lW9whXSPtIjPjCx2zYQ6y1U",
      authDomain: "financeiro-317a4.firebaseapp.com",
      databaseURL: "https://financeiro-317a4-default-rtdb.firebaseio.com",
      projectId: "financeiro-317a4",
      storageBucket: "financeiro-317a4.appspot.com",
      messagingSenderId: "131072115589",
      appId: "1:131072115589:web:bcdcaae05fbb4f342abaec"
    };
  

    

    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);
  </script>
  <script src="js/main.js"></script>-->

</body>

</html>