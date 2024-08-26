<?php 

    session_name('PSICOMIND');
    session_start();
    session_destroy();
    header('location: ../index.php');

    exit;

?>