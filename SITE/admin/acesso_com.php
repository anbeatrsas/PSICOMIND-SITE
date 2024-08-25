<?php 

    session_name('PSICOMIND');
    //abrindo uma sessão
    if(!isset($_SESSION)){ // se nao tiver nenhum valor atribuido a sessão

        session_start();

    }

    // Seguranca digital
    //verificar se o usuário esta logado

    if(!isset($_SESSION['login_cliente'])){
        // se não existir, redirecionamos a sessão por seguranca
        header('location: login.php');
        exit;            
    }

    $nome_sessao = session_name();
    if(!isset($_SESSION['nome_sessao']) or ($_SESSION['nome_sessao']!=$nome_sessao)){ 
        session_destroy();
        header('location: login.php');
    }


?>