<?php
  require_once('config.php');
  require_once('library.php');
?>

<!doctype html>
<html lang="it">

<head>
  <title>Title</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/global.css">
</head>



<body>
  <header>
    <?php include "navbar-header.php"; ?>
    <div class="container mt-3 mb-3">
      <p class="h1 text-center" >LISTA UTENTI: </p>
    </div>
  </header>

  <?php 
    try {
      $conn = new PDO($connString, $dbUser, $dbPassword);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      
    } catch (PDOException $err) {
      echo $err;
    }
  ?>

  <main>
    <!-- BOTTONI GESTIONE UTENTI -->
    <div class="container mt-3 mb-3" id = "boxButtonAdd">
      <div class="d-grid gap-2 d-md-flex justify-content-md-end ">
        <a class="btn btn-primary me-md-2" href="cliente-form.php?op=insert">Nuovo</a>
      
      <!--<div class="dropdown">
        <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Ordina</button>

        <ul class="dropdown-menu">
          <li><button class="dropdown-item" onClick="changeTable('cliente.nome')" type="button">
            Nome</button></li>
          <li><button class="dropdown-item"  onClick="changeTable('cliente.cognome')" type="button"> Cognome </button></li>
          <li><button class="dropdown-item" onClick="changeTable('cliente.progetto')"> Progetto </button></li>
        </ul>

  -->
      </div>
  </div>


      <!-- FORM INSERISCI UTENTE 
      <div class="container mt-4 mb-5 border" id="buttonAddUser" style="display:none;">
        <form class="row g-3">
          <div class="col-md-6">
            <label for="inputName" class="form-label">Nome</label>
            <input type="text" class="form-control" id="inputName">
          </div>
          <div class="col-md-6">
            <label for="inputLastname" class="form-label">Cognome</label>
            <input type="text" class="form-control" id="inputLastname">
          </div>
          <div class="col-6">
            <label for="inputPhone" class="form-label">Telefono</label>
            <input type="text" class="form-control" id="inputAddress">
          </div>
          <div class="col-6">
            <label for="inputAddress2" class="form-label">Email</label>
            <input type="email" class="form-control" id="inputAddress2" placeholder="Username@gmail.com">
          </div>
          <div class="col-md-6">
            <label for="inputCity" class="form-label">Città</label>
            <input type="text" class="form-control" id="inputCity">
          </div>
          <div class="col-md-4">
            <label for="inputState" class="form-label">Animale</label>
            <select id="inputState" class="form-select">
              <option selected>Cane</option>
              <option>Gatto</option>
              <option>Coniglio</option>
            </select>
          </div>

          <div class="d-md-flex justify-content-md-end ">
            <button type="submit" class="btn btn-outline-primary btn-lg ">Salva cliente</button>
            <button type="reset" class="btn btn-outline-danger btn-lg ">Reset</button>
          </div>-->
        </form>
    </div>

    <!-- LISTA UTENTI -->
      <div class="container mt-3 mb-3">
        <div class="table-responsive">
          <table class="table table-striped table-hover">
              <thead>
                  <tr>
                      <th>Nome</th>
                      <th>Cognome</th>
                      <th>Telefono</th>
                      <th>Email</th>
                  </tr>
              </thead>
              <tbody id="tabellaSQL">
                <?php
                  try {
                    $sql = <<<SQL
                    SELECT *
                    FROM
                        cliente
                    SQL;
                    $stmt = $conn-> prepare($sql);
                    $stmt->execute();

                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                      $clienteId       = $row['id_cliente'];
                      $clienteNome     = $row['nome'];
                      $clienteCognome  = $row['cognome'];
                      $clienteTelefono = $row['telefono'];
                      $clienteEmail    = $row['email'];
                        
                      $linkCliente = 'cliente-form.php?op=view&id=' . $clienteId;

                      echo '<tr>';
                        echo '  <td><a href="' . $linkCliente . '">' . $clienteNome     . '</a></td>';
                        echo '  <td>' . $clienteCognome     . '</td>';
                        echo '  <td>' . $clienteTelefono . '</td>';
                        echo '  <td>' . $clienteEmail    . '</td>';
                      echo '</tr>';
                    }
                  } catch (PDOException $err) {
                    echo $err;
                  }
                ?>

              </tbody>
          </table>
        </div>
      </div>
    </div>
  </main>



  <footer>
    <?php include "navbar-footer.php"; ?>
  </footer>
 
  <!-- Bootstrap JavaScript Libraries -->    
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>


  <script>
    function changeTable(varSql){
      document.getElementById("tabellaSQL").innerHTML($sql = changeOrderSql(varSql));
    };

    function addUser(){
      document.getElementById("buttonAddUser").style.display = "block";
      document.getElementById("closeOperation").style.display = "block";
    }

    function close(){
      document.getElementById("closeOperation").style.display = "none";
    }
  </script>

</body>

</html>

</html>