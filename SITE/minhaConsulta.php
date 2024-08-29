<?php
include "conn/conection.php";
include "admin/acesso_com.php";

// Obtendo o ID do cliente da sessão
$cliente_id = $_SESSION['cliente_id'] ?? 0;

// Buscando as consultas do usuário
$consultas = $conn->query("SELECT * FROM vw_consulta_informacoes_cliente WHERE cliente_id = $cliente_id and status_consulta != 'Cancelada'");

// Função para cancelar consulta
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['consulta_id'])) {
    $consulta_id = intval($_POST['consulta_id']);
    if ($consulta_id > 0) {
        $sql = "UPDATE consultas SET status_consulta = 'Cancelada' WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $consulta_id);
        if ($stmt->execute()) {
            $message = "Consulta cancelada com sucesso!";
        } else {
            $message = "Erro ao cancelar a consulta.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/areaCliente.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="icon" href="images/IconSemNome.png" type="image/png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/fontawesome.min.css">
    <script src="https://kit.fontawesome.com/1a91a6d3b2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <title>PSICOMIND - Minhas Consultas</title>
</head>
<body>

<section id="nav-bar">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Alterna navegação">
        <i class="fa-solid fa-bars"></i>
    </button>
    <a class="navbar-brand" href="areaCliente.php"><img src="images/back.png" style="width:35px;"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Alterna navegação">
                <i class="fa-solid fa-bars"></i>
            </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <button type="button" class="greeting-button disabled">
                    Olá, <?php echo ($_SESSION['nome_cliente']); ?>!
                </button>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="admin/logout.php">
                    <i class="fa-solid fa-sign-out-alt"></i>
                    <span class="sr-only">Logout</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
</section>

<div class="container mt-5">
    <h1 class="mb-4">Minhas Consultas</h1>
    <?php if (isset($message)) { ?>
        <div class="alert alert-info">
            <?php echo $message; ?>
        </div>
    <?php } ?>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Profissional</th>
                    <th>Tipo de Consulta</th>
                    <th>Data</th>
                    <th>Horário</th>
                    <th>Status</th>
                    <th>Preço</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($consultas->num_rows > 0) { ?>
                    <?php while ($consulta = $consultas->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $consulta['nome_cliente']; ?></td>
                            <td><?php echo $consulta['nome_profissional']; ?></td>
                            <td><?php echo $consulta['tipo_agendamento']?></td>
                            <td><?php echo $consulta['dia_escala']?></td>
                            <td><?php echo $consulta['horario_escala']?></td>
                            <td><?php echo $consulta['status_consulta']?></td>
                            <td><?php echo $consulta['preco']?></td>
                            <td>
                                <?php if ($consulta['status_consulta'] !== 'Cancelada') { ?>
                                    <form method="post" action="">
                                        <input type="hidden" name="consulta_id" value="<?php echo $consulta['consulta_id']; ?>">
                                        <button type="submit" class="btn btn-danger">Cancelar</button>
                                    </form>
                                <?php } else { ?>
                                    <span class="text-muted">Cancelada</span>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr>
                        <td colspan="8">Nenhuma consulta agendada.</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
