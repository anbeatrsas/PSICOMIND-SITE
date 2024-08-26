<?php 

    include "conn/conection.php";
    session_name('PSICOMIND');
    session_start();

    // verificacao de login
    if($_POST){
        
        $email = $_POST['email'];
        $senha = md5($_POST['senha']);
        $login = $conn->query("SELECT * FROM clientes WHERE email = '$email' and senha = '$senha'; ");
        $rowLogin = $login->fetch_assoc(); // transformando em um array
        $numRow = $login->num_rows; // contando o numero de linhas


        if($numRow>0){

            // guardando informacoes do cliente na sessao

            $_SESSION['login_cliente'] = $email;
            $_SESSION['nome_cliente'] = $rowLogin['nome'];
            $_SESSION['cpf'] = $rowLogin['CPF'];
            $_SESSION['cliente_id'] = $rowLogin['id'];
            $_SESSION['nome_sessao']=session_name();

            // redirecionando cliente ao efetuar login
            header('location: areaCliente.php');
            
        }else{
            echo"<script>alert('Email/CPF ou senha inválidos.')</script>";
        }
    }

?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="css/loginStyle.css">
    <link rel="icon" href="images/IconSemNome.png" type="image/png">
    <title>PSICOMIND - LOGIN</title>
</head>
<body>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/loginStyle.css">
    <link rel="icon" href="images/IconSemNome.png" type="image/png">
    <title>PSICOMIND - LOGIN</title>
</head>
<body>

    <?php include "menu.php"?>

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="row border rounded-5 p-3 bg-white shadow box-area">
            <div class="col-md-6 d-flex justify-content-center align-items-center">
                <div class="fundo-imagem rounded-4 d-flex justify-content-center align-items-center">
                    <img src="images/login.png" class="img-fluid" style="width: 100%;">
                </div>
            </div>
            <div class="col-md-6">
                <form action="login.php" method="post">
                    <div class="header-text mb-4">
                        <h1>Olá Novamente!</h1>
                        <p>Estamos felizes de ter você de volta!</p>
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" name="email" id="email" class="form-control form-control-lg bg-light fs-6" placeholder="Insira seu email">
                    </div>
                    <div class="input-group mb-1">
                        <input type="password" name="senha" id="senha" class="form-control form-control-lg bg-light fs-6" placeholder="Senha">
                    </div>
                    <div class="input-group mb-3">
                        <input type="submit" value="Login" class="btn btn-lg btn-primary w-100 fs-6">
                    </div>
                    <div class="row">
                        <small>Não possui uma conta? <a href="cadastro.php">Cadastre-se aqui!</a></small>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
