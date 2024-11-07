<?php
  require_once('config.php');
  require_once('library.php');
  require_once('sql.php');
?>

<!doctype html>
<html lang="it">

    <head>
    <title>Profilo cliente</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    </head>

    <body>
        <header>
        <?php include "navbar-header.php"; ?>
            <div class="container mt-3 mb-3 border">
                <p class="h1 text-center" >PROFILO CLIENTE </p>
            </div>
        </header>

        <main>
        <div class="container mt-3 mb-3 border">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a class="btn btn-primary me-md-2" role="button" href="#">Aggiungi progetto</a>
                <a class="btn btn-primary" type="button">Aggiungi attività</a>
                <a class="btn btn-primary" type="button">Modifica cliente</a>
                <a class="btn btn-danger" type="button">Elimina cliente</a>
            </div>

            <div class="container mt-3 mb-3 border">
                <div class="row">
                    <dt class="col"><b>Nome</b></dt>
                    <dd class="col">Alessandra</dd>
                    <dt class="col"><b>Cognome</b></dt>
                    <dd class="col">Diaspro</dd>
                </div>
                <div class="row mt-3 mb-3">
                    <dt class="col"><b>Telefono</b></dt>
                    <dd class="col">076 77005511</dd>
                    <dt class="col"><b>Email</b></dt>
                    <dd class="col">ale@gmail.com</dd>
                </div>

            </div>
            <div class="container mt-3 mb-3 border">
                <div class="row">
                    <dt class="col"><b>Progetto</b></dt>
                    <dd class="col">Nome progetto</dd>
                    <dt class="col"><b>Attività</b></dt>
                    <dd class="col">Nome attività</dd>
                    <dt class="col"><b>Inizio</b></dt>
                    <dd class="col">01-01-2022</dd>
                    <dt class="col"><b>Risorsa</b></dt>
                    <dd class="col">Giuseppe</dd>
                </div>
                </div>
            </div>
        </main>

        <footer>
            <?php include "navbar-footer.php"; ?>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    </body>

</html>

