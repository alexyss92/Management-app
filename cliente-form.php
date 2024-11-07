<?php
    require_once('config.php');
    require_once('library.php');

    $op = get('op', 'view');
    $id = get('id', 0);
?>

<!doctype html>
<html lang="it">

    <head>
        <?php 
            if ($op == 'view') { 
                echo '<title>Cliente - visualizzazione</title>';
            } elseif ($op == 'update') {
                echo '<title>Cliente - modifica</title>';
            } elseif ($op == 'insert') {
                echo '<title>Cliente - inserimento</title>';
            } else {
                echo '<title>Cliente - ND</title>';
            }
        ?>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    </head>

    <body>
        <header>
            <?php include "navbar-header.php"; ?>
        </header>

        <main>

            <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                </symbol>
                <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                </symbol>
                <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                </symbol>
            </svg>


            <?php 
                $msg = get('msg', '');
                if ($msg != '') {
            ?>
            <div class="container pt-2">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                    <?php echo $msg; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            <?php } ?>
            
            <?php 
                if (($op == 'update' || $op == 'view') && $id != 0) {
                    try {
                        $conn = new PDO($connString, $dbUser, $dbPassword);
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        $sql = "SELECT * FROM cliente WHERE id_cliente=" . $id;

                        $stmt = $conn->prepare($sql);
                        $result = $stmt->execute();

                        if ($result) {
                            $record = $stmt->fetch(PDO::FETCH_ASSOC);

                            $id_cliente = $record['id_cliente'];
                            $nome       = $record['nome'];
                            $cognome    = $record['cognome'];
                            $azienda    = $record['azienda'];
                            $telefono   = $record['telefono'];
                            $email      = $record['email'];
                            $indirizzo  = $record['indirizzo'];
                            $cap        = $record['cap'];
                            $localita   = $record['localita'];
                            $provincia  = $record['provincia'];
                            $nazione    = $record['nazione'];
                            $note       = $record['note'];
                        }

                        $conn = null;

                    } catch (PDOException $err) {
                        echo $err->getMessage();
                    } 
                }elseif ($op == 'insert') {
                        try {
                            $conn = new PDO($connString, $dbUser, $dbPassword);
                            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            $nome      = '';
                            $cognome   = '';
                            $azienda   = '';
                            $telefono  = '';
                            $email     = '';
                            $indirizzo = '';
                            $cap       = '';
                            $localita  = '';
                            $provincia = '';
                            $nazione   = '';
                            $note      = '';
                        } catch (PDOException $err) {
                            echo $err->getMessage();
                        } 
                }
            ?>



            <div class="container mt-4 mb-4 pt-4 pb-4 ps-4 pe-4">
                <?php 
                    if ($op == 'view') { 
                        echo '<form class="row g-3">';
                    } elseif ($op == 'update') {
                        echo '<form action="cliente-update.php" method="post" class="row g-3">';
                        echo '<input type="hidden" id="id_cliente" name="id_cliente" value="' . $id_cliente . '">';
                    } elseif ($op == 'insert') {
                        echo '<form action="cliente-insert.php" method="post" class="row g-3">';
                    } else {
                        echo '<form class="row g-3">';
                    }    
                ?>
                    <div class="col-md-3">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome" <?php setValue($nome); ?>>
                    </div>
                    <div class="col-md-3">
                        <label for="cognome" class="form-label">Cognome</label>
                        <input type="text" class="form-control" id="cognome" name="cognome" <?php setValue($cognome); ?>>
                    </div>
                    <div class="col-md-6">
                        <label for="azienda" class="form-label">Azienda</label>
                        <input type="text" class="form-control" id="azienda" name="azienda" <?php setValue($azienda); ?>>
                    </div>
                    <div class="col-6">
                        <label for="telefono" class="form-label">Telefono</label>
                        <input type="text" class="form-control" id="telefono" name="telefono" <?php setValue($telefono); ?>>
                    </div>
                    <div class="col-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" <?php setValue($email); ?>>
                    </div>
                    <div class="col-md-4">
                        <label for="indirizzo" class="form-label">Indirizzo</label>
                        <input type="text" class="form-control" id="indirizzo" name="indirizzo" <?php setValue($indirizzo); ?>>
                    </div>
                    <div class="col-md-2">
                        <label for="cap" class="form-label">Cap</label>
                        <input type="text" class="form-control" id="cap" name="cap"<?php setValue($cap); ?>>
                    </div>
                    <div class="col-md-3">
                        <label for="localita" class="form-label">Località</label>
                        <input type="text" class="form-control" id="localita" name="localita" <?php setValue($localita); ?>>
                    </div>
                    <div class="col-md-1">
                        <label for="provincia" class="form-label">Provincia</label>
                        <input type="text" class="form-control" id="provincia" name="pronvicia" <?php setValue($provincia); ?>>
                    </div>
                    <div class="col-md-2">
                        <label for="nazione" class="form-label">Nazione</label>
                        <input type="text" class="form-control" id="nazione" name="nazione" <?php setValue($nazione); ?>>
                    </div>
                    <div class="col-md-12">
                        <label for="note" class="form-label">Note</label>
                        <textarea class="form-control" style="height:200px" id="note" name="note" <?php setDisabled(); ?>><?php setTextArea($note); ?></textarea>
                    </div>
                    
                    <?php if ($op == 'update' || $op == 'insert') { ?>
                        <div class="d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-outline-primary btn-lg ">OK</button>
                            &nbsp;&nbsp;&nbsp;
                            <button type="reset" class="btn btn-outline-danger btn-lg ">Annulla</button>
                        </div>
                    <?php } ?>
                </form>
            </div>

        </main>

        <footer>
            <?php include "navbar-footer.php"; ?>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    </body>

</html>

