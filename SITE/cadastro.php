<?php 
    include "conn/conection.php";

     // Consulta para obter os gêneros
     $resultadoGeneros = $conn->query("SELECT * FROM genero");

     // Consulta para obter tipos de telefone
     $resultadoTelefone = $conn->query("SELECT * FROM telefone_tipo");

    // Verifica se o formulário foi enviado
    if ($_POST) {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = md5($_POST['senha']);
        $cpf = $_POST['cpf'];
        $data_nasc = $_POST['data_nasc'];
        $genero_id = $_POST['genero_id'];
        $telefone = $_POST['telefone'];
        $tipo_telefone = $_POST['tipo_telefone'];
    
        // Insere o cliente no banco de dados
        $inserindoCliente = $conn->query("INSERT INTO clientes (nome, email, senha, cpf, data_nasc, genero_id) VALUES ('$nome', '$email', '$senha', '$cpf', '$data_nasc', $genero_id)");
    
        if ($inserindoCliente) {
            // Recupera o último ID inserido
            $cliente_id = $conn->insert_id; // Usa insert_id para pegar o último ID inserido
    
            // Insere o telefone relacionado ao cliente
            $inserindoCelular = $conn->query("INSERT INTO telefone_cliente (numero, cliente_id, telefone_tipo_id) VALUES ('$telefone', $cliente_id, $tipo_telefone)");
    
            if ($inserindoCelular) {
                echo "<script>alert('Cadastro realizado com sucesso.');</script>";
                header('Location: cadastroEndereco.php');
                exit();
            } else {
                echo "<script>alert('Erro ao cadastrar o telefone: " . $conn->error . "');</script>";
            }
        } else {
            echo "<script>alert('Erro ao realizar o cadastro do cliente: " . $conn->error . "');</script>";
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
    <link rel="stylesheet" href="css/cadastroStyle.css">
    <link rel="icon" href="images/IconSemNome.png" type="image/png">
    <title>PSICOMIND - CADASTRO</title>
</head>
<body>

    <?php include "menu.php"?>

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="row border rounded-5 p-4 bg-white shadow box-area">
            <div class="col-md-12 right-box">
                <div class="header-text mb-4">
                    <h1>Crie sua Conta</h1>
                    <p>Preencha os campos abaixo para se cadastrar.</p>
                </div>
                <form action="cadastro.php" method="POST">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <input type="text" id="nome" name="nome" class="form-control form-control-lg bg-light fs-6" placeholder="Nome Completo">
                        </div>
                        <div class="col-md-6">
                            <input type="email" id="email" name="email" class="form-control form-control-lg bg-light fs-6" placeholder="Email">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <input type="password" id="senha" name="senha" class="form-control form-control-lg bg-light fs-6" placeholder="Senha">
                        </div>
                        <div class="col-md-6">
                            <input type="text" id="cpf" name="cpf" class="form-control form-control-lg bg-light fs-6" placeholder="CPF">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <input type="date" id="data_nasc" name="data_nasc" class="form-control form-control-lg bg-light fs-6">
                        </div>
                        <div class="col-md-6">
                            <select id="genero_id" name="genero_id" class="form-select form-select-lg bg-light fs-6">
                                <option selected disabled>Selecione o Gênero</option>
                                <?php while ($genero = $resultadoGeneros->fetch_assoc()) { ?>
                                    <option value="<?php echo $genero['id']; ?>"><?php echo $genero['genero']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <input type="text" id="telefone" name="telefone" class="form-control form-control-lg bg-light fs-6" placeholder="Telefone">
                        </div>
                        <div class="col-md-6">
                            <select id="tipo_telefone" name="tipo_telefone" class="form-select form-select-lg bg-light fs-6">
                                <option selected disabled>Tipo de Telefone</option>
                                <?php while($tipoTelefone = $resultadoTelefone->fetch_assoc()){?>
                                    <option value="<?php echo $tipoTelefone['id']; ?>"><?php echo $tipoTelefone['tipo'];?></option>
                                    <?php };?>

                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <input type="submit" value="Continuar cadastro" class="btn btn-primary">
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
