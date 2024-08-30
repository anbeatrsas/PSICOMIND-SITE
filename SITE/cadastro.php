<?php
    include "conn/conection.php";
 
    // Consulta para obter os gêneros
    $resultadoGeneros = $conn->query("SELECT * FROM genero");
 
    // Consulta para obter tipos de telefone
    $resultadoTelefone = $conn->query("SELECT * FROM telefone_tipo");
 
    // Consulta para obter tipos de endereço
    $resultadoTipoEndereco = $conn->query("SELECT * FROM tipo_endereco");
 
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
        $cep = $_POST['cep'];
        $rua = $_POST['rua'];
        $numero = $_POST['numero'];
        $bairro = $_POST['bairro'];
        $cidade = $_POST['cidade'];
        $uf = $_POST['uf'];
        $tipo_endereco_id = $_POST['tipo_endereco_id'];
   
        // Insere o cliente no banco de dados
        $inserindoCliente = $conn->query("INSERT INTO clientes (nome, email, senha, cpf, data_nasc, genero_id) VALUES ('$nome', '$email', '$senha', '$cpf', '$data_nasc', $genero_id)");
   
        if ($inserindoCliente) {
            // Recupera o último ID inserido
            $cliente_id = $conn->insert_id; // Usa insert_id para pegar o último ID inserido
   
            // Insere o telefone relacionado ao cliente
            $inserindoCelular = $conn->query("INSERT INTO telefone_cliente (numero, cliente_id, telefone_tipo_id) VALUES ('$telefone', $cliente_id, $tipo_telefone)");
   
            if ($inserindoCelular) {
                // Insere o endereço relacionado ao cliente
                $inserindoEndereco = $conn->query("INSERT INTO enderecos (cliente_id, cep, rua, numero, bairro, cidade, uf, tipo_endereco_id ) VALUES ($cliente_id, '$cep', '$rua', '$numero', '$bairro', '$cidade', '$uf', $tipo_endereco_id)");
   
                if ($inserindoEndereco) {
                    echo "<script>alert('Cadastro realizado com sucesso.');</script>";
                    header('Location: login.php');
                    exit();
                } else {
                    echo "<script>alert('Erro ao cadastrar o endereço: " . $conn->error . "');</script>";
                }
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
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
                <form action="cadastro.php" method="POST" id="form">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <input type="text" id="nome" name="nome" required class="form-control form-control-lg bg-light fs-6" placeholder="Nome Completo">
                        </div>
                        <div class="col-md-4">
                            <input type="email" id="email" name="email" required class="form-control form-control-lg bg-light fs-6" placeholder="Email">
                        </div>
                        <div class="col-md-4">
                            <input type="password" id="senha" name="senha" required class="form-control form-control-lg bg-light fs-6" placeholder="Senha">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <input type="text" id="cpf" name="cpf" required maxlength="11" class="form-control form-control-lg bg-light fs-6" placeholder="CPF">
                        </div>
                        <div class="col-md-4">
                            <input type="date" id="data_nasc" required name="data_nasc" class="form-control form-control-lg bg-light fs-6">
                        </div>
                        <div class="col-md-4">
                            <select id="genero_id" name="genero_id" required class="form-select form-select-lg bg-light fs-6">
                                <option selected disabled>Selecione o Gênero</option>
                                <?php while ($genero = $resultadoGeneros->fetch_assoc()) { ?>
                                    <option value="<?php echo $genero['id']; ?>"><?php echo $genero['genero']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <input type="text" id="telefone" name="telefone" maxlength="11" required class="form-control form-control-lg bg-light fs-6" placeholder="Telefone">
                        </div>
                        <div class="col-md-4">
                            <select id="tipo_telefone" name="tipo_telefone" required class="form-select form-select-lg bg-light fs-6">
                                <option selected disabled >Tipo de Telefone</option>
                                <?php while($tipoTelefone = $resultadoTelefone->fetch_assoc()){?>
                                    <option value="<?php echo $tipoTelefone['id']; ?>"><?php echo $tipoTelefone['tipo'];?></option>
                                <?php }?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <input type="text" id="cep" name="cep" required class="form-control form-control-lg bg-light fs-6" placeholder="CEP">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <input type="text" id="rua" name="rua" required class="form-control form-control-lg bg-light fs-6" placeholder="Rua">
                        </div>
                        <div class="col-md-4">
                            <input type="text" id="numero" name="numero" required class="form-control form-control-lg bg-light fs-6" placeholder="Número">
                        </div>
                        <div class="col-md-4">
                            <input type="text" id="bairro" name="bairro" required class="form-control form-control-lg bg-light fs-6" placeholder="Bairro">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <input type="text" id="cidade" name="cidade" required class="form-control form-control-lg bg-light fs-6" placeholder="Cidade">
                        </div>
                        <div class="col-md-4">
                            <input type="text" id="uf" name="uf" required class="form-control form-control-lg bg-light fs-6" placeholder="UF">
                        </div>
                        <div class="col-md-4">
                        <select id="tipo_endereco_id" name="tipo_endereco_id" required class="form-select form-select-lg bg-light fs-6">
                                <option selected disabled>Tipo de Endereço</option>
                                <?php while ($tipoEndereco = $resultadoTipoEndereco->fetch_assoc()) { ?>
                                    <option value="<?php echo $tipoEndereco['id']; ?>"><?php echo $tipoEndereco['nome']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <input type="submit" value="Finalizar cadastro" class="btn btn-primary">
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