<?php 
    include "conn/conection.php";

    // Consulta para obter tipos de endereço
    $resultadoTipoEndereco = $conn->query("SELECT * FROM tipo_endereco");

    // Verifica se o formulário foi enviado
    if ($_POST) {
        $cep = $_POST['cep'];
        $rua = $_POST['rua'];
        $numero = $_POST['numero'];
        $bairro = $_POST['bairro'];
        $cidade = $_POST['cidade'];
        $uf = $_POST['uf'];
        $tipo_endereco_id = $_POST['tipo_endereco_id'];

        // Insere o endereço no banco de dados
        $inserindoEndereco = $conn->query("INSERT INTO enderecos (cep, rua, numero, bairro, cidade, uf, tipo_endereco_id) VALUES ('$cep', '$rua', '$numero', '$bairro', '$cidade', '$uf', $tipo_endereco_id)");

        if ($inserindoEndereco) {
            echo "<script>alert('Endereço cadastrado com sucesso.');</script>";
            header('Location: proxima_pagina.php'); // Redireciona para a próxima página
            exit();
        } else {
            echo "<script>alert('Erro ao cadastrar o endereço: " . $conn->error . "');</script>";
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
    <title>PSICOMIND - CADASTRO DE ENDEREÇO</title>
</head>
<body>

    <?php include "menu.php"?>

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="row border rounded-5 p-4 bg-white shadow box-area">
            <div class="col-md-12 right-box">
                <div class="header-text mb-4">
                    <h1>Cadastre seu Endereço</h1>
                    <p>Preencha os campos abaixo para cadastrar o endereço.</p>
                </div>
                <form action="cadastroEndereco.php" method="POST">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <input type="text" id="cep" name="cep" class="form-control form-control-lg bg-light fs-6" placeholder="CEP">
                        </div>
                        <div class="col-md-6">
                            <input type="text" id="rua" name="rua" class="form-control form-control-lg bg-light fs-6" placeholder="Rua">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <input type="text" id="numero" name="numero" class="form-control form-control-lg bg-light fs-6" placeholder="Número">
                        </div>
                        <div class="col-md-6">
                            <input type="text" id="bairro" name="bairro" class="form-control form-control-lg bg-light fs-6" placeholder="Bairro">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <input type="text" id="cidade" name="cidade" class="form-control form-control-lg bg-light fs-6" placeholder="Cidade">
                        </div>
                        <div class="col-md-6">
                            <input type="text" id="uf" name="uf" class="form-control form-control-lg bg-light fs-6" placeholder="UF">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <select id="tipo_endereco_id" name="tipo_endereco_id" class="form-select form-select-lg bg-light fs-6">
                                <option selected disabled>Tipo de Endereço</option>
                                <?php while ($tipoEndereco = $resultadoTipoEndereco->fetch_assoc()) { ?>
                                    <option value="<?php echo $tipoEndereco['id']; ?>"><?php echo $tipoEndereco['tipo']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <input type="submit" value="Salvar Endereço" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
