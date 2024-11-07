<?php
    $orderDefault='attivita.inizio';
    
    function changeOrderSql($orderDefault='attivita.inizio'){

        $sql= <<<SQL
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
                    ORDER BY $orderDefault;
                    SQL;
        return $sql;
    }

    
?>