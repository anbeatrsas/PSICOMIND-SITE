<?php
include "conn/conection.php";
include "admin/acesso_com.php";

// Obtendo o ID do cliente da sessão
$cliente_id = $_SESSION['cliente_id'] ?? 0;

// Buscando as consultas do usuário
$consultas = $conn->query("select * from consultas");

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="icon" href="images/IconSemNome.png" type="image/png">
    <title>PSICOMIND - Minhas Consultas</title>
</head>
<body>

    <?php include "menu.php" ?>

    <div class="container mt-5">
        <h1 class="mb-4">Minhas Consultas</h1>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Profissional</th>
                        <th>Tipo de Consulta</th>
                        <th>Data</th>
                        <th>Horário</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($consultas->num_rows > 0) { ?>
                        <?php while ($consulta = $consultas->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $consulta['id']; ?></td>
                                <td><?php echo $consulta['profissional']; ?></td>
                                <td><?php echo $consulta['tipo_agendamento']; ?></td>
                                <td><?php echo date('d/m/Y', strtotime($consulta['dia'])); ?></td>
                                <td><?php echo $consulta['horario']; ?></td>
                                <td><?php echo $consulta['status'] == 1 ? 'Agendado' : 'Concluído'; ?></td>
                            </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <tr>
                            <td colspan="6">Nenhuma consulta agendada.</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
