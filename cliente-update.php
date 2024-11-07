<?php
    require_once('config.php');
    require_once('library.php');


    $id_cliente = post('id_cliente', 0);
    $nome       = post('nome', '');
    $cognome    = post('cognome', '');
    $azienda    = post('azienda', '');
    $telefono   = post('telefono', '');
    $email      = post('email', '');
    $indirizzo  = post('indirizzo', '');
    $cap        = post('cap', '');
    $localita   = post('localita', '');
    $provincia  = post('provincia', '');
    $nazione    = post('nazione', '');
    $note       = post('note', '');


    try {
        $conn = new PDO($connString, $dbUser, $dbPassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "UPDATE cliente SET nome = (:nome), cognome = (:cognome), azienda = (:azienda), telefono = (:telefono), email = (:email), indirizzo = (:indirizzo), cap = (:cap), localita = (:localita), provincia = (:provincia), nazione = (:nazione), note = (:note) WHERE id_cliente = (:id_cliente);" ;

        $stmt = $conn->prepare($sql);

        $args = [
            'id_cliente'    => $id_cliente,
            'nome'          => $nome,
            'cognome'       => $cognome,
            'azienda'       => $azienda,
            'telefono'      => $telefono,
            'email'         => $email,
            'indirizzo'     => $indirizzo,
            'cap'           => $cap,
            'localita'      => $localita,
            'provincia'     => $provincia,
            'nazione'       => $nazione,
            'note'          => $note
        ];

        $result = $stmt->execute($args);

        $conn = null;

    } catch (PDOException $err) {
        echo $err->getMessage();
    }


    header("location:cliente-form.php?op=update&id=$id_cliente&msg=Cliente%20$nome%20$cognome%20modificato%20correttamente.");

?>