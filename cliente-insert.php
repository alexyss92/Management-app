<?php
    require_once('config.php');
    require_once('library.php');

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

        $sql = "INSERT INTO cliente (nome, cognome, azienda, telefono, email, indirizzo, cap, localita, provincia, nazione, note) VALUES ((:nome), (:cognome), (:azienda), (:telefono), (:email), (:indirizzo), (:cap), (:localita), (:provincia), (:nazione), (:note));" ;

        $stmt = $conn->prepare($sql);

        $args = [
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


    header("location:clienti.php?msg=Cliente%20modificato%20correttamente.");

?>