<?php 

    include "conn/conection.php";
    include "admin/acesso_com.php";

    if($_GET){
        $id_form = $_GET['id']; // pegando o id via get para armazena-lo e usa-lo para preencher os campos
    }else{
        $id_form = 0;
    }


?>



<form action="consulta.php?id=<?php echo $id_form;?>"></form>