<?php 

    include "conn/conection.php";

    $cliente_id = $conn->query("SELECT LAST_INSERT_ID() FROM clientes;");


?>