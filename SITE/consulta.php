<?php 

    include 'conn/connect.php';
    include 'admin/acesso_com.php';

    if($_POST){

        $id = $_POST['id'];
        $cliente_id = $_SESSION['cliente_id'];
        $estado_id = $_POST['estado_id'];
        $data_reserva = $_POST['data_reserva'];
        $horario_reserva = $_POST['horario_reserva'];
        $num_pessoas = $_POST['num_pessoas'];
        $motivo_reserva = $_POST['motivo_reserva'];


        // pegando hora atual - Fonte: Hora de Codar
        $datetime = new DateTime(null, new DateTimeZone('America/Sao_Paulo'));
        $dataAtual = $datetime->format('Y-m-d');

        // consulta sql
        $verificandoCpf = $conn->query("SELECT COUNT(*) AS total 
                FROM pedido_reserva 
                WHERE cliente_id = '$cliente_id' 
                AND DATE(data_criacao) = '$dataAtual'"); 
        $rowVer = $verificandoCpf->fetch_assoc();
        $numVer = $verificandoCpf->num_rows;

        if ($rowVer['total'] >= 1) {
            echo "<script>alert('Máximo de pedidos de reservas efetuado: Apenas 1 pedido por dia.')</script>";
        } else {
            
            $inserindoPedido = $conn->query("INSERT INTO pedido_reserva (cliente_id,estado_id,data_reserva,horario_reserva,num_pessoas,motivo_reserva) VALUES ('$cliente_id',1,'$data_reserva','$horario_reserva',$num_pessoas,'$motivo_reserva')");

        }
        if(mysqli_insert_id($conn)){
            header('location:cliente/reserva_lista.php');
        }
    
        
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilo.css">
    <title>Pedido Reserva</title>
</head>
<body>

<nav class="navbar navbar-expanded-md navbar-fixed-top navbar-light navbar-inverse fixed-top">
<div class="container-fluid">
    <!-- Agrupamento para exibição Mobile -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#defaultNavbar" aria-expanded="false">
            <span class="sr-only"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a href="index.php" class="navbar-brand">
            <img src="../imagens/logochurrascopequeno.png" alt="">
        </a>
    </div>
    <!-- Fecha Agrupamento para exibição Mobile -->
    <!-- nav direita -->
    <div class="collapse navbar-collapse" id="defaultNavbar">
        <ul class="nav navbar-nav navbar-right">
            <li>
                <button type="button" class="btn btn-danger navbar-btn disabled">
                    Olá, <?php echo($_SESSION['nome_completo']); ?>!
                </button>
            </li>
            <li><a href="cliente/reserva_lista.php">RESERVAS</a></li>
            <li class="active">
                <a href="./index.php">
                    <span class="glyphicon glyphicon-home"></span>
                </a>
            </li>
            <li>
                <a href="admin/logout.php">
                    <span class="glyphicon glyphicon-log-out"></span>
                </a>
            </li>
        </ul>
    </div><!-- fecha collapse navbar-collapse -->
    <!-- Fecha nav direita -->
 
</div><!-- fecha container-fluid -->
 
</nav>

    <main class="container reserva">
        <section>
            <article>
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                        <h1 class="breadcrumb text-info text-center">Registrar Reserva</h1>
                        <div class="thumbnail">
                            <div class="alert alert-info" role="alert">
                                <form action="pedido_reserva.php" method="POST">
                                    <div class="form-group">
                                        <!-- <label for="estado_id">Estado:</label>
                                        <select name="estado_id" id="estado_id" class="form-control" required>
                                        </select> -->
                                    </div>
                                    <div class="form-group">

                                        <input type="hidden" name="id" id="id" value="<?php echo $row['id'];?>">                                   
                                        <input type="hidden" name="id" id="id" value="<?php echo $_SESSION['cliente_id'] ; ?>">
                                        <input type="hidden" name="estado_id" id="estado_id" value="<?php echo $row['estado_id']; ?>">

                                        <label for="data_reserva">Data da Reserva:</label>
                                        <input type="date" name="data_reserva" id="datePicker" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="horario_reserva">Horário:</label>
                                        <input type="time" name="horario_reserva" id="horario_reserva" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="num_pessoas">Número de Pessoas:</label>
                                        <input type="number" name="num_pessoas" id="num_pessoas" class="form-control" min="5" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="motivo_reserva">Motivo da Reserva:</label>
                                        <input type="text" name="motivo_reserva" id="motivo_reserva" class="form-control" required>
                                    </div>
                                    <p class="text-right">
                                        <input type="submit" value="Registrar Reserva" class="btn btn-primary">
                                    </p>

                                    <small>
                                    <br>
                                    <p>*<strong>Mínimo 12 horas de antecedência para fazer seu pedido</strong>. 
                                        <br/>*Permitido marcar reservas no máximo até 60 dias.
                                        <br/>*Minimo de pessoas: 5</p>
                                </small>

                                </form>
                            </div><!-- fecha alert -->
                        </div><!-- fecha thumbnail -->
                    </div><!-- fecha dimensionamento -->
                </div><!-- fecha row -->
            </article>
        </section>
    </main>

</body>

<script>
    // Aguarda o carregamento completo do DOM antes de executar o script
    document.addEventListener('DOMContentLoaded', function() {
        // Cria um objeto Date com a data e hora atuais
        var today = new Date();
        // Cria um novo objeto Date para calcular a data 60 dias a partir de hoje
        var maxDate = new Date();
        maxDate.setDate(today.getDate() + 60);

        // Função para formatar a data no formato yyyy-mm-dd
        function formatDate(date) {
            // Pega o dia do mês e garante que tem 2 dígitos
            var day = String(date.getDate()).padStart(2, '0');
            // Pega o mês (começa do 0) e garante que tem 2 dígitos
            var month = String(date.getMonth() + 1).padStart(2, '0');
            // Pega o ano completo
            var year = date.getFullYear();
            // Retorna a data no formato yyyy-mm-dd
            return `${year}-${month}-${day}`;
        }

        // Obtém o elemento input do tipo date pelo seu ID
        var dateInput = document.getElementById('datePicker');
        // Define a data mínima permitida (hoje)
        dateInput.min = formatDate(today);
        // Define a data máxima permitida (hoje + 60 dias)
        dateInput.max = formatDate(maxDate);
    });
</script>


</html>
