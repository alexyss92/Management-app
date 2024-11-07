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
      <div class="container mt-3 mb-3 border">
        <div class="row">
          <div class="col-12 p-3 border">
            <h1 class="display-6">Riepilogo:</h1>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-4 p-3 border">Totale clienti: <?php echo getRecordCount('cliente'); ?></div>
          <div class="col-sm-4 p-3 border">Totale progetti: <?php echo getRecordCount('progetto'); ?></div>
          <div class="col-sm-4 p-3 border">Totale attività: <?php echo getRecordCount('attivita'); ?></div>
        </div>
    </div>

    <div class="container mt-3 mb-3 border">
      <p class="h1 text-center" >
        <?php echo getDateLocale('eee d MMMM y'); ?>
      </p>
    </div>

    <div class="container mt-3 mb-3 border">
      <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Telefono</th>
                    <th>Email</th>
                    <th>Progetto</th>
                    <th>Attività</th>
                    <th>Inizio</th>
                    <th>Risorsa</th>
                </tr>
            </thead>
            <tbody>
              <?php
                try {
                  $sql = <<<SQL
                  SELECT
                    cliente.id_cliente AS id_cliente,
                    cliente.nome AS cliente_nome,
                    cognome,
                    telefono,
                    email,
                    progetto.nome AS progetto_nome,
                    attivita.nome AS attivita_nome,
                    attivita.inizio AS attivita_inizio,
                    risorsa.nome AS risorsa_nome
                  FROM
                      cliente
                  JOIN progetto ON cliente.id_cliente = progetto.id_cliente
                  JOIN attivita ON progetto.id_progetto = attivita.id_progetto
                  JOIN attivita_risorsa ON attivita.id_attivita = attivita_risorsa.id_attivita
                  JOIN risorsa ON attivita_risorsa.id_risorsa = risorsa.id_risorsa
                  WHERE attivita.inizio >= CURDATE()
                  ORDER BY attivita.inizio;
                  SQL;

                  $stmt = $conn->prepare($sql);
                  $stmt->execute();

                  $lastClienteId = 0;

                  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $clienteId       = $row['id_cliente'];
                    $clienteNome     = $row['cliente_nome'];
                    $clienteCognome  = $row['cognome'];
                    $clienteTelefono = $row['telefono'];
                    $clienteEmail    = $row['email'];
                    $progettoNome    = $row['progetto_nome'];
                    $attivitaNome    = $row['attivita_nome'];
                    $attivitaInizio  = $row['attivita_inizio'];
                    $risorsaNome     = $row['risorsa_nome'];

                    $linkCliente = 'cliente-form.php?op=update&id=' . $clienteId;

                    echo '<tr>';
                    if ($clienteId != $lastClienteId) {  
                      echo '  <td><a href="' . $linkCliente . '">' . $clienteNome     . ' ' . $clienteCognome . '</a></td>';
                      echo '  <td>' . $clienteTelefono . '</td>';
                      echo '  <td>' . $clienteEmail    . '</td>';
                    } else {
                      echo '  <td> </td>';
                      echo '  <td> </td>';
                      echo '  <td> </td>';
                    }
                    echo '  <td>' . $progettoNome    . '</td>';
                    echo '  <td>' . $attivitaNome    . '</td>';
                    echo '  <td>' . $attivitaInizio    . '</td>';
                    echo '  <td>' . $risorsaNome    . '</td>';
                    echo '</tr>';

                    $lastClienteId = $clienteId;
                  }
                } catch (PDOException $err) {
                  echo $err;
                }
              ?>
            </tbody>
        </table>
      </div>  
    </div>
   
  </main>
  
  <?php
    $conn = null;
  ?>

  <footer>
    <?php include "navbar-footer.php"; ?>
  </footer>
 
  <!-- Bootstrap JavaScript Libraries -->    
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>