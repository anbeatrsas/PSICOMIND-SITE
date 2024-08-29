<?php 

    require 'mail.php';

    $mensagem = "<p>Este é um teste de email</p>";

    EnviarEmail("anabeatrizalmeida004@gmail.com", "anabeatrizalmeida004@gmail.com", "Mensagem de Teste", $mensagem)

?>