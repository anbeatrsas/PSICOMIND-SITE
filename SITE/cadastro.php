<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="css/cadastroStyle.css">
    <link rel="icon" href="images/IconSemNome.png" type="image/png">
    <title>PSICOMIND - CADASTRO</title>
    
</head>
<body>

    <?php include "menu.php"?>

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="row border rounded-5 p-4 bg-white shadow box-area">
            
            <div class="col-md-12 right-box">
                <div class="header-text mb-4 ">
                    <h1>Crie sua Conta</h1>
                    <p>Preencha os campos abaixo para se cadastrar.</p>
                </div>
                <form action="cadastro.php" method="POST">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <input type="text" class="form-control form-control-lg bg-light fs-6" placeholder="Nome Completo">
                        </div>
                        <div class="col-md-6">
                            <input type="email" class="form-control form-control-lg bg-light fs-6" placeholder="Email">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <input type="password" class="form-control form-control-lg bg-light fs-6" placeholder="Senha">
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control form-control-lg bg-light fs-6" placeholder="CPF">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <input type="date" class="form-control form-control-lg bg-light fs-6">
                        </div>
                        <div class="col-md-6">
                            <select class="form-select form-select-lg bg-light fs-6">
                                <option selected disabled>Selecione o Gênero</option>
                                <option value="1">Masculino</option>
                                <option value="2">Feminino</option>
                                <option value="3">Outro</option>
                                <option value="4">Prefiro não informar</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                    <input type="submit" value="Cadastrar" class="btn btn-primary">
                    </div>
                    <div class="text-center">
                        <small>Já possui uma conta? <a href="login.php">Faça login aqui!</a></small>
                    </div>
                </form>
            </div>

        </div>
    </div>

</body>
</html>
